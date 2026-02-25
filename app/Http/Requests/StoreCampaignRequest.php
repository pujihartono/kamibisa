<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'             => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description'       => 'required|string',
            'target_amount'     => 'required|numeric|min:10000', // Minimal 10rb
            'deadline'          => 'required|date|after:today',   // Deadline harus masa depan
            'image'             => 'required|image|max:2048',     // Wajib upload gambar, max 2MB
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Judul kampanye wajib diisi, kak!.',
            'target_amount.min'    => 'Maaf, donasi minimal Rp 10.000 ya.',
        ];
    }
}
