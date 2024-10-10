<?php

namespace App\Gmail;

class FeedbackGmail
{
    public static function saveAndSendGmailRules($formData)
    {
        // Data untuk template email
        $emailData = [
            'nama' => $formData['nama'],
            'email' => $formData['email'],
            'subjek' => $formData['subjek'],
            'pesan' => $formData['pesan'],
        ];

        // Load template email
        $emailBody = view('Views/gmail/feedback_email', $emailData);

        // Set pengaturan email
        $email = \Config\Services::email();
        $email->setNewline("\r\n");
        $email->setMailType('html');
        $email->setTo($formData['email']);
        $email->setSubject('Terima Kasih Atas Feedback Anda');
        $email->setMessage($emailBody);

        // Kirim email
        return $email->send();
    }

    public static function balasGmailRules($emailData)
    {
        // Load template email
        $emailBody = view('Views/gmail/tanggapan_email.php', $emailData);

        // Set pengaturan email
        $email = \Config\Services::email();
        $email->setNewline("\r\n");
        $email->setMailType('html');
        $email->setTo($emailData['email']);
        $email->setSubject('Balasan Feedback untuk ' . $emailData['nama']);
        $email->setMessage($emailBody);

        // Kirim email
        return $email->send();
    }
}
