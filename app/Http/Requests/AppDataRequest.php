<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppDataRequest extends FormRequest
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
            'logo_first_name'=> ['required', 'min:5'],
            'logo_last_name' => ['required', 'min:3'],
            'heading' => ['required', 'min:5'],
            'location' => ['required', 'min:5'],
            'email' => ['required', 'email'],
            'mobile' => ['required'],
            'site_name' => ['required'],
            'facebook' => ['required'],
            'twitter' => ['required'],
            'linkedin' => ['required'],
            'instagram' => ['required'],
            'contact_touch' => ['required']           
        ];
    }
}
