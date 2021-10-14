<?php

namespace App\Controllers;

use App\Models\Profile;
use App\Models\Token;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use Exception;
use GibberishAES;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Auth extends BaseController{
    use ResponseTrait;
    public function __construct()
    {
		$this->session = session();
        $this->user_m  = new User();
        $this->token_m = new Token();
        $this->cerip = new GibberishAES();
    }

    public function index(){
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (  isset ( $isLoggedIn ) || $isLoggedIn == TRUE ) {
			return redirect()->to(base_url('profile'));
		}else{
            return view('auth/login');
        }
    }

    public function process(){
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (  isset ( $isLoggedIn ) || $isLoggedIn == TRUE ) {
			return redirect()->to(base_url('profile'));
		}else{
            $email=$this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            if(isset($email)){
                $user = $this->user_m->where('email',$email)
                                    ->where('password', $this->cerip->encrypt_data($password))
                                    ->where('deleted_at is null')
                                    ->where('statusAktif','Aktif')
                                    ->findAll();

               
                if(count($user) > 0){
                   
                    $sessionArray = [                   
                        'level'=>$user[0]['level'],
                        'username'=>$user[0]['username'],
                        'email'=>$user[0]['email'],
                        'photo'=>$user[0]['photo'],
                        'isLoggedIn' => TRUE
                    ];
                    
                    $this->session->set($sessionArray);
                    return redirect()->to(base_url('profile'));
                }else{
                    return redirect()->to(base_url(''))->with('status', false)->with('message', 'email and password not match');
                }
            }
        }
    }

    public function logout(){
		$this->session->destroy();
		return redirect()->to(base_url(''));
	}

    public function checkEmail(){
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (  isset ( $isLoggedIn ) || $isLoggedIn == TRUE ) {
			return redirect()->to(base_url('profile'));
		}else{
            $email=$this->request->getGet('email');
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

    public function registrasi(){
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (  isset ( $isLoggedIn ) || $isLoggedIn == TRUE ) {
			return redirect()->to(base_url('profile'));
		}else{
            return view('auth/registrasi');
        }
	}

    public function regis(){
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (  isset ( $isLoggedIn ) || $isLoggedIn == TRUE ) {
			return redirect()->to(base_url('profile'));
		}else{
            $username=$this->request->getPost('username');
            $password = $this->request->getPost('password');
            $email=$this->request->getPost('email');
            $statusPegawai = $this->request->getPost('statusPegawai');
            $nip=$this->request->getPost('nip');
        
            
            if(isset($email)){
            
                $data = [
                    'username' => $username,
                    'email' => $email,
                    'password'=> $this->cerip->encrypt_data( $password),
                    'level' => 4,
                    'statuspegawai'=> $statusPegawai,
                    'nip' => $nip,
                    'photo'=> 'user.png',
                    'statusAktif' => 'Aktif',
                    'created_at' => Time::now()
                ];
                
                $createUser = $this->user_m->insert($data);
           
       
                if ($createUser){
                    return redirect()->to(base_url(''))->with('status', true)->with('message', 'Successfully created a new account');
                }else{
                    return redirect()->to(base_url('registrasi'))->with('status', false)->with('message', 'Failed to create new account');
                }
            }else{
                return redirect()->to(base_url('registrasi'))->with('status', false)->with('message', 'Failed to create new account');
            }
        }
    }

    public function forgotPassword(){
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (  isset ( $isLoggedIn ) || $isLoggedIn == TRUE ) {
			return redirect()->to(base_url('profile'));
		}else{
            return view('auth/forgotPassword');
        }
    }


    public function sendEmail($email,$token){
	
        $mail = new PHPMailer(true);
 
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.googlemail.com';   
            $mail->SMTPAuth   = true;
            $mail->Username   = 'slamerwin@gmail.com'; // silahkan ganti dengan alamat email Anda
            $mail->Password   = '081312080294'; // silahkan ganti dengan password email Anda
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
 
            $mail->setFrom('admin@gmail.com', 'Admin Sistem'); // silahkan ganti dengan alamat email Anda
            $mail->addAddress($email);
            $mail->addReplyTo('admin@gmail.com', 'Admin Sistem'); // silahkan ganti dengan alamat email Anda
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password';
            $mail->Body    = 'Click this link to reset your password : <a href="'.base_url('forgotpassword/ceng').'?token='.urlencode($token).'"> Reset Password </a>';
 
            $mail->send();
            
        } catch (Exception $e) {
            dd('error', "Send Email failed. Error: ".$mail->ErrorInfo);
            
        }
		
	}

    public function kirimToken(){
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (  isset ( $isLoggedIn ) || $isLoggedIn == TRUE ) {
			return redirect()->to(base_url('profile'));
		}else{
            $token = base64_encode(random_bytes(32));
            $email = $this->request->getPost('email');
            $log= $this->user_m->select('COUNT(user.id) as count')									   
                                ->where('user.email',$email)
                                ->where('user.statusAktif','Aktif')       
                                ->where('user.deleted_at is null')
                                ->findAll();
            // dd($log[0]->count);
            if ($log[0]['count'] != 0){
                $this->sendEmail($email,$token);
                $data1 = [
                    'email'=> $email,
                    'token' => $token,
                    'status'=> 0,
                    'created_at' => Time::now()
                ];
                $creatToken = $this->token_m->insert($data1);
                return redirect()->to(base_url('forgotpassword'))->with('status', true)->with('message', 'Plase check your email to reset your password')->with('kode', '304');
            }else{
                return redirect()->to(base_url('forgotpassword'))->with('status', false)->with('message', 'Your email was not found')->with('kode', '304');
            }

        }
    }


     public function ganti(){
		$token = $this->request->getGet('token');
		$log= $this->token_m->select('COUNT(token.id) as count, token.email')
                            ->where('token',$token)
                            ->where('status',0)
                            ->where('token.deleted_at is null')
                            ->findAll();
		if ($log[0]['count'] != 0 ) {
			$data = [                   
				'email'=>$log[0]['email'],
			];
			return view('auth/recoverPassword',$data);
		} else {
			return redirect()->to(base_url('login'))->with('status', false)->with('message', 'Token Tidak Di Temukan');
		}
	}

	public function cengPassword(){
        $isLoggedIn = $this->session->get( 'isLoggedIn' );
        if (  isset ( $isLoggedIn ) || $isLoggedIn == TRUE ) {
			return redirect()->to(base_url('profile'));
		}else{
			$password=$this->cerip->encrypt_data($this->request->getPost('password'));
			$email = $this->request->getPost( 'email' );

            // print_r($password);
            // print_r($email);
            // die;
			$update = $this->token_m->where('email',$email)->set(['status'=>1,'updated_at'=>Time::now(),'deleted_at'=>Time::now()])->update();
			$update = $this->user_m->where('email',$email)->set(['password'=>$password,'updated_at'=>Time::now()])->update();

            // return $this->setResponseFormat('json')->respond(['status'=>TRUE]);
            if ($update){
                return redirect()->to(base_url())->with('status', true)->with('message', 'Data successfully update')->with('kode', '200');
            }else{
                return redirect()->to(base_url('forgotpassword'))->with('status', false)->with('message', 'Data failed to update')->with('kode', '304');
            }

		} 
	}

}