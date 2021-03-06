<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DataTable;
use App\Models\Notif;
use App\Models\Permintaan;
use App\Models\Petugas;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use GibberishAES;
class Honor extends BaseController
{
	use ResponseTrait;
	public function __construct()
    {
		$this->session = session();
		$this->dt_m  = new DataTable();
        $this->pn_m  = new Permintaan();
        $this->pt_m  = new Petugas();
        $this->user_m  = new User();
        $this->no_m  = new Notif();
		$this->cerip = new GibberishAES();
    }

	public function index()
	{
        $level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 2 || $level ==3){
			    return view('pegawai/honor/index');
            }else{
                return redirect()->to(base_url('honor'))->with('status', false)->with('message', 'Ilegal Access');
            }
		}
	}

	public function getDataHonor()
	{
        $level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 2 || $level ==3){
                $start = $this->request->getGet('start');
                $length = $this->request->getGet('length');
                $draw = $this->request->getGet('draw');
                $search = $this->request->getGet('search');
                $searchValue = $search['value'];
                
                $getData =  $this->dt_m->getData($start,$length, $searchValue, 'Honor');
                $countGetData = $this->dt_m->countData($searchValue, 'Honor');             
            

                return $this->setResponseFormat('json')->respond([
                    'draw' => (int) $draw,
                    'recordsTotal' => $countGetData[0]->id,
                    'recordsFiltered' => $countGetData[0]->id,
                    'data' => $getData,
                ]);
            }else{
                return redirect()->to(base_url('honor'))->with('status', false)->with('message', 'Ilegal Access');
            }

		}
	}


	public function saveData(){
        $level = $this->session->get( 'level' );
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 2){
                $username=$this->request->getPost('username');
                $nip = $this->request->getPost('nip');
                $email=$this->request->getPost('email');
                $statusPegawai = 'Honor';
                $nohp=$this->request->getPost('nohp');
            
                
                if(isset($email)){
                
                    $data = [
                        'username' => $username,
                        'email' => $email,
                        'password'=> $this->cerip->encrypt_data($email),
                        'level' => 4,
                        'statuspegawai'=> $statusPegawai,
                        'nip' => $nip,
                        'nohp' => $nohp,
                        'photo'=> 'user.png',
                        'statusAktif' => 'Aktif',
                        'created_at' => Time::now()
                    ];
                    
                    $createUser = $this->user_m->insert($data);
            
        
                    if ($createUser){
                        return redirect()->to(base_url('honor'))->with('status', true)->with('message', 'Successfully created a new account');
                    }else{
                        return redirect()->to(base_url('honor'))->with('status', false)->with('message', 'Failed to create new account');
                    }
                }else{
                    return redirect()->to(base_url('honor'))->with('status', false)->with('message', 'Failed to create new account');
                }
            }else{
                return redirect()->to(base_url('honor'))->with('status', false)->with('message', 'Ilegal Access');
            }
        }
    }

	public function edit(){
        $level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 2){
                $id = $this->request->getPost('id');
                if(isset($id)){
                    $user = $this->user_m->where('user.id',$id)
                                        //    ->where('user.statusAktif','Aktif')
                                        ->where('user.deleted_at is null')
                                        ->findAll();
                    return $this->setResponseFormat('json')->respond($user);
                }else{
                    return redirect()->to(base_url('honor'))->with('status', false)->with('message', 'Failed to get data');
                }
            }else{
                return redirect()->to(base_url('honor'))->with('status', false)->with('message', 'Ilegal Access');
            }
		}
	}

	public function updateData(){
        $level = $this->session->get( 'level' );
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            if($level == 1 || $level == 2){
                $username=$this->request->getPost('username1');
                $nip = $this->request->getPost('nip1');
                $email=$this->request->getPost('email1');
                $nohp=$this->request->getPost('nohp1');
                $id=$this->request->getPost('id');
                $statusAktif=$this->request->getPost('statusAktif');
            
                
                if(isset($email)){
                
                    if($statusAktif == 'Aktif'){
                        $data = [
                            'username' => $username,
                            'email' => $email,
                            'nip' => $nip,
                            'nohp' => $nohp,
                            'statusAktif'=> $statusAktif,
                            'updated_at' => Time::now()
                        ];
                    }else{
                            $data = [
                                'username' => $username,
                                'email' => $email,
                                'nip' => $nip,
                                'nohp' => $nohp,
                                'statusAktif'=> $statusAktif,
                                'updated_at' => Time::now()
                            ];
                            $surat = $this->pn_m->where("id IN (SELECT id_sk FROM petugas WHERE id_user = ".$id."  AND deleted_at is null )")
                            ->where('deleted_at is null')
                            ->findAll();

                            foreach ($surat as $value) {
                                // print_r($value['id']);
                                        $user = $this->user_m->where('id',$id)
                                                    ->where('deleted_at is null')
                                                    ->findAll();
                                        $data1 = [
                                            'status'=>'Tidak Aktif',
                                            'alasan' => "Petugas ".$user[0]['nip']." - ".$user[0]['username']." Telah di Hapus/Tidak Aktif lagi",
                                            'updated_at' => Time::now()
                                        ];
                                        if($value['no'] == '' || $value['no'] == null ){
                                            $updateSK = $this->pn_m->update($value['id'],['status' =>'Tidak Aktif','deleted_at' => Time::now()]);
                                            $updatePetugas = $this->pt_m->where('id_sk', $value['id'])->set( ['deleted_at' => Time::now()])->update();
                                            $delet=$this->dt_m->deletNotif($value['id']);
                                        }else{
                                            $updateSk = $this->pn_m->update($value['id'],$data1);
                                            $updatePetugas = $this->pt_m->where('id_sk',$value['id'])->set( ['deleted_at' => Time::now()])->update();
                                            $createPermintaan = $this->no_m->insert(['status'=>"Tidak Aktif",'id_sk' => $value['id']]); 
                                        } 
                                }

                    }
                  
                    
                    $updateUser = $this->user_m->update($id,$data);
            
        
                    if ($updateUser){
                        return redirect()->to(base_url('honor'))->with('status', true)->with('message', 'Successfully update a  account');
                    }else{
                        return redirect()->to(base_url('honor'))->with('status', false)->with('message', 'Failed to update  account');
                    }
                }else{
                    return redirect()->to(base_url('honor'))->with('status', false)->with('message', 'Failed to update  account');
                }
            }else{
                return redirect()->to(base_url('honor'))->with('status', false)->with('message', 'Ilegal Access');
            }
        }
    }

	public function delet()
	{
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
        $level = $this->session->get( 'level' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url());
		} else {
            if($level == 1 || $level == 2){
                $id=$this->request->getPost('id');
                $data = [
                    'deleted_at' => Time::now()
                ];
                $surat = $this->pn_m->where("id IN (SELECT id_sk FROM petugas WHERE id_user = ".$id."  AND deleted_at is null )")
                                    ->where('deleted_at is null')
                                    ->findAll();
                foreach ($surat as $value) {
                        // print_r($value['id']);
                        $user = $this->user_m->where('id',$id)
                                    ->where('deleted_at is null')
                                    ->findAll();
                        $data1 = [
                            'status'=>'Tidak Aktif',
                            'alasan' => "Petugas ".$user[0]['nip']." - ".$user[0]['username']." Telah di Hapus/Tidak Aktif lagi",
                            'updated_at' => Time::now()
                        ];
                        if($value['no'] == '' || $value['no'] == null ){
                            $updateSK = $this->pn_m->update($value['id'],['status' =>'Tidak Aktif','deleted_at' => Time::now()]);
                            $updatePetugas = $this->pt_m->where('id_sk', $value['id'])->set( ['deleted_at' => Time::now()])->update();
                            $delet=$this->dt_m->deletNotif($value['id']);
                        }else{
                            $updateSk = $this->pn_m->update($value['id'],$data1);
                            $updatePetugas = $this->pt_m->where('id_sk',$value['id'])->set( ['deleted_at' => Time::now()])->update();
                            $createPermintaan = $this->no_m->insert(['status'=>"Tidak Aktif",'id_sk' => $value['id']]); 
                        }
                }
                $updateUser = $this->user_m->update($id,$data);
            }else{
                return redirect()->to(base_url('honor'))->with('status', false)->with('message', 'Ilegal Access');
            }
		}
		
	}

}
