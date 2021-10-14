<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DataTable;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;

class Role extends BaseController
{
	use ResponseTrait;
	public function __construct()
    {
		$this->session = session();
		$this->dt_m  = new DataTable();
		$this->user_m  = new User();
    }

	public function index()
	{
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		$level = $this->session->get( 'level' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
			if($level==1){
				return view('role/index');
			}else{
				return redirect()->to(base_url('profile'))->with('status', false)->with('message', 'Ilegal Access');
			}
			
		}
	}

	public function getDataRole()
	{
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		$level = $this->session->get( 'level' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
			if($level==1){
				$start = $this->request->getGet('start');
				$length = $this->request->getGet('length');
				$draw = $this->request->getGet('draw');
				$search = $this->request->getGet('search');
				$searchValue = $search['value'];
				
				$getData =  $this->dt_m->getDataRole($start,$length, $searchValue);
				$countGetData = $this->dt_m->countDataRole($searchValue);             
			

				return $this->setResponseFormat('json')->respond([
					'draw' => (int) $draw,
					'recordsTotal' => $countGetData[0]->id,
					'recordsFiltered' => $countGetData[0]->id,
					'data' => $getData,
				]);
			}else{
					return redirect()->to(base_url('profile'))->with('status', false)->with('message', 'Ilegal Access');
			}
		}
	}

	public function editLevel()
	{
		$level = $this->session->get( 'level' );
		$isLoggedIn = $this->session->get( 'isLoggedIn' );
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE ) {
			return redirect()->to(base_url(''));
		}else{
			if($level==1){
				$name = $this->request->getPost('name');
				$id = $this->request->getPost('pk');
				$value = $this->request->getPost('value');
				
				$data = [
					$name => $value,
				];
				
				$update= $this->user_m->update($id, $data);

				if ($update){
					echo json_encode('Data Berhasil di ubah');
					exit;
				}else{
					echo json_encode('Data Gagal di ubah');
					exit; 
				}
			}else{
				return redirect()->to(base_url('profile'))->with('status', false)->with('message', 'Ilegal Access');
			}

		}
	}
}
