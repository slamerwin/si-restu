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
}