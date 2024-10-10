<?php

namespace App\Validation;

class WebsiteValidation
{
    public static function validationRules()
    {
        return [
            'nama_wilayah' => [
                'rules' => 'required|min_length[3]|max_length[25]',
                'errors' => [
                    'required' => 'Kolom Nama Website Atau Wilayah Tidak Boleh Kosong !',
                    'min_length' => 'Kolom Nama Website Atau Wilayah minimal 3 karakter !',
                    'max_length' => 'Kolom Nama Website Atau Wilayah maksimal 25 karakter !',
                ],
            ],
            'link_wilayah' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Kolom Link Website Wilayah Tidak Boleh Kosong !',
                ]
            ],
        ];
    }
}
