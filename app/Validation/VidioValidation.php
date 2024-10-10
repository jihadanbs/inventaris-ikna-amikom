<?php

namespace App\Validation;

class VidioValidation
{
    public static function validationRules()
    {
        return [
            'judul_vidio' => [
                'rules' => 'required|trim|max_length[80]|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Judul Tidak Boleh Kosong !',
                    'max_length' => 'Penamaan Judul Tidak Boleh Lebih Dari 80 Karakter !',
                    'min_length' => 'Penamaan Judul Tidak Boleh Kurang Dari 5 Karakter !'
                ]
            ],
            'link_vidio' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Link Video Tidak Boleh Kosong !',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|trim|max_length[255]|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Deskripsi Tidak Boleh Kosong !',
                    'max_length' => 'Deskripsi Tidak Boleh Melebihi 255 Karakter !',
                    'min_length' => 'Deskripsi Tidak Boleh Kurang Dari 5 Karakter !'
                ]
            ],
            'tanggal_vidio' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tanggal Tidak Boleh Kosong !',
                ]
            ],
        ];
    }
}
