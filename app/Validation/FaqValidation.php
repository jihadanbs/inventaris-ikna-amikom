<?php

namespace App\Validation;

class FaqValidation
{
    public static function validationRules()
    {
        return [
            'id_kategori_faq' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Kategori FAQ !'
                ]
            ],
            'pertanyaan' => [
                'rules' => "required|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Pertanyaan Tidak Boleh Kosong !',
                    'min_length' => 'Pertanyaan tidak boleh kurang dari 5 karakter !'
                ]
            ],
            'jawaban' => [
                'rules' => "required|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Jawaban Tidak Boleh Kosong !',
                    'min_length' => 'Jawaban tidak boleh kurang dari 5 karakter !'
                ]
            ],
        ];
    }
}
