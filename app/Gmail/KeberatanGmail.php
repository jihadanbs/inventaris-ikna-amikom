<?php

namespace App\Gmail;

class KeberatanGmail
{
    public static function saveDanKirimGmailRules($formData)
    {
        // Data untuk template email
        $emailData = [
            'kode_keberatan' => $formData['kode_keberatan'],
            'nama' => $formData['nama'],
            'email' => $formData['email'],
            'no_telepon' => $formData['no_telepon'],
            'ringkasan_kasus' => $formData['ringkasan_kasus'],
        ];

        // Load template email
        $emailBody = view('Views/gmail/keberatan_info_publik.php', $emailData);

        // Set pengaturan email
        $email = \Config\Services::email();
        $email->setNewline("\r\n");
        $email->setMailType('html');
        $email->setTo($formData['email']);
        $email->setSubject('Keberatan Informasi Publik');
        $email->setMessage($emailBody);

        // Kirim email
        return $email->send();
    }

    // Fungsi untuk pengiriman email berdasarkan status (Diproses atau Ditolak)
    public static function tanggapanGmailRules($pengaju_keberatan, $tanggapan, $status, $file_url = null)
    {
        // Data untuk template email
        $emailData = [
            'namaPengaju' => $pengaju_keberatan['nama'],
            'emailPengaju' => $pengaju_keberatan['email'],
            'ringkasan_kasus' => $pengaju_keberatan['ringkasan_kasus'],
            'alamat' => $pengaju_keberatan['alamat'],
            'no_telepon' => $pengaju_keberatan['no_telepon'],
            'tanggapan' => $tanggapan,
            'file_url' => $file_url,
        ];

        // Pilih template email dan subjek berdasarkan status
        switch ($status) {
            case 'Diproses':
                $emailTemplate = 'Views/gmail/keberatan_diproses_gmail.php';
                $emailSubject = 'Keberatan Informasi Publik "Diproses"';
                break;
            case 'Ditolak':
                $emailTemplate = 'Views/gmail/keberatan_ditolak_gmail.php';
                $emailSubject = 'Keberatan Informasi Publik "Ditolak"';
                break;
            case 'Diberikan':
                $emailTemplate = 'Views/gmail/keberatan_diberikan_gmail.php';
                $emailSubject = 'Keberatan Informasi Publik "Diberikan"';
                break;
            default:
                // Jika status tidak dikenal, kembalikan false
                return false;
        }

        // Load template email
        $emailBody = view($emailTemplate, $emailData);

        // Set pengaturan email
        $email = \Config\Services::email();
        $email->setNewline("\r\n");
        $email->setMailType('html');
        $email->setTo($pengaju_keberatan['email']);
        $email->setSubject($emailSubject);
        $email->setMessage($emailBody);

        // Kirim email
        return $email->send();
    }
}
