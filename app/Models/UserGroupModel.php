<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class UserGroupModel extends Model
{
  protected $DBGroup = 'default';
  protected $table = 'auth_groups_users';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $insertID = 0;
  protected $returnType = 'array';
  protected $useSoftDeletes = false;
  protected $protectFields = true;
  protected $allowedFields = ['group_id','user_id'];

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

  public function update_role($user_id, $group_id){
    $builder = $this->db->table('auth_groups_users');
    $builder->where('user_id', $user_id);
    $builder->update(['group_id' => $group_id]);
  }

  public function get_role($user_id){
    $builder = $this->db->table('auth_groups_users');
    $builder->select('group_id');
    $builder->where('user_id', $user_id);
    $query = $builder->get();
    return $query->getResultArray()[0];
  }
}
