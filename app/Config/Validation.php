<?php

namespace Config;

use App\Models\UserModel;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\Rules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\CreditCardRules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        Validation::class,

    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public function username_update_check(string $str, string $fields, array $data): bool
{
    $params = explode(',', $fields);
    $table = $params[0];
    $field = $params[1];
    $currentUserId = $params[2] ?? null;

    $builder = db_connect()->table($table);
    $builder->where($field, $str);
    
    // Kecualikan user saat ini
    if ($currentUserId !== null) {
        $builder->where('id_user !=', $currentUserId);
    }

    $existingUser = $builder->countAllResults();

    return $existingUser === 0;
}

public function email_update_check(string $str, string $fields, array $data): bool
{
    $params = explode(',', $fields);
    $table = $params[0];
    $field = $params[1];
    $currentUserId = $params[2] ?? null;

    $builder = db_connect()->table($table);
    $builder->where($field, $str);
    
    // Kecualikan user saat ini
    if ($currentUserId !== null) {
        $builder->where('id_user !=', $currentUserId);
    }

    $existingUser = $builder->countAllResults();

    return $existingUser === 0;
}
    public function username_check(string $str, string $fields, array $data): bool
    {
        $userModel = new UserModel();
        $user = $userModel->where('username', $str)->first();

        return $user === null;
    }

    public function email_check(string $str, string $fields, array $data): bool
    {
        $userModel = new UserModel();
        $user = $userModel->where('email', $str)->first();

        return $user === null;
    }

    public function is_unique_nama_barang($str, string $fields, array $data): bool
    {
        $params = explode(',', $fields);
        $table = array_shift($params);
        $builder = db_connect()->table($table);

        // Mendapatkan id_kategori_barang dari $data jika tersedia
        $id_kategori_barang = isset($data[$params[0]]) ? $data[$params[0]] : null;

        // Memeriksa keunikan nama barang hanya jika id_kategori_barang telah dipilih
        if ($id_kategori_barang !== null) {
            $builder->where('nama_barang', $str)
                ->where('id_kategori_barang', $id_kategori_barang);
        } else {
            // Jika salah satu atau ketiga nilai tidak ada, abaikan periksa keunikan judul
            return true;
        }

        // Menghitung jumlah baris yang sesuai dengan kriteria
        return $builder->countAllResults() === 0;
    }

    public function is_unique_nama_barang_lainnya($str, string $fields, array $data): bool
    {
        // Memisahkan parameter table dan field lainnya
        $params = explode(',', $fields);
        $table = array_shift($params);
        $builder = db_connect()->table($table);

        // Mendapatkan id_kategori_barang dan id_barang dari data
        $id_kategori_barang = isset($data[$params[0]]) ? $data[$params[0]] : null;
        $id_barang = isset($data['id_barang']) ? $data['id_barang'] : null;

        // Memeriksa keunikan nama barang hanya jika id_kategori_barang telah dipilih
        if ($id_kategori_barang !== null) {
            // Memeriksa apakah ada nama barang yang sama di kategori yang sama, kecuali yang sedang diedit
            $builder->where('nama_barang', $str)
                ->where('id_kategori_barang', $id_kategori_barang);

            // Jika ada id_barang (edit mode), kecualikan barang dengan id tersebut
            if ($id_barang !== null) {
                $builder->where('id_barang !=', $id_barang);
            }
        } else {
            // Jika id_kategori_barang tidak ada, abaikan pengecekan
            return true;
        }

        // Menghitung jumlah baris yang sesuai dengan kriteria
        return $builder->countAllResults() === 0;
    }

    public function check_unique_id_barang($id_barang, string $params, array $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_setting_pinjam_barang');

        // Ambil slug dari data yang dikirim
        $slug = isset($data['slug']) ? $data['slug'] : null;

        // Cari data berdasarkan id_barang, kecuali data yang sedang diedit (berdasarkan slug)
        $builder->where('id_barang', $id_barang);
        if ($slug) {
            $builder->where('slug !=', $slug);
        }

        // Hitung hasilnya
        return $builder->countAllResults() === 0;
    }

    public static function notEqualTo(string $str, string $fields, array $data): bool
    {
        // Pastikan field dibandingkan ada
        return isset($data[$fields]) && $str !== $data[$fields];
    }

    public function is_unique_id_barang_rusak(string $id_barang, string $fields, array $data): bool
    {
        $params = explode(',', $fields);
        $table = array_shift($params); // Nama tabel target
        $id_barang_field = array_shift($params); // Nama kolom id_barang

        $builder = db_connect()->table($table);

        // Memeriksa apakah id_barang sudah ada di tabel tb_barang_rusak
        $builder->where($id_barang_field, $id_barang);

        // Jika ada data yang cocok, return false (tidak unik)
        return $builder->countAllResults() === 0;
    }

    public function password_match(string $str, ?string $fields = null, array $data = []): bool
    {
        // Pastikan parameter fields tidak null
        if ($fields === null) {
            return false;
        }

        // Ekstrak parameter tabel dan kolom ID pengguna dari string fields
        [$table, $userIdColumn] = explode(',', $fields);

        // Pastikan kolom ID pengguna tersedia dalam $data
        if (!isset($data[$userIdColumn])) {
            return false;
        }

        // Ambil ID pengguna dari $data
        $userId = $data[$userIdColumn];

        // Buat kueri untuk mengambil password dari database
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($userId);

        // Periksa apakah pengguna ditemukan dan apakah password cocok
        if ($user && isset($user['password'])) {
            return password_verify($str, $user['password']);
        }

        // Jika pengguna tidak ditemukan atau tidak ada password di database, kembalikan false
        return false;
    }

    public function is_unique_password(string $password, string $fields, array $data): bool
    {
        $params = explode(',', $fields);
        $table = array_shift($params);
        $id_user_field = array_shift($params);
        $id_user = isset($data[$id_user_field]) ? $data[$id_user_field] : null;

        if ($id_user === null) {
            return true;
        }

        $builder = db_connect()->table($table);
        $user = $builder->select('password')->where('id_user', $id_user)->get()->getRow();

        if ($user && password_verify($password, $user->password)) {
            // Password baru sama dengan password lama
            return false;
        }

        return true;
    }

    public function check_no_telepon(string $no_telepon): bool
    {
        // Cek apakah nomor telepon diawali dengan "62"
        if (substr($no_telepon, 0, 2) === '62') {
            return false; // Tidak valid jika diawali dengan "62"
        }
        return true; // Valid
    }

    public function check_total_dipinjam(string $str, string $fields, array $data): bool
    {
        // Memecah parameter yang dikirim
        $params = explode(',', $fields);

        // Mengambil nama tabel dan field
        $table = array_shift($params);
        $id_peminjaman = array_shift($params);

        // Dapatkan kode_peminjaman dari id_peminjaman ini
        $row = db_connect()->table($table)
            ->where('id_peminjaman', $id_peminjaman)
            ->get()
            ->getRowArray();

        if (!$row) {
            return false;
        }

        $kode_peminjaman = $row['kode_peminjaman'];

        // Hitung total semua barang dengan kode_peminjaman yang sama
        $totalDipinjam = db_connect()->table($table)
            ->selectSum('total_dipinjam')
            ->where('kode_peminjaman', $kode_peminjaman)
            ->get()
            ->getRowArray();

        // Bandingkan total
        return (int)$str === (int)($totalDipinjam['total_dipinjam'] ?? 0);
    }

    public function validate_total_pengembalian(string $str, string $fields, array $data): bool
    {
        $jumlah_total_baik = intval($data['jumlah_total_baik']);
        $jumlah_total_rusak = intval($data['jumlah_total_rusak']);
        $total_dipinjam = intval($data['total_dipinjam']);

        return ($jumlah_total_baik + $jumlah_total_rusak) === $total_dipinjam;
    }

    public function nama_check(string $str, string $fields, array $data): bool
    {
        $userModel = new UserModel();
        $user = $userModel->where('nama_lengkap', $str)->first();

        return $user === null;
    }
}
