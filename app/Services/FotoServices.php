<?php

namespace App\Services;

class FotoServices
{
    // Delete On Delete
    public static function deleteFiles(array $files)
    {
        foreach ($files as $fileData) {
            $filePath = ROOTPATH . 'public/' . $fileData['file_foto'];
            if (is_file($filePath)) {
                if (!unlink($filePath)) {
                    throw new \Exception('Gagal menghapus file: ' . $filePath);
                }
            }
        }
    }

    // Delete On Edit 
    public static function deleteOldFiles($oldFileNames)
    {
        foreach ($oldFileNames as $oldFileName) {
            $filePath = ROOTPATH . 'public/' . $oldFileName;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}
