<?php

// File: app/Helpers/visitor_stats_helper.php

if (!function_exists('getVisitorStats')) {
    function getVisitorStats($db)
    {
        // Ambil data pengunjung hari ini
        $today = date('Y-m-d');
        $query = "SELECT visitors_today, visitors_online FROM visitor_stats WHERE visit_date = ?";
        $result = $db->query($query, [$today])->getRow();

        // Jika tidak ada data untuk hari ini, kembalikan nilai default
        if (!$result) {
            $result = [
                'visitors_today' => 0,
                'visitors_online' => 0
            ];
        }

        return $result;
    }
}
