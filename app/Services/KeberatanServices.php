<?php

namespace App\Services;

class KeberatanServices
{
    // Delete On Delete 1 and Delete 2
    public static function deleteFiles(array $dataFiles)
    {
        // Hapus setiap file yang ditemukan di database
        foreach ($dataFiles[0] as $fileColumn => $filePath) {
            if (!empty($filePath)) {
                $fullFilePath = ROOTPATH . 'public/' . $filePath;
                if (is_file($fullFilePath)) {
                    unlink($fullFilePath);
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
