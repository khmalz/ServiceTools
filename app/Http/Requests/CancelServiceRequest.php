<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->service && $this->user()->id == $this->service->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cancel' => ['required']
        ];
    }
}
