<?php

namespace App\Validation;

class FotoPengurusValidation
{
    public static function validationRules()
    {
        return [
            'nama' => [
                'rules' => 'required|trim|max_length[255]',
                'errors' => [
                    'required' => 'Kolom Nama tidak boleh kosong.',
                    'max_length' => 'Nama tidak boleh lebih dari 255 karakter.'
                ]
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
                'errors' => [
                    'uploaded' => 'File foto wajib diunggah.',
                    'max_size' => 'Ukuran foto maksimal adalah 2 MB.',
                    'is_image' => 'File yang diunggah harus berupa gambar (jpg, png, dll).'
                ]
            ],
            'posisi' => [
                'rules' => 'required|trim|max_length[255]',
                'errors' => [
                    'required' => 'Kolom Posisi tidak boleh kosong.',
                    'max_length' => 'Posisi tidak boleh lebih dari 255 karakter.'
                ]
            ],
            'divisi' => [
                'rules' => 'required|trim|max_length[255]',
                'errors' => [
                    'required' => 'Kolom Divisi tidak boleh kosong.',
                    'max_length' => 'Divisi tidak boleh lebih dari 255 karakter.'
                ]
            ],
            'created_at' => [
                'rules' => 'valid_date[Y-m-d]',
                'errors' => [
                    'valid_date' => 'Tanggal yang dimasukkan tidak valid. Gunakan format YYYY-MM-DD.'
                ]
            ]
        ];
    }
}
