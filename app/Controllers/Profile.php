<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\API\ResponseTrait;

class Profile extends BaseController
{
	use ResponseTrait;
	public function __construct()
    {
		$this->session = session();
		$this->user_m  = new User();
    }
	public function index()
	{
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
			$email =  $this->session->get('email');
			$username =  $this->session->get('username');
			$profile = $this->user_m->where('user.email',$email)
									   ->where('user.username',$username)
									   ->where('user.statusAktif','Aktif')
									   ->where('user.deleted_at is null')
									   ->findAll();
			
			$data = [
				'username' => $profile[0]['username'],
				'email' => $profile[0]['email'],
				'statuspegawai'=> $profile[0]['statuspegawai'],
				'nip'=> $profile[0]['nip'],
				'nohp'=> $profile[0]['nohp'],
				'photo'=> $profile[0]['photo'],
				'userid'=> $profile[0]['id'],
			];
			return view('profile/index',$data);
		}
	}

	public function updateProfile(){
		$isLoggedIn = $this->session->get( 'isLoggedIn' );

		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url('login'));
		} else {
			$username=$this->request->getPost('username');
            $statusPegawai=$this->request->getPost('statusPegawai');
			$nip=$this->request->getPost('nip');
			$nohp = $this->request->getPost('nohp');
			$profileid = $this->request->getPost('profileid');
			$userid = $this->request->getPost('userid');
			$cekFile =$this->request->getFile('photo')->getName();

			if($cekFile != null || $cekFile !=""){
				$file = $this->request->getFile('photo');
				$file->move(ROOTPATH . 'public/img');
				$data=[
					'username'=> $username,
					'statuspegawai'=> $statusPegawai,
					'nip'=> $nip,
					'nohp'=> $nohp,
					'photo'=> $cekFile,
				];

				
				$updateData= $this->user_m->update($userid,$data);
				$sessionArray = [                   
					'level'=> $this->session->get( 'level' ),
					'username'=>$username,
					'email'=> $this->session->get( 'email' ),
					'photo'=>$cekFile,
					'isLoggedIn' => TRUE
				];
			}else{
				$data=[
					'username'=> $username,
					'statuspegawai'=> $statusPegawai,
					'nip'=> $nip,
					'nohp'=> $nohp
				];
				$updateData= $this->user_m->update($userid,$data);
				$sessionArray = [                   
					'level'=> $this->session->get( 'level' ),
					'username'=>$username,
					'email'=> $this->session->get( 'email' ),
					'photo'=> $this->session->get( 'photo' ),
					'isLoggedIn' => TRUE
				];
			}
			
            // return $this->setResponseFormat('json')->respond(['status'=>TRUE]);
            if ($updateData){
				$this->session->set($sessionArray);
                return redirect()->to(base_url('profile'))->with('status', true)->with('message', 'Data successfully update')->with('kode', '200');
            }else{
                return redirect()->to(base_url('profile'))->with('status', false)->with('message', 'Data failed to update')->with('kode', '304');
            }
		}
		
	}
}
