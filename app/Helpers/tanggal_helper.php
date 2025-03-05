<?php
if (!function_exists('formatTanggalIndo2')) {
    function formatTanggalIndo2($tanggal)
    {
        if (!$tanggal) {
            return 'Belum ada data'; // Handle tanggal kosong
        }

        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $pecahkan = explode('-', $tanggal);

        // Pastikan array hasil explode punya 3 elemen
        if (count($pecahkan) === 3) {
            return $pecahkan[2] . ' ' . ($bulan[(int)$pecahkan[1]] ?? '') . ' ' . $pecahkan[0];
        } else {
            return 'Format tanggal tidak valid';
        }
    }
}
