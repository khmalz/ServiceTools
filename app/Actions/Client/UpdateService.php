<?php

namespace App\Actions\Client;

use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UpdateService
{
    public function handle(Service $service, array $data, array $images = [])
    {
        DB::beginTransaction();

        try {
            $deleted = $data['img_deleted'];

            if ($deleted) {
                $imagesToDelete = ServiceImage::whereIn('id', $deleted)->get();

                foreach ($imagesToDelete as $image) {
                    $filePath = public_path("images/{$image->path}");
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }

                    $image->delete();
                }
            }

            $service->update($data);

            if (!empty($images)) {
                foreach ($images as $image) {
                    $imagePath = $image->store('evidences');

                    $service->images()->create([
                        'path' => $imagePath,
                    ]);
                }
            }

            if ($data['work'] === 'home' && $data['schedule']) {
                $service->appointment()->updateOrCreate(
                    [],
                    [
                        'schedule' => $data['schedule']
                    ]
                );
            } else {
                $service->appointment()->delete();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
