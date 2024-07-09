<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ServiceClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string'],
            'work' => ['required', 'string'],
            'description' => ['required', 'string', 'max:191'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg', 'max:5120'],
            'img_deleted' => ['nullable', 'array'],
            'schedule' => [
                'nullable', 'date', 'date_format:Y-m-d H:i:s',
                function ($attribute, $value, $fail) {
                    $schedule = Carbon::parse($value);
                    $minTime = Carbon::parse($schedule->format('Y-m-d') . ' 08:00:00');
                    $maxTime = Carbon::parse($schedule->format('Y-m-d') . ' 18:00:00');

                    if ($schedule->lt($minTime) || $schedule->gt($maxTime)) {
                        $fail("The $attribute must be between 08:00 and 18:00 on the same day.");
                    }
                },
            ]
        ];
    }
}
