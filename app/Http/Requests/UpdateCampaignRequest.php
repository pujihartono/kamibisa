<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->campaign->user_id === Auth::id();
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
            'image'             => 'nullable|image|max:2048',     // Wajib upload gambar, max 2MB
            'status'            => 'nullable|in:active,finished',
        ];
    }
}
