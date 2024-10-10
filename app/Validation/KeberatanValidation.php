<?php

namespace App\Validation;

class KeberatanValidation
{
    public static function saveValidationRules()
    {
        return [
            'id_alasan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Alasan Pengajuan !',
                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => 'Kolom Nama Lengkap Tidak Boleh Kosong !',
                    'min_length' => 'Nama Lengkap Minimal dari 4 karakter !',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom Email Tidak Boleh Kosong !',
                    'valid_email' => 'Email Tidak Valid !'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|numeric|trim|max_length[20]',
                'errors' => [
                    'required' => 'Kolom No. Telepon Anda Tidak Boleh Kosong !',
                    'numeric' => 'No. Telepon harus berupa angka !',
                    'max_length' => 'Inputan tidak boleh melebihi 20 karakter !',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Alamat Tidak Boleh Kosong !',
                ]
            ],
            'ringkasan_kasus' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Rincian Informasi Tidak Boleh Kosong !'
                ]
            ],
        ];
    }

    public static function allValidationRules()
    {
        return [
            'tanggapan' => [
                'rules' => 'required|trim|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Tanggapan Tidak Boleh Kosong !',
                    'min_length' => 'Tanggapan tidak boleh kurang dari 5 karakter !',
                ]
            ],
        ];
    }
}
