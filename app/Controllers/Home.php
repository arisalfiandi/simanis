<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\RapatModel;

class Home extends BaseController
{
  public function index(): string
  {
    $model = new RapatModel();
    $id = session()->get('id');
    $data['rapat_mendatang'] = $model->get_num_rapat_mendatang($id);
    $data['rapat_all'] = $model->get_num_rapat_all($id);
    $data['rapat_tujuh'] = $model->get_rapat_tujuh($id);
    $data['rapat_terbaru'] = $model->get_rapat_terbaru($id);
    return view('welcome_message', $data);
  }

  public function pegawai(): string
  {
    $model = new UserModel();
    $data['user'] = $model->get_user();
    return view('pages/pegawai', $data);
  }

  public function sop(): string
  {
    return view('pages/sop');
  }

  public function daftar_rapat(): string
  {
    $model = new RapatModel();
    $id = session()->get('id');
    $keyword = $this->request->getGet('search');
    $data['rapat'] = $model->get_rapat_by_user_id($id, $keyword);
    // $data['rapat'] = $model->select('rapat.*')->join('rapat_pegawai', 'rapat_pegawai.rapat_id = rapat.id')->where('rapat_pegawai.pegawai_id', $id)->paginate(15);
    $data['pager'] = $model->pager;
    return view('pages/daftar-rapat', $data);
  }

  public function daftar_rapat_tabel(): string
  {
    $model = new RapatModel();
    $id = session()->get('id');
    $data['rapat'] = $model->get_rapat_by_user_id($id);
    return view('pages/tabel-rapat', $data);
  }

  public function detail_rapat(): string
  {
    $request = \Config\Services::request();
    $id = $request->uri->getSegment(3);
    $model = new RapatModel();
    $data['detail'] = $model->get_rapat_by_id($id);
    return view('pages/detail-rapat', $data);
  }

  public function monitoring_rapat(): string
  {
    $model = new RapatModel();
    $data['rapat'] = $model->get_rapat_not_complete();
    return view('pages/monitoring-rapat', $data);
  }

  public function buat_undangan_rapat(): string
  {
    $model = new UserModel();
    $data['userNotId'] = $model->get_user_not_id(session()->get('id'));
    $data['user'] = $model->get_user();
    
    return view('pages/buat-undangan-rapat', $data);
  }

  public function login(): string
  {
    return view('pages/login');
  }

  public function unauth(): string
  {
    return view('401');
  }

  public function unpermis(): string
  {
    return view('403');
  }

  public function notfound(): string
  {
    return view('404');
  }

  public function register(): string
  {
    return view('pages/register');
  }
}
