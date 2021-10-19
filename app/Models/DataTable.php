<?php

namespace App\Models;
use CodeIgniter\Database\BaseBuilder;

class DataTable{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        //untuk print query getCompiledSelect()
    }

    public function getDataRole($star,$lengt,$search){
        $builder = $this->db->table('user');
        $builder->select('id,email,username,level,nip,statusAktif, (@rownum:=@rownum + 1) AS rownum ');
        if ($search != "" || $search != null){
            $builder->where("( email LIKE '%".$search."%' OR username LIKE '%".$search."%' OR  level LIKE '%".$search."%' OR nip LIKE '%".$search."%' ) ");
        }
        $builder->where("statusAktif = 'Aktif'");
        $builder->where('deleted_at is null');
        $builder->from( '(SELECT @rownum := '.$star.') as r');
        $query = $builder->get($lengt,$star);
        return $query->getResult();

    }

    public function countDataRole($search){
        $builder = $this->db->table('user');
        if ($search != "" || $search != null){
            $builder->where("( email LIKE '%".$search."%' OR username LIKE '%".$search."%' OR  level LIKE '%".$search."%' OR nip LIKE '%".$search."%' ) ");
        }
        $builder->selectCount('id');
        $builder->where("statusAktif = 'Aktif'");
        $builder->where('deleted_at is null');
        $query = $builder-> get();
        return $query->getResult();

    }


    public function getData($star,$lengt,$search,$status){
        $builder = $this->db->table('user');
        $builder->select('id,email,username,nip,nohp,statusAktif, (@rownum:=@rownum + 1) AS rownum ');
        if ($search != "" || $search != null){
            $builder->where("( email LIKE '%".$search."%' OR username LIKE '%".$search."%' OR  level LIKE '%".$search."%' OR nip LIKE '%".$search."%' ) ");
        }
        $builder->where("statuspegawai = '".$status."'");
        // $builder->where("statusAktif = 'Aktif'");
        $builder->where('deleted_at is null');
        $builder->from( '(SELECT @rownum := '.$star.') as r');
        $query = $builder->get($lengt,$star);
        return $query->getResult();

    }

    public function countData($search,$status){
        $builder = $this->db->table('user');
        if ($search != "" || $search != null){
            $builder->where("( email LIKE '%".$search."%' OR username LIKE '%".$search."%' OR  level LIKE '%".$search."%' OR nip LIKE '%".$search."%' ) ");
        }
        $builder->selectCount('id');
        $builder->where("statuspegawai = '".$status."'");
        // $builder->where("statusAktif = 'Aktif'");
        $builder->where('deleted_at is null');
        $query = $builder-> get();
        return $query->getResult();

    }

    public function getDataPermintaan($star,$lengt,$search){
        $builder = $this->db->table('suratkeputusan');
        $builder->select('id,tentang, (@rownum:=@rownum + 1) AS rownum ');
        if ($search != "" || $search != null){
            $builder->where("( tentang LIKE '%".$search."%' ) ");
        }
        $builder->where("status = 'Permohonan'");
        $builder->where('deleted_at is null');
        $builder->orderBy('created_at', 'DESC');
        $builder->from( '(SELECT @rownum := '.$star.') as r');

        $query = $builder->get($lengt,$star);
        return $query->getResult();

    }

    public function countDataPermintaan($search){
        $builder = $this->db->table('suratkeputusan');
        if ($search != "" || $search != null){
            $builder->where("( tentang LIKE '%".$search."%' ) ");
        }
        $builder->selectCount('id');
        $builder->where("status = 'Permohonan'");
        $builder->where('deleted_at is null');
        $builder->orderBy('created_at', 'DESC');
        $query = $builder-> get();
        return $query->getResult();

    }

    public function deletPetugas($idsk){
        $builder = $this->db->table('petugas');
        $builder->delete(['id_sk' => $idsk]);

    }

    public function deletNotif($idsk){
        $builder = $this->db->table('notif');
        $builder->delete(['id_sk' => $idsk]);

    }


    public function countNotif($search,$level){
        
        $builder = $this->db->table('notif');
        $builder->select('count(id) as count');
        if($level == 1){
            $builder->where("superAdmin != 1");
        }else if ($level == 2){
            $builder->where("admin != 1");
        }else if ($level == 3){
            $builder->where("ketua != 1");
        }
        $builder->where("status = '".$search."'");
        $builder->where('deleted_at is null');
        $query = $builder-> get();
        return $query->getResult();

    }


    public function getDataAktif($star,$lengt,$search){
        $builder = $this->db->table('suratkeputusan');
        $builder->select('id,tentang,no, file,alasan, (@rownum:=@rownum + 1) AS rownum ');
        if ($search != "" || $search != null){
            $builder->where("( tentang LIKE '%".$search."%' OR no LIKE '%".$search."%'  ) ");
        }
        $builder->where("status = 'Aktif'");
        $builder->where('deleted_at is null');
        $builder->orderBy('created_at', 'DESC');
        $builder->from( '(SELECT @rownum := '.$star.') as r');

        $query = $builder->get($lengt,$star);
        return $query->getResult();

    }

    public function countDataAktif($search){
        $builder = $this->db->table('suratkeputusan');
        if ($search != "" || $search != null){
            $builder->where("( tentang LIKE '%".$search."%' OR no LIKE '%".$search."%'  ) ");
        }
        $builder->selectCount('id');
        $builder->where("status = 'Aktif'");
        $builder->where('deleted_at is null');
        $builder->orderBy('created_at', 'DESC');
        $query = $builder-> get();
        return $query->getResult();

    }

    public function getDataTidakAktif($star,$lengt,$search){
        $builder = $this->db->table('suratkeputusan');
        $builder->select('id,tentang,no, file,alasan, (@rownum:=@rownum + 1) AS rownum ');
        if ($search != "" || $search != null){
            $builder->where("( tentang LIKE '%".$search."%' OR no LIKE '%".$search."%'  ) ");
        }
        $builder->where("status = 'Tidak Aktif'");
        $builder->where('deleted_at is null');
        $builder->orderBy('created_at', 'DESC');
        $builder->from( '(SELECT @rownum := '.$star.') as r');

        $query = $builder->get($lengt,$star);
        return $query->getResult();

    }

    public function countDataTidakAktif($search){
        $builder = $this->db->table('suratkeputusan');
        if ($search != "" || $search != null){
            $builder->where("( tentang LIKE '%".$search."%' OR no LIKE '%".$search."%'  ) ");
        }
        $builder->selectCount('id');
        $builder->where("status = 'Tidak Aktif'");
        $builder->where('deleted_at is null');
        $builder->orderBy('created_at', 'DESC');
        $query = $builder-> get();
        return $query->getResult();

    }
}