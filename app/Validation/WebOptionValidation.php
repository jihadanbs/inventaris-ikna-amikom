<?php

namespace App\Validation;

class WebOptionValidation
{
    public static function validationRules()
    {
        return [
            'name' => [
                'rules' => "required|trim|max_length[255]|min_length[3]",
                'errors' => [
                    'required' => 'Kolom Name Tidak Boleh Kosong',
                    'max_length' => 'Nama tidak boleh melebihi 255 karakter.',
                    'min_length' => 'Nama tidak boleh kurang dari 3 karakter.'
                ]
            ],
            'value' => [
                'rules' => "required|trim|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Value Tidak Boleh Kosong',
                    'min_length' => 'Deskripsi tidak boleh kurang dari 5 karakter.'
                ]
            ],
        ];
    }
}
