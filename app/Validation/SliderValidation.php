<?php

namespace App\Validation;

class SliderValidation
{
    public static function validationRules()
    {
        return [
            'gambar_slider' => [
                'rules' => 'uploaded[gambar_slider]|mime_in[gambar_slider,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar_slider,5024]',
                'errors' => [
                    'uploaded' => 'Kolom Gambar Slider harus diisi',
                    'mime_in' => 'File yang diunggah harus berupa gambar dengan format JPG, JPEG, PNG, atau GIF',
                    'max_size' => 'Ukuran file tidak boleh lebih dari 5024 KB',
                ]
            ],
        ];
    }
}
