<?php

if (!function_exists('uploadFile')) {
    function uploadFile($inputName, $destinationPath)
    {
        // $request = service('request');
        // $file = $request->getFile($inputName);

        // if ($file->isValid() && !$file->hasMoved()) {
        //     $randomName = $file->getRandomName();
        //     $file->move(ROOTPATH . 'public/file_upload/' . $destinationPath, $randomName);
        //     return $randomName;
        // }

        // return null;

        /*=====================Upload Compress===================*/
        $request = service('request');
        $file = $request->getFile($inputName);

        if ($file->isValid() && !$file->hasMoved()) {
            $randomName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/file_upload/' . $destinationPath, $randomName);

            // Load gambar yang baru diupload
            $image = \Config\Services::image()
                ->withFile(ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName);

            $quality = 50;
            // Simpan gambar dengan kualitas yang ditentukan
            $image->save(ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName, $quality);

            $pathtum = 'file_upload/' . $destinationPath . $randomName;
            // return $randomName;
            return $pathtum;
        }

        return null;
    }
    function updateFile($inputName, $destinationPath, $oldFileName = null)
    {
        $request = service('request');

        // Periksa apakah ada file yang diunggah dengan nama input yang diberikan
        $file = $request->getFile($inputName);

        // Jika tidak ada file baru atau file baru tidak valid, gunakan nama file lama
        if (!$file->isValid() || $file->hasMoved()) {
            return $oldFileName;
        }

        // Hapus file lama jika ada dan jika file lama bukan NULL
        if ($oldFileName) {
            $oldFilePath = ROOTPATH . 'public/' . $oldFileName;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        // Unggah file baru
        $randomName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/file_upload/' . $destinationPath, $randomName);

        // Load gambar yang baru diunggah
        $image = \Config\Services::image()
            ->withFile(ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName);

        // Simpan gambar dengan kualitas yang ditentukan
        $quality = 50;
        $image->save(ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName, $quality);

        $newFilePath = 'file_upload/' . $destinationPath . $randomName;
        return $newFilePath;
    }

    // Helper Function
    function updateMultiple($inputName, $destinationPath, $oldFileName = null)
    {
        $request = service('request');
        $files = $request->getFiles($inputName);

        // Initialize new file path variable
        $newFilePath = null;

        // Check if there are uploaded files
        if (isset($files[$inputName])) {
            foreach ($files[$inputName] as $file) {
                // Check if the uploaded file is valid and not moved
                if ($file->isValid() && !$file->hasMoved()) {
                    // Remove old file if exists and old file name is not null
                    if ($oldFileName) {
                        $oldFilePath = ROOTPATH . 'public/' . $oldFileName;
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }

                    // Upload new file
                    $randomName = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/file_upload/' . $destinationPath, $randomName);

                    // Load the newly uploaded image
                    $image = \Config\Services::image()
                        ->withFile(ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName);

                    // Save the image with specified quality
                    $quality = 50;
                    $image->save(ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName, $quality);
                    $newFilePath = 'file_upload/' . $destinationPath . $randomName;

                    // Exit the loop as we found the uploaded file
                    break;
                }
            }
        }

        return $newFilePath;
    }

    function uploadFilePDF($inputName, $destinationPath)
    {
        $request = service('request');
        $file = $request->getFile($inputName);

        if ($file->isValid() && !$file->hasMoved()) {
            // Periksa tipe MIME untuk memastikan file adalah PDF
            if ($file->getMimeType() !== 'application/pdf') {
                // Jika tipe MIME tidak sesuai, kembalikan null
                return null;
            }

            // Generate nama acak untuk file
            $randomName = $file->getRandomName();

            // Pindahkan file ke direktori tujuan
            $file->move(ROOTPATH . 'public/file_upload/' . $destinationPath, $randomName);

            // Konstruksi path untuk file yang diunggah
            $uploadedFilePath = 'file_upload/' . $destinationPath . $randomName;

            return $uploadedFilePath;
        }

        return null;
    }

    function updateFilePDF($inputName, $destinationPath, $oldFileName = null)
    {
        $request = service('request');

        // Periksa apakah ada file yang diunggah dengan nama input yang diberikan
        $file = $request->getFile($inputName);

        // Jika tidak ada file baru, gunakan nama file lama
        if (!$file->isValid() || $file->hasMoved()) {
            return $oldFileName;
        }

        // Hapus file lama jika ada
        if ($oldFileName) {
            $oldFilePath = ROOTPATH . 'public/' . $oldFileName;
            if (file_exists($oldFilePath)) {
                if (!unlink($oldFilePath)) {
                    log_message('error', 'Gagal menghapus file lama: ' . $oldFilePath);
                }
            }
        }

        // Unggah file baru
        $randomName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/file_upload/' . $destinationPath, $randomName);

        $filePath = 'file_upload/' . $destinationPath . $randomName;

        return $filePath;
    }

    function uploadFiles($inputName, $destinationPath)
    {
        $request = service('request');
        $files = $request->getFiles();
        $uploadedFiles = [];

        if (isset($files[$inputName])) {
            foreach ($files[$inputName] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $randomName = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/' . $destinationPath, $randomName);
                    $uploadedFiles[] = $destinationPath . $randomName;
                }
            }
        }

        return json_encode($uploadedFiles); // Convert array to JSON
    }


    function uploadMultiple($inputName, $destinationPath)
    {
        $request = service('request');
        $files = $request->getFiles();
        $uploadedFiles = [];

        if (isset($files[$inputName])) {
            foreach ($files[$inputName] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $randomName = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/file_upload/' . $destinationPath, $randomName);

                    // Load gambar yang baru diupload
                    $image = \Config\Services::image()
                        ->withFile(ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName);

                    $quality = 50;
                    // Simpan gambar dengan kualitas yang ditentukan
                    $image->save(ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName, $quality);

                    $uploadedFiles[] = 'file_upload/' . $destinationPath . $randomName;
                }
            }
        }

        return $uploadedFiles;
    }

    function updateMultiple_($inputName, $destinationPath)
    {
        $request = service('request');
        $files = $request->getFiles();
        $uploadedFiles = [];

        if (isset($files[$inputName])) {
            foreach ($files[$inputName] as $file) {
                if (!empty($file) && $file->isValid() && !$file->hasMoved()) {
                    $randomName = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/file_upload/' . $destinationPath, $randomName);

                    // Load gambar yang baru diupload
                    $image = \Config\Services::image()
                        ->withFile(ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName);

                    $quality = 50;
                    // Simpan gambar dengan kualitas yang ditentukan
                    $image->save(ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName, $quality);

                    $uploadedFiles[] = 'file_upload/' . $destinationPath . $randomName;
                }
            }
        }

        return $uploadedFiles;
    }


    function uploadFileUmum($inputName, $destinationPath)
    {
        $request = service('request');
        $file = $request->getFile($inputName);

        if ($file->isValid() && !$file->hasMoved()) {
            // Generate nama acak untuk file
            $randomName = $file->getRandomName();

            // Pindahkan file ke direktori tujuan
            $file->move(ROOTPATH . 'public/file_upload/' . $destinationPath, $randomName);

            // Konstruksi path untuk file yang diunggah
            $uploadedFilePath = 'file_upload/' . $destinationPath . $randomName;

            return $uploadedFilePath;
        }

        return null;
    }

    function updateFileProfile($inputName, $destinationPath, $oldFileName = null)
    {
        $request = service('request');

        // Periksa apakah ada file yang diunggah dengan nama input yang diberikan
        $file = $request->getFile($inputName);

        // Jika tidak ada file baru atau file baru tidak valid, gunakan nama file lama
        if (!$file->isValid()) {
            return $oldFileName;
        }

        // Hapus file lama jika ada dan jika file lama bukan NULL
        if ($oldFileName) {
            $oldFilePath = ROOTPATH . 'public/' . $oldFileName;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        // Unggah file baru
        $randomName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/file_upload/' . $destinationPath, $randomName);

        // Debug: Print or log the random name and destination path
        echo "File uploaded to: " . ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName;

        // Load gambar yang baru diunggah
        $image = \Config\Services::image()
            ->withFile(ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName);

        // Simpan gambar dengan kualitas yang ditentukan
        $quality = 50;
        $image->save(ROOTPATH . 'public/file_upload/' . $destinationPath . $randomName, $quality);

        $newFilePath = 'file_upload/' . $destinationPath . $randomName;
        return $newFilePath;
    }
}
/* 
    => cara penggunaan, kalian masukan ke function construct : 
        "helper('upload');"

    => untuk penggunaan pada saat upload silahkan gunakan
     "$nama_variable_untukrandomname = uploadFile('nama_variabel_post', 'PATH');"

    => PATH itu contohnya "artikel/tumbnail"
*/
