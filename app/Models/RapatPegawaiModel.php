<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class RapatPegawaiModel extends Model
{
  protected $DBGroup = 'default';
  protected $table = 'rapat_pegawai';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $insertID = 0;
  protected $returnType = 'array';
  protected $useSoftDeletes = false;
  protected $protectFields = true;
  protected $allowedFields = ['pegawai_id', 'rapat_id'];

  // Dates
  protected $useTimestamps = false;
  protected $dateFormat = 'datetime';
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
  protected $deletedField = 'deleted_at';

  // Validation
  protected $validationRules = [];
  protected $validationMessages = [];
  protected $skipValidation = false;
  protected $cleanValidationRules = true;

  // Callbacks
  protected $allowCallbacks = true;
  protected $beforeInsert = [];
  protected $afterInsert = [];
  protected $beforeUpdate = [];
  protected $afterUpdate = [];
  protected $beforeFind = [];
  protected $afterFind = [];
  protected $beforeDelete = [];
  protected $afterDelete = [];
  
  public function delete_peserta($id_peserta, $id_rapat)
  {
    $builder = $this->db->table('rapat_pegawai');
    $builder->where('rapat_id', $id_rapat);
    $builder->where('pegawai_id', $id_peserta);
    $builder->delete();
  }
}
