<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\DataTable;
use App\Models\Notif;
use App\Models\Permintaan;
use App\Models\Petugas;
use App\Models\User;
use CodeIgniter\I18n\Time;
use GibberishAES;


class PermintaanSK extends BaseController
{
    use ResponseTrait;
	public function __construct()
    {
		$this->session = session();
		$this->cerip = new GibberishAES();
        $this->dt_m  = new DataTable();
        $this->pn_m  = new Permintaan();
        $this->pt_m  = new Petugas();
        $this->user_m  = new User();
        $this->no_m  = new Notif();
    }

    public function index(){
        $level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 3 || $level == 2 ){
                    $user = $this->user_m->where('deleted_at is null')
                                        ->where('statusAktif','Aktif')
                                        ->findAll();
                    $data = [
                        'user'=>$user
                    ];

                    return view('permintaanSk/index', $data);
            }else{
                return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Ilegal Access');
            }
        }
    }

    public function aktifSk(){
        $level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
           
                    $user = $this->user_m->where('deleted_at is null')
                                        ->where('statusAktif','Aktif')
                                        ->findAll();
                    $data = [
                        'user'=>$user
                    ];

                    return view('permintaanSk/aktif', $data);
           
        }
    }

    public function tidakAktifSK(){
        $level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            
                    $user = $this->user_m->where('deleted_at is null')
                                        ->where('statusAktif','Aktif')
                                        ->findAll();
                    $data = [
                        'user'=>$user
                    ];

                    return view('permintaanSk/tidakAktif', $data);
           
        }
    }


    public function getDataPermintaan()
	{
        $level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 3  || $level == 2){
                $start = $this->request->getGet('start');
                $length = $this->request->getGet('length');
                $draw = $this->request->getGet('draw');
                $search = $this->request->getGet('search');
                $searchValue = $search['value'];
                
                $getData =  $this->dt_m->getDataPermintaan($start,$length, $searchValue);
                $countGetData = $this->dt_m->countDataPermintaan($searchValue);             
             
    
                return $this->setResponseFormat('json')->respond([
                    'draw' => (int) $draw,
                    'recordsTotal' => $countGetData[0]->id,
                    'recordsFiltered' => $countGetData[0]->id,
                    'data' => $getData,
                    'level'=>  $level,
                ]);    
            }else{
                return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Ilegal Access');
            }
			
		}
	}

    public function getDataAktif()
	{
        $level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
           
                $start = $this->request->getGet('start');
                $length = $this->request->getGet('length');
                $draw = $this->request->getGet('draw');
                $search = $this->request->getGet('search');
                $searchValue = $search['value'];
                
                $getData =  $this->dt_m->getDataAktif($start,$length, $searchValue);
                $countGetData = $this->dt_m->countDataAktif($searchValue);             
             
    
                return $this->setResponseFormat('json')->respond([
                    'draw' => (int) $draw,
                    'recordsTotal' => $countGetData[0]->id,
                    'recordsFiltered' => $countGetData[0]->id,
                    'data' => $getData,
                    'level'=>  $level,
                ]);    
            
			
		}
	}

    public function getDataTidakAktif()
	{
        $level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
           
                $start = $this->request->getGet('start');
                $length = $this->request->getGet('length');
                $draw = $this->request->getGet('draw');
                $search = $this->request->getGet('search');
                $searchValue = $search['value'];
                
                $getData =  $this->dt_m->getDataTidakAktif($start,$length, $searchValue);
                $countGetData = $this->dt_m->countDataTidakAktif($searchValue);             
             
    
                return $this->setResponseFormat('json')->respond([
                    'draw' => (int) $draw,
                    'recordsTotal' => $countGetData[0]->id,
                    'recordsFiltered' => $countGetData[0]->id,
                    'data' => $getData,
                    'level'=>  $level,
                ]);    
            
			
		}
	}


    public function saveData(){
        $level = $this->session->get( 'level' );
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 3 ){
                $tentang=$this->request->getPost('tentang');
                $petugas = $this->request->getPost('petugas[]');

                
                    $data = [
                        'tentang' => $tentang,
                        'status' => 'Permohonan',
                        'created_at' => Time::now()
                    ];
                    
                    $createPermintaan = $this->pn_m->insert($data);

                    $getPermintaan = $this->pn_m->where('tentang', $tentang)
                                                ->where('deleted_at is null')
                                                ->findAll(); 
                    $createPermintaan = $this->no_m->insert(['status'=>"Permohonan",'id_sk' => $getPermintaan[0]['id']]);      

                    foreach ($petugas as $value) {
                        
                        $data1=[
                            'id_user' => $value,
                            'id_sk' => $getPermintaan[0]['id'],
                            'created_at' => Time::now()
                        ];

                        $createPermintaan = $this->pt_m->insert($data1);
                    }    

                    if ($createPermintaan){
                        return redirect()->to(base_url('permintaan'))->with('status', true)->with('message', 'Successfully created a new account');
                    }else{
                        return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Failed to create new account');
                    }
                }else{
                    return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Ilegal Access');
                }
        }
    }

    public function delet()
	{
        $level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );

		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url());
		} else {
            if($level == 1 || $level == 3 || $level == 2){
                $id=$this->request->getPost('id');
                $data = [
                    'status' =>'Tidak Aktif',
                    'deleted_at' => Time::now()
                ];
                
                $updateSK = $this->pn_m->update($id,$data);
                $updatePetugas = $this->pt_m->where('id_sk', $id)->set( ['deleted_at' => Time::now()])->update();
                $delet=$this->dt_m->deletNotif($id);
            }else{
                return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Ilegal Access');
            }
            
		}
		
	}

    public function edit(){
        $level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 3 || $level == 2 ){
                $id = $this->request->getPost('id');
                if(isset($id)){
                    $sk = $this->pn_m->where('id',$id)
                                        ->where('deleted_at is null')
                                        ->findAll();
                    $petugas = $this->pt_m->where('id_sk',$id)
                                        ->where('deleted_at is null')
                                        ->findAll();
                    $data= [
                        'sk' => $sk[0],
                        'petugas'=>$petugas
                    ];
                    return $this->setResponseFormat('json')->respond($data);
                }else{
                    return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Failed to get data');
                }
            }else{
                return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Ilegal Access');
            }
		}
	}

    

    public function updateData(){
        $level = $this->session->get( 'level' );
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 3 ){
                $tentang=$this->request->getPost('tentang1');
                $id=$this->request->getPost('id');
                $petugas=$this->request->getPost('petugas1[]');
            
                
                if(isset($id)){
                
                    $data = [
                        'tentang' => $tentang,
                        'updated_at' => Time::now()
                    ];
                    
                    $updatePermintaan = $this->pn_m->update($id,$data);
                    $delet=$this->dt_m->deletPetugas($id);

                    foreach ($petugas as $value) {
                        
                        $data1=[
                            'id_user' => $value,
                            'id_sk' => $id,
                            'created_at' => Time::now()
                        ];

                        $updatePermintaan = $this->pt_m->insert($data1);
                    } 

                            
        
                    if ($updatePermintaan){
                        return redirect()->to(base_url('permintaan'))->with('status', true)->with('message', 'Successfully update   data');
                    }else{
                        return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Failed to update  data');
                    }
                }else{
                    return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Failed to update  data');
                }
            }else{
                return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Ilegal Access');
            }
     
        }
    }

    public function buka(){
        $level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            
                $id = $this->request->getPost('id');
                if(isset($id)){
                    $sk = $this->pn_m->where('id',$id)
                                        ->where('deleted_at is null')
                                        ->findAll();
                    $petugas = $this->user_m->where("id IN (SELECT id_user FROM petugas WHERE id_sk = ".$id." )")
                                        ->where('deleted_at is null')
                                        ->findAll();
                    $data= [
                        'sk' => $sk[0],
                        'petugas'=>$petugas
                    ];
                    return $this->setResponseFormat('json')->respond($data);
                }else{
                    return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Failed to get data');
                }
            
		}
	}

    public function buatSK(){
        $level = $this->session->get( 'level' );
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 2 ){
                $tentang=$this->request->getPost('tentang2');
                $nomor=$this->request->getPost('nomor');
                $id=$this->request->getPost('id');
                $petugas=$this->request->getPost('petugas2[]');
                $cekFile =$this->request->getFile('file')->getName();
         
                
                if(isset($id)){
                    $file = $this->request->getFile('file');
                    $file->move(ROOTPATH . 'public/file');
                    $data = [
                        'no'=>$nomor,
                        'tentang' => $tentang,
                        'file'=>$cekFile,
                        'status'=> 'Aktif',
                        'updated_at' => Time::now()
                    ];
                    
                    $updatePermintaan = $this->pn_m->update($id,$data);
                    $delet=$this->dt_m->deletPetugas($id);
                    $delet=$this->dt_m->deletNotif($id);
                    $createPermintaan = $this->no_m->insert(['status'=>"Aktif",'id_sk' => $id]);


                    foreach ($petugas as $value) {
                        
                        $data1=[
                            'id_user' => $value,
                            'id_sk' => $id,
                            'created_at' => Time::now()
                        ];

                        $updatePermintaan = $this->pt_m->insert($data1);
                    } 

                            
        
                    if ($updatePermintaan){
                        return redirect()->to(base_url('permintaan'))->with('status', true)->with('message', 'Successfully update   data');
                    }else{
                        return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Failed to update  data');
                    }
                }else{
                    $file = $this->request->getFile('file');
                    $file->move(ROOTPATH . 'public/file');
                    $data = [
                        'no'=>$nomor,
                        'tentang' => $tentang,
                        'file'=>$cekFile,
                        'status'=> 'Aktif',
                        'created_at' => Time::now()
                    ];
                    
                    $updatePermintaan = $this->pn_m->insert($data);
                    $sk = $this->pn_m->where('no',$nomor)
                                     ->where('tentang',$tentang)
                                     ->where("status = 'Aktif'")
                                    ->where('deleted_at is null')
                                    ->findAll();
                    $createPermintaan = $this->no_m->insert(['status'=>"Aktif",'id_sk' => $sk[0]['id']]);


                    foreach ($petugas as $value) {
                        
                        $data1=[
                            'id_user' => $value,
                            'id_sk' => $sk[0]['id'],
                            'created_at' => Time::now()
                        ];

                        $updatePermintaan = $this->pt_m->insert($data1);
                    } 

                            
        
                    if ($updatePermintaan){
                        return redirect()->to(base_url('permintaan/aktif'))->with('status', true)->with('message', 'Successfully update   data');
                    }else{
                        return redirect()->to(base_url('permintaan/aktif'))->with('status', false)->with('message', 'Failed to update  data');
                    }
                }
            }else{
                return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Ilegal Access');
            }
     
        }
    }

    public function totalNotif(){
        $level = $this->session->get( 'level' );
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            
                $countPermintaan=$this->dt_m->countNotif('Permohonan',$level);
                $countAktif=$this->dt_m->countNotif('Aktif',$level);
                $countTidakAktif=$this->dt_m->countNotif('Tidak Aktif',$level);
                if($level !=4){
                    $data=[
                        'permintaan'=>  $countPermintaan[0]->count,
                        'aktif'=>  $countAktif[0]->count,
                        'tidak'=>  $countTidakAktif[0]->count,
                    ];
                }else{
                    $data=[
                        'permintaan'=>  0,
                        'aktif'=>  0,
                        'tidak'=> 0,
                    ];
                }
               

               
                return $this->setResponseFormat('json')->respond($data);
             
           
        }
    }

    public function statusNotifPembuatan(){
        $level = $this->session->get( 'level' );
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 2  ){
                $tampung = "";
                if($level == 1){
                    $tampung = "superAdmin"; 
                }else if($level == 2){
                    $tampung = "admin";
                    
                }
             
                $data1=[
                    $tampung => '1'
                ];

                $update=$this->no_m->where('status', 'Permohonan')->set($data1)->update();
                return redirect()->to(base_url('permintaan'));


            }else{
                return redirect()->to(base_url('permintaan'))->with('status', false)->with('message', 'Ilegal Access');
            }
     
        }
    }

    public function statusNotifTidakAktif(){
        $level = $this->session->get( 'level' );
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 3  ){
                $tampung = "";
                if($level == 1){
                    $tampung = "superAdmin"; 
                }else if($level == 2){
                    $tampung = "ketua";
                    
                }
             
                $data1=[
                    $tampung => '1'
                ];

                $update=$this->no_m->where('status', 'Tidak Aktif')->set($data1)->update();
                return redirect()->to(base_url('permintaan/tidakAktif'));


            }else{
                return redirect()->to(base_url('permintaan/tidakAktif'))->with('status', false)->with('message', 'Ilegal Access');
            }
     
        }
    }
    public function updateDataSk(){
        $level = $this->session->get( 'level' );
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 2 ){
                $tentang=$this->request->getPost('tentang1');
                $nomor=$this->request->getPost('nomor1');
                $status=$this->request->getPost('status');
                $id=$this->request->getPost('id');
                
                $petugas=$this->request->getPost('petugas1[]');
                $cekFile =$this->request->getFile('file1')->getName();
                $alasan = NULL;
                if ($status == 'Tidak Aktif'){
                    $alasan=$this->request->getPost('alasan');
                }

                if ($cekFile == '' ||$cekFile == null ){
                    $cekFile=$this->request->getPost('fileold');
                }else{
                    $file = $this->request->getFile('file1');
                    $file->move(ROOTPATH . 'public/file');
                }
                
                if(isset($id)){
                
                    $data = [
                        'no' =>$nomor,
                        'tentang' => $tentang,
                        'file' =>$cekFile,
                        'status' => $status,
                        'alasan' => $alasan,
                        'updated_at' => Time::now()
                    ];
                    
                    $updatePermintaan = $this->pn_m->update($id,$data);
                    $delet=$this->dt_m->deletPetugas($id);
                    if ($status == 'Tidak Aktif'){
                        $createPermintaan = $this->no_m->insert(['status'=>"Tidak Aktif",'id_sk' => $id]);
                        $data2 = [
                            'deleted_at' => Time::now()
                        ];
                        $updatePetugas = $this->pt_m->where('id_sk', $id)->set($data2)->update();
                    }else{

                        foreach ($petugas as $value) {
                        
                            $data1=[
                                'id_user' => $value,
                                'id_sk' => $id,
                                'created_at' => Time::now()
                            ];
    
                            $updatePermintaan = $this->pt_m->insert($data1);
                        } 
    
                    }
                       

                  
                            
        
                    if ($updatePermintaan){
                        return redirect()->to(base_url('permintaan/aktif'))->with('status', true)->with('message', 'Successfully update   data');
                    }else{
                        return redirect()->to(base_url('permintaan/aktif'))->with('status', false)->with('message', 'Failed to update  data');
                    }
                }else{
                    return redirect()->to(base_url('permintaan/aktif'))->with('status', false)->with('message', 'Failed to update  data');
                }
            }else{
                return redirect()->to(base_url('permintaan/aktif'))->with('status', false)->with('message', 'Ilegal Access');
            }
     
        }
    }

}