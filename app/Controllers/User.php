<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\UserGroupModel;

class User extends BaseController
{
  use ResponseTrait;

  public function login()
  {
    $session = \Config\Services::session();
    $model = new UserModel();
    $password = $this->request->getVar('password');
    $nip = $this->request->getVar('nip');
    $user = $model->where("nip", $nip)->first();
    if (!$user) return $this->failNotFound('NIP Not Found');

    // $verify = password_verify($this->request->getVar('password'), $user['password']);
    if ($user['password'] == $password) {
      $session->set('nip', $nip);
      $id_string = (array)$model->get_user_id($nip);
      $id = intval($id_string['id']);
      session()->set('id', $id);
      session()->set('nip', $nip);
      return redirect()->to('/');
    } else return $this->fail('Wrong Password');
  }

  public function hapus_pegawai($id)
  {
    $model = new UserModel();
    $model->delete_user($id);
    session()->setFlashdata("informasi", "<script>Swal.fire(
      'Berhasil!',
      'Berhasil menghapus user!',
      'success'
    )</script>");
    return redirect()->to('/pegawai');
  }

  public function update_to_ketuatim($user_id){
    $model = new UserGroupModel();
    $model->update_role($user_id, 2);
    session()->setFlashdata("informasi", "<script>Swal.fire(
      'Berhasil!',
      'Berhasil mengubah user menjadi ketua tim!',
      'success'
    )</script>");
    return redirect()->to('/pegawai');
  }

  public function update_to_pegawai($user_id){
    $model = new UserGroupModel();
    $model->update_role($user_id, 3);
    session()->setFlashdata("informasi", "<script>Swal.fire(
      'Berhasil!',
      'Berhasil mengubah user menjadi pegawai!',
      'success'
    )</script>");
    return redirect()->to('/pegawai');
  }
}
