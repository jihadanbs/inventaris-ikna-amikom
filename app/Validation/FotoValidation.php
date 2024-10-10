<?php

namespace App\Validation;

class FotoValidation
{
    public static function validationRules()
    {
        return [
            'judul_foto' => [
                'rules' => 'required|trim|max_length[80]|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Judul Tidak Boleh Kosong!',
                    'max_length' => 'Penamaan Judul Tidak Boleh Lebih Dari 80 Karakter!',
                    'min_length' => 'Penamaan Judul Tidak Boleh Kurang Dari 5 Karakter!'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|trim|max_length[255]',
                'errors' => [
                    'required' => 'Kolom Deskripsi Tidak Boleh Kosong!',
                    'max_length' => 'Deskripsi Tidak Boleh Melebihi 255 Karakter!'
                ]
            ],
            'tanggal_foto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tanggal Tidak Boleh Kosong!',
                ]
            ]
        ];
    }
}
