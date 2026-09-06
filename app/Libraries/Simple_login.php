<?php 
namespace App\Libraries;
use App\Models\User_model;
use App\Models\Client_model;
use App\Models\Siswa_model;
use App\Models\Akun_model;

class Simple_login
{

	/**
	 * Build absolute URL using CI4's URI service (works in library context).
	 * base_url() is NOT available in libraries — returns empty/null.
	 */
	private function _url($path = ''): string
	{
		$path = (string) ($path ?? '');
		if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
			return $path;
		}
		$uri = service('uri');
		return $uri->getBaseURL() . ltrim($path, '/');
	}

	// check login
	public function login($username,$password,$pengalihan)
	{
		$this->session  = \Config\Services::session();
		$m_user 		= new User_model();

		// Brute force protection: max 5 attempts per 5 minutes per username
		$rateLimitDir = WRITEPATH . 'rate_limit/';
		if (!is_dir($rateLimitDir)) {
			mkdir($rateLimitDir, 0755, true);
		}
		$rateFile = $rateLimitDir . 'login_' . md5($username) . '.json';
		$attempts = [];
		if (file_exists($rateFile)) {
			$attempts = json_decode(file_get_contents($rateFile), true) ?? [];
			// Clean up expired attempts (older than 5 minutes)
			$attempts = array_filter($attempts, function($ts) {
				return (time() - $ts) < 300;
			});
			$attempts = array_values($attempts);
		}

		if (count($attempts) >= 5) {
			$this->session->setFlashdata('warning','Terlalu banyak percobaan login. Silakan coba lagi dalam 5 menit.');
			header("Location: " . $this->_url('login'));
			exit;
		}

		$user 			= $m_user->login($username,$password);
		if($user) 
		{
			// Jika username password benar - clear rate limit on success
			if (file_exists($rateFile)) {
				unlink($rateFile);
			}
			$this->session->set('username',$username);
			$this->session->set('id_user',$user->id_user);
			$this->session->set('id_staff',$user->id_staff);
			$this->session->set('nama',$user->nama);
			$this->session->set('akses_level',$user->akses_level);

			if(!empty($pengalihan)) {
						header("Location: " . $this->_url($pengalihan));
					}else{
						header("Location: " . $this->_url('admin/dasbor'));
					}
			exit;
		}else{
			// Track failed attempt for brute force protection
			$attempts[] = time();
			file_put_contents($rateFile, json_encode($attempts));
			// jika username password salah
			$this->session->setFlashdata('warning','Username atau password salah');
			header("Location: " . $this->_url('login'));
			exit;
		}
	}

	// check login
	public function login_siswa_akun($username,$password)
	{
		$this->session  = \Config\Services::session();
		$m_siswa 		= new Siswa_model();
		$m_akun 		= new Akun_model();
		$user 			= $m_akun->login($username,sha1($password));

		if($user) 
		{
			// Jika username password benar
			$this->session->set('username_siswa',$username);
			$this->session->set('id_akun',$user->id_akun);
			$this->session->set('nama',$user->nama);
			$this->session->set('jenis_akun',$user->jenis_akun);
			$this->session->set('nis',$user->nis);
			$this->session->set('nisn',$user->nisn);
			header("Location: " . $this->_url('siswa/dasbor'));
			exit;
		}
	}

	// check login
	public function login_siswa($username,$password)
	{
		$this->session  = \Config\Services::session();
		$m_siswa 		= new Siswa_model();
		$m_akun 		= new Akun_model();

		$user 			= $m_akun->login($username,sha1($password));
		$user2 			= $m_akun->login_nis($username,sha1($password));

		if($user) 
		{
			// Jika username password benar
			$this->session->set('username_siswa',$username);
			$this->session->set('id_akun',$user->id_akun);
			$this->session->set('nama_siswa',$user->nama);
			$this->session->set('jenis_akun',$user->jenis_akun);
			$this->session->set('nis',$user->nis);
			$this->session->set('nisn',$user->nisn);
			header("Location: " . $this->_url('siswa/dasbor'));
			exit;
		}elseif($user2) {
			// Jika username password benar
			$this->session->set('username_siswa',$username);
			$this->session->set('id_akun',$user2->id_akun);
			$this->session->set('nama_siswa',$user2->nama_siswa);
			$this->session->set('jenis_akun',$user2->jenis_akun);
			$this->session->set('nis',$user2->nis);
			$this->session->set('nisn',$user2->nisn);
			header("Location: " . $this->_url('siswa/dasbor'));
			exit;
		}else{
			// jika username password salah
			$this->session->setFlashdata('warning','Username atau password salah');
			header("Location: " . $this->_url('signin'));
			exit;
		}
	}

	// check login
	public function checklogin_siswa()
	{
		$this->session  = \Config\Services::session();
		if($this->session->get('username_siswa')=='') 
		{
			$pengalihan = str_replace('index.php/','',current_url());
			$this->session->set('pengalihan_siswa',$pengalihan);
			$this->session->setFlashdata('warning','Anda belum login');
			header("Location: " . $this->_url('signin') . '?redirect=' . $pengalihan);
			exit;
		}
	}

	// check login
	public function login_client($username,$password)
	{
		$this->session  = \Config\Services::session();
		$m_client 		= new Client_model();
		$user 			= $m_client->login($username,$password);
		if($user) 
		{
			// Jika username password benar
			$this->session->set('username_client',$username);
			$this->session->set('id_client',$user->id_client);
			$this->session->set('nama_client',$user->nama);
			$this->session->set('akses_level','Client');
			header("Location: " . $this->_url('client/dasbor'));
			exit;
		}else{
			// jika username password salah
			$this->session->setFlashdata('warning','Username atau password salah');
			header("Location: " . $this->_url('signin'));
			exit;
		}
	}

	// check login
	public function checklogin()
	{
		$this->session  = \Config\Services::session();
		if($this->session->get('username')=='') 
		{
			$pengalihan = str_replace('index.php/','',current_url());
			$this->session->set('pengalihan',$pengalihan);
			$this->session->setFlashdata('warning','Anda belum login');
			header("Location: " . $this->_url('login') . '?redirect=' . $pengalihan);
			exit;
		}
		// Role-based access: only Admin level allowed
		if($this->session->get('akses_level') !== 'Admin')
		{
			$this->session->setFlashdata('warning','Anda tidak memiliki akses ke halaman ini');
			header("Location: " . $this->_url('login'));
			exit;
		}
	}

	// check login
	public function checklogin_client()
	{
		$this->session  = \Config\Services::session();
		if($this->session->get('username_client')=='') 
		{
			$pengalihan = str_replace('index.php/','',current_url());
			$this->session->set('pengalihan_siswa',$pengalihan);
			$this->session->setFlashdata('warning','Anda belum login');
			header("Location: " . $this->_url('signin') . '?redirect=' . $pengalihan);
			exit;
		}
	}

	// check logout
	public function logout()
	{
		$this->session  = \Config\Services::session();
		$this->session->remove('username');
		$this->session->remove('id_user');
		$this->session->remove('akses_level');
		$this->session->remove('nama');
		$this->session->remove('pengalihan');
		$this->session->setFlashdata('sukses','Anda berhasil logout');
		header("Location: " . $this->_url('login') . '?logout=sukses');
		exit;
	}

	// logout_siswa
	public function logout_siswa()
	{
		$this->session  = \Config\Services::session();
		$this->session->remove('username_siswa');
		$this->session->remove('id_akun');
		$this->session->remove('jenis_akun');
		$this->session->remove('nama_siswa');
		$this->session->remove('nis');
		$this->session->remove('nisn');
		$this->session->remove('pengalihan_siswa');
		$this->session->setFlashdata('sukses','Anda berhasil logout');
		header("Location: " . $this->_url('signin') . '?logout=sukses');
		exit;
	}
}
