<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class RapatModel extends Model
{
  protected $DBGroup = 'default';
  protected $table = 'rapat';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $insertID = 0;
  protected $returnType = 'array';
  protected $useSoftDeletes = false;
  protected $protectFields = true;
  protected $allowedFields = ['id', 'nama', 'tempat', 'tanggal', 'waktu_mulai', 'waktu_akhir', 'jenis_rapat_biaya', 'jenis_rapat_mitra', 'jumlah_mitra', 'notula_id', 'dokum_id', 'notula', 'atk', 'dokum_link', 'is_complete'];

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

  public function create_rapat($data)
  {
    // create random rapat id with number and letter and check if already exist
    $character_rapat_id = '0123456789abcdefghijklmnopqrstuvwxyz';
    $rapat_id = '';
    for ($i = 0; $i < 8; $i++) {
      $rapat_id .= $character_rapat_id[rand(0, strlen($character_rapat_id) - 1)];
    }

    $data_rapat = [
      'id' => $rapat_id,
      'nama' => $data['nama'],
      'tempat' => $data['tempat'],
      'tanggal' => $data['tanggal'],
      'waktu_mulai' => $data['waktu_mulai'],
      'jenis_rapat_biaya' => $data['jenis_rapat_biaya'],
      'jenis_rapat_mitra' => $data['jenis_rapat_mitra'],
      'jumlah_mitra' => $data['jumlah_mitra'],
      'notula_id' => $data['notula_id'],
      'dokum_id' => $data['dokum_id'],
      'created_id' => $data['created_id'],
    ];
    if($data['waktu_akhir']){
      $data_rapat['waktu_akhir'] = $data['waktu_akhir'];
    }
    $this->db->table('rapat')->insert($data_rapat);

    for ($i = 0; $i < count($data['peserta']); $i++) {
      $this->db->table('rapat_pegawai')->insert([
        'rapat_id' => $rapat_id,
        'pegawai_id' => $data['peserta'][$i],
      ]);
    }

    for ($i = 0; $i < count($data['tembusan']); $i++) {
      $this->db->table('rapat_tembusan')->insert([
        'rapat_id' => $rapat_id,
        'tembusan' => $data['tembusan'][$i],
      ]);
    }

    return $data = [
      'rapat_id' => $rapat_id,
      'nama' => $data['nama'],
    ];
  }

  public function get_rapat_by_user_id($id, $keyword = null)
  {
    $builder = $this->db->table('rapat');
    $builder->select('rapat.*');
    $builder->join('rapat_pegawai', 'rapat_pegawai.rapat_id = rapat.id');
    $builder->where('rapat_pegawai.pegawai_id', $id);
    if ($keyword != '') {
      $builder->like('rapat.nama', $keyword);
      $builder->orLike('rapat.tanggal', $keyword);
      $builder->orLike('rapat.tempat', $keyword);
    }
    $builder->orderBy('tanggal', 'DESC');
    $query = $builder->get();
    return $query->getResultArray();
  }

  // public function get_rapat_by_nip($nip)
  // {
  //   $builder = $this->db->table('rapat');
  //   $builder->join('rapat_pegawai', 'rapat_pegawai.rapat_id = rapat.id');
  //   $builder->where('rapat_pegawai.nip', $nip);
  //   $query = $builder->get();
  //   return $query->getResultArray();
  // }

  public function get_rapat_by_id($id)
  {
    $builder = $this->db->table('rapat');
    $builder->where('id', $id);
    $query = $builder->get()->getRowArray();
    return $query;
  }

  public function get_rapat_all()
  {
    $builder = $this->db->table('rapat');
    $builder->orderBy('tanggal', 'DESC');
    $query = $builder->get();
    return $query->getResultArray();
  }

  public function get_num_rapat_mendatang($id)
  {
    $builder = $this->db->table('rapat');
    $builder->select('rapat.*');
    $builder->join('rapat_pegawai', 'rapat_pegawai.rapat_id = rapat.id');
    $builder->where('rapat_pegawai.pegawai_id', $id);
    $builder->where('rapat.tanggal >', date('Y-m-d'));
    $query = $builder->get();
    return $query->getNumRows();
  }

  public function get_num_rapat_all($id)
  {
    $builder = $this->db->table('rapat');
    $builder->select('rapat.*');
    $builder->join('rapat_pegawai', 'rapat_pegawai.rapat_id = rapat.id');
    $builder->where('rapat_pegawai.pegawai_id', $id);
    $query = $builder->get();
    return $query->getNumRows();
  }

  public function get_rapat_tujuh($id)
  {
    $builder = $this->db->table('rapat');
    $builder->select('rapat.*');
    $builder->join('rapat_pegawai', 'rapat_pegawai.rapat_id = rapat.id');
    $builder->where('rapat_pegawai.pegawai_id', $id);
    $builder->where('rapat.tanggal <', date('Y-m-d'));
    $builder->orderBy('tanggal', 'DESC');
    $builder->limit(7);
    $query = $builder->get();
    return $query->getResultArray();
  }

  public function get_rapat_terbaru($id)
  {
    $builder = $this->db->table('rapat');
    $builder->select('rapat.*');
    $builder->join('rapat_pegawai', 'rapat_pegawai.rapat_id = rapat.id');
    $builder->where('rapat_pegawai.pegawai_id', $id);
    $builder->where('rapat.tanggal >', date('Y-m-d'));
    $builder->orderBy('tanggal', 'DESC');
    $builder->limit(1);
    $query = $builder->get();
    // return $query->getResultArray()[0];
    return $query->getResultArray();
  }

  public function get_rapat_not_complete()
  {
    $builder = $this->db->table('rapat');
    $builder->where('is_complete', 0);
    $query = $builder->get();
    return $query->getResultArray();
  }

  public function delete_rapat($id_rapat)
  {
    $builder = $this->db->table('rapat');
    $builder->where('id', $id_rapat);
    $builder->delete();
  }

  public function upload_daftar($id, $nama_link)
  {
    $builder = $this->db->table('rapat');
    $builder->where('id', $id);
    $builder->update(['daftar_hadir' => $nama_link]);
  }

  public function upload_atk($id, $nama_link)
  {
    $builder = $this->db->table('rapat');
    $builder->where('id', $id);
    $builder->update(['atk' => $nama_link]);
  }

  public function upload_dokum_link($id, $nama_link)
  {
    $builder = $this->db->table('rapat');
    $builder->where('id', $id);
    $builder->update(['dokum_link' => $nama_link]);
  }

  public function upload_notula($id, $nama_link)
  {
    $builder = $this->db->table('rapat');
    $builder->where('id', $id);
    $builder->update(['notula' => $nama_link]);
  }

  public function upload_surat_undangan($id, $nama_link)
  {
    $builder = $this->db->table('rapat');
    $builder->where('id', $id);
    $builder->update(['surat_undangan' => $nama_link]);
  }

  public function upload_kak($id, $nama_link)
  {
    $builder = $this->db->table('rapat');
    $builder->where('id', $id);
    $builder->update(['kak' => $nama_link]);
  }

  public function upload_transport($id, $nama_link)
  {
    $builder = $this->db->table('rapat');
    $builder->where('id', $id);
    $builder->update(['transport' => $nama_link]);
  }
}
