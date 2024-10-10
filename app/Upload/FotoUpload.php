<?php

namespace App\Upload;

class FotoUpload
{
    // Upload Foto Multiple di-Save
    public static function saveUploads($fileInputName, $uploadPath)
    {
        // Panggil helper uploadFile untuk multiple files
        $uploadedFiles = uploadMultiple($fileInputName, $uploadPath);

        if (empty($uploadedFiles)) {
            return false; // Mengembalikan false jika tidak ada file yang berhasil diunggah
        }

        return $uploadedFiles; // Mengembalikan array file yang berhasil diunggah
    }

    // Upload Foto Multiple di-Edit
    public static function handleFileUpload($fieldName, $uploadPath)
    {
        // Panggil helper uploadMultiple
        return uploadMultiple($fieldName, $uploadPath);
    }

    // Menyimpan File Baru di-Edit
    public static function saveNewFiles($uploadedFiles, $idFoto)
    {
        foreach ($uploadedFiles as $fileName) {
            // Simpan file baru ke tb_file_foto
            $db = \Config\Database::connect();
            $db->table('tb_file_foto')->insert(['file_foto' => $fileName]);
            $idFileFoto = $db->insertID();

            // Relasikan file dengan galeri
            $db->table('tb_galeri')->insert([
                'id_foto' => $idFoto,
                'id_file_foto' => $idFileFoto
            ]);
        }
    }
}
