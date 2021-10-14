<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DataTable;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use GibberishAES;
class Pegawai extends BaseController
{
	use ResponseTrait;
	public function __construct()
    {
		$this->session = session();
		$this->dt_m  = new DataTable();
		$this->user_m  = new User();
		$this->cerip = new GibberishAES();
    }

	public function index()
	{
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
			return view('pegawai/pegawai/index');
		}
	}

	public function getDataPegawai()
	{
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
			$start = $this->request->getGet('start');
            $length = $this->request->getGet('length');
            $draw = $this->request->getGet('draw');
            $search = $this->request->getGet('search');
			$searchValue = $search['value'];
			
            $getData =  $this->dt_m->getData($start,$length, $searchValue, 'Pegawai');
            $countGetData = $this->dt_m->countData($searchValue, 'Pegawai');             
         

            return $this->setResponseFormat('json')->respond([
                'draw' => (int) $draw,
                'recordsTotal' => $countGetData[0]->id,
                'recordsFiltered' => $countGetData[0]->id,
                'data' => $getData,
            ]);
			

		}
	}

	public function checkEmail(){
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            $email=$this->request->getPost('email');
			if($email == ''||$email==null){
				$email=$this->request->getPost('email1');
			}
			
            $user = $this->user_m->where('email',$email)
                                ->where('user.statusAktif','Aktif')
                                ->where('user.deleted_at is null')
                                ->findAll();
            if (count($user) > 0){
                $return =  false;
            }else{
                $return =  true;
            }
            echo json_encode($return);
            exit;
        }
       
    }

	public function saveData(){
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            $username=$this->request->getPost('username');
            $nip = $this->request->getPost('nip');
            $email=$this->request->getPost('email');
            $statusPegawai = 'Pegawai';
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
                    return redirect()->to(base_url('pegawai'))->with('status', true)->with('message', 'Successfully created a new account');
                }else{
                    return redirect()->to(base_url('pegawai'))->with('status', false)->with('message', 'Failed to create new account');
                }
            }else{
                return redirect()->to(base_url('pegawai'))->with('status', false)->with('message', 'Failed to create new account');
            }
        }
    }

	public function edit(){
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
			$id = $this->request->getPost('id');
			if(isset($id)){
				$user = $this->user_m->where('user.id',$id)
									   ->where('user.statusAktif','Aktif')
									   ->where('user.deleted_at is null')
									   ->findAll();
				return $this->setResponseFormat('json')->respond($user);
			}else{
				return redirect()->to(base_url('pegawai'))->with('status', false)->with('message', 'Failed to get data');
			}

		}
	}

	public function updateData(){
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
            $username=$this->request->getPost('username1');
            $nip = $this->request->getPost('nip1');
            $email=$this->request->getPost('email1');
            $nohp=$this->request->getPost('nohp1');
			$id=$this->request->getPost('id');
        
            
            if(isset($email)){
            
                $data = [
                    'username' => $username,
                    'email' => $email,
                    'nip' => $nip,
					'nohp' => $nohp,
                    'updated_at' => Time::now()
                ];
                
                $updateUser = $this->user_m->update($id,$data);
           
       
                if ($updateUser){
                    return redirect()->to(base_url('pegawai'))->with('status', true)->with('message', 'Successfully update a  account');
                }else{
                    return redirect()->to(base_url('pegawai'))->with('status', false)->with('message', 'Failed to update  account');
                }
            }else{
                return redirect()->to(base_url('pegawai'))->with('status', false)->with('message', 'Failed to update  account');
            }
        }
    }

	public function delet()
	{
		$isLoggedIn = $this->session->get( 'isLoggedIn' );

		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url());
		} else {
            $id=$this->request->getPost('id');
			$data = [
				'deleted_at' => Time::now()
			];
			
			$updateUser = $this->user_m->update($id,$data);
		}
		
	}

}
