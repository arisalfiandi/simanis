<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class UserModel extends Model
{
  protected $DBGroup = 'default';
  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $insertID = 0;
  protected $returnType = 'array';
  protected $useSoftDeletes = false;
  protected $protectFields = true;
  protected $allowedFields = ['id', 'nip', 'password', 'nama', 'pangkat', 'jabatan'];

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

  public function get_user()
  {
    $builder = $this->db->table('users');
    $builder->select('id, username, pangkat, jabatan, nip');
    $query = $builder->get();
    return $query->getResultArray();
  }

  public function get_user_not_id($id)
  {
    $builder = $this->db->table('users');
    $builder->select('id, username, pangkat, jabatan, nip');
    $builder->where('id !=', $id);
    $query = $builder->get();
    return $query->getResultArray();
  }

  public function get_user_pangkat_desc()
  {
    $builder = $this->db->table('users');
    $builder->select('id, username, pangkat, jabatan, nip');
    $builder->orderBy('pangkat', 'DESC');
    $query = $builder->get();
    return $query->getResultArray();
  }

  // public function get_user_id($nip)
  // {
  //   $builder = $this->db->table('users');
  //   $builder->select('id');
  //   $builder->where('nip', $nip);
  //   $query = $builder->get();
  //   return $query->getResult()[0];
  // }

  public function get_user_id($nip)
  {
    $builder = $this->db->table('users');
    $builder->select('id');
    $builder->where('nip', $nip);
    $query = $builder->get();
    return $query->getResult()[0];
  }

  public function get_user_nama($id)
  {
    $builder = $this->db->table('users');
    $builder->select('username, jabatan');
    $builder->where('id', $id);
    $query = $builder->get();
    return $query->getResultArray();
  }

  public function get_user_nip($id)
  {
    $builder = $this->db->table('users');
    $builder->select('nip');
    $builder->where('id', $id);
    $query = $builder->get();
    return $query->getResultArray();
  }

  public function delete_user($id)
  {
    $builder = $this->db->table('users');
    $builder->where('id', $id);
    $builder->delete();
  }
}
