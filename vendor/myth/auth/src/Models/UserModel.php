<?php

namespace Myth\Auth\Models;

use CodeIgniter\Model;
use Faker\Generator;
use Myth\Auth\Authorization\GroupModel;
use Myth\Auth\Entities\User;

/**
 * @method User|null first()
 */
class UserModel extends Model
{
  protected $table          = 'users';
  protected $primaryKey     = 'id';
  protected $returnType     = User::class;
  protected $useSoftDeletes = true;
  protected $allowedFields  = [
    'id','email', 'username', 'nip', 'jabatan', 'pangkat', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
    'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at',
  ];
  protected $useTimestamps   = true;
  protected $validationRules = [
    'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
    'username'      => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
    'password_hash' => 'required',
  ];
  protected $validationMessages = [];
  protected $skipValidation     = false;
  protected $afterInsert        = ['addToGroup'];

  /**
   * The id of a group to assign.
   * Set internally by withGroup.
   *
   * @var int|null
   */
  protected $assignGroup;

  /**
   * Logs a password reset attempt for posterity sake.
   */
  public function logResetAttempt(string $email, ?string $token = null, ?string $ipAddress = null, ?string $userAgent = null)
  {
    $this->db->table('auth_reset_attempts')->insert([
      'email'      => $email,
      'ip_address' => $ipAddress,
      'user_agent' => $userAgent,
      'token'      => $token,
      'created_at' => date('Y-m-d H:i:s'),
    ]);
  }

  /**
   * Logs an activation attempt for posterity sake.
   */
  public function logActivationAttempt(?string $token = null, ?string $ipAddress = null, ?string $userAgent = null)
  {
    $this->db->table('auth_activation_attempts')->insert([
      'ip_address' => $ipAddress,
      'user_agent' => $userAgent,
      'token'      => $token,
      'created_at' => date('Y-m-d H:i:s'),
    ]);
  }

  /**
   * Sets the group to assign any users created.
   *
   * @return $this
   */
  public function withGroup(string $groupName)
  {
    $group = $this->db->table('auth_groups')->where('name', $groupName)->get()->getFirstRow();

    $this->assignGroup = $group->id;

    return $this;
  }

  /**
   * Clears the group to assign to newly created users.
   *
   * @return $this
   */
  public function clearGroup()
  {
    $this->assignGroup = null;

    return $this;
  }

  /**
   * If a default role is assigned in Config\Auth, will
   * add this user to that group. Will do nothing
   * if the group cannot be found.
   *
   * @param mixed $data
   *
   * @return mixed
   */
  protected function addToGroup($data)
  {
    if (is_numeric($this->assignGroup)) {
      $groupModel = model(GroupModel::class);
      $groupModel->addUserToGroup($data['id'], $this->assignGroup);
    }

    return $data;
  }

  /**
   * Faked data for Fabricator.
   */
  public function fake(Generator &$faker): User
  {
    return new User([
      'email'    => $faker->email,
      'username' => $faker->userName,
      'password' => bin2hex(random_bytes(16)),
    ]);
  }

  public function get_user()
  {
    $builder = $this->db->table('users');
    $builder->select('id, nama, pangkat, jabatan, nip');
    $query = $builder->get();
    return $query->getResultArray();
  }

  public function get_user_id($nip)
  {
    $builder = $this->db->table('users');
    $builder->select('id');
    $builder->where('nip', $nip);
    $query = $builder->get();
    return $query->getResult()[0];
  }

  // public function get_user_id($email)
  // {
  //   $builder = $this->db->table('users');
  //   $builder->select('id');
  //   $builder->where('email', $email);
  //   $query = $builder->get();
  //   return $query->getResult()[0];
  // }

  public function get_user_nama($id)
  {
    $builder = $this->db->table('users');
    $builder->select('username');
    $builder->where('id', $id);
    $query = $builder->get();
    return $query->getResultArray()[0];
  }
}
