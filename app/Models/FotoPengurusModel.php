<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoPengurusModel extends Model
{
    protected $table            = 'tb_foto_pengurus';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'foto', 'posisi', 'divisi'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama'   => 'required|max_length[100]',
        'foto'   => 'required|max_length[255]',
        'posisi' => 'required|max_length[100]',
        'divisi' => 'required|max_length[100]',
    ];

    // protected $validationMessages = [
    //     'nama' => [
    //         'required'    => 'Nama tidak boleh kosong.',
    //         'max_length'  => 'Nama tidak boleh lebih dari 100 karakter.',
    //     ],
    //     'foto' => [
    //         'required'    => 'Foto tidak boleh kosong.',
    //         'max_length'  => 'Path foto tidak boleh lebih dari 255 karakter.',
    //     ],
    //     'posisi' => [
    //         'required'    => 'Posisi tidak boleh kosong.',
    //         'max_length'  => 'Posisi tidak boleh lebih dari 100 karakter.',
    //     ],
    //     'divisi' => [
    //         'required'    => 'Divisi tidak boleh kosong.',
    //         'max_length'  => 'Divisi tidak boleh lebih dari 100 karakter.',
    //     ],
    // ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
