<?php

namespace App\Validation;

class LaporanValidation
{
    public static function validationRules()
    {
        return [
            'judul_laporan' => [
                'rules' => "required|trim|max_length[255]|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Judul Tidak Boleh Kosong !',
                    'max_length' => 'Judul laporan tidak boleh melebihi 255 karakter !',
                    'min_length' => 'Judul laporan tidak boleh kurang dari 5 karakter !'
                ]
            ],
            'tanggal_file' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Kolom Tanggal Tidak Boleh Kosong !',
                ]
            ],
        ];
    }
}
