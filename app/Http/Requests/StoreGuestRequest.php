<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuestRequest extends FormRequest
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
            'username' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:50',
            'instansi' => 'nullable|string|max:255',
            'keperluan' => 'required|in:Layanan Administrasi Hukum Umum,Layanan Kekayaan Intelektual,Layanan Pengaduan',
            'keterangan' => 'nullable|string',
        ];
    }
}
