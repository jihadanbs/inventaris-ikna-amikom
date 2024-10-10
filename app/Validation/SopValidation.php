<?php

namespace App\Validation;

class SopValidation
{
    public static function validationRules()
    {
        return [
            'judul_sop' => [
                'rules' => "required|trim|max_length[255]|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Judul Tidak Boleh Kosong !',
                    'max_length' => 'Judul tidak boleh melebihi 255 karakter !',
                    'min_length' => 'Judul tidak boleh kurang dari 5 karakter !'
                ]
            ],
        ];
    }
}
