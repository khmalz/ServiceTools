<?php

namespace App\Http\Requests;

use App\Models\Technician;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AssignTechnicianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'technicians' => ['required', 'array', 'min:1'],
            'technicians.*' => ['string'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $appointment = $this->route('appointment');
            $startTime = $appointment->schedule->copy()->subHours(3);
            $endTime = $appointment->schedule->copy()->addHours(3);

            $conflict = Technician::whereIn('id', $this->technicians)
                ->availableBetween($startTime, $endTime)
                ->count();

            if ($conflict > 0) {
                $validator->errors()->add('technicians', 'Choose a technician who is available within 3 hours before and after the scheduled appointment.');
            }
        });
    }
}
