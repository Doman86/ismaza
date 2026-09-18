<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageRequest extends FormRequest
{
    /**
     * Siapa yang boleh melakukan request ini.
     */
    public function authorize(): bool
    {
        return (bool) $this->user()?->isAdmin();
    }

    /**
     * Aturan validasi.
     */
    public function rules(): array
    {
        return [
            'title'   => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:5000'],
        ];
    }

    /**
     * Pesan error dalam Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'title.required'   => 'Judul pesan wajib diisi.',
            'title.max'        => 'Judul pesan maksimal 255 karakter.',
            'content.required' => 'Isi pesan wajib diisi.',
            'content.max'      => 'Isi pesan maksimal 5000 karakter.',
        ];
    }
}
