<?php

namespace App\Validation;

class FeedbackValidation
{
    public static function saveValidationRules()
    {
        return [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Tidak Boleh Kosong',
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Email Tidak Boleh Kosong',
                ]
            ],
            'subjek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Subjek Tidak Boleh Kosong',
                ]
            ],
            'no_telepon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom No Telepon Tidak Boleh Kosong',
                ]
            ],
            'pesan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Isi Pesan Tidak Boleh Kosong',
                ]
            ],
        ];
    }

    public static function balasValidationRules()
    {
        return [
            'balasan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom balasan Tidak Boleh Kosong',
                ]
            ],
        ];
    }
}
