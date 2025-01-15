<?php

namespace App\Controllers;
use App\Models\M_p;
class Home extends BaseController
{
	
	public function index()
	{
	if(session()->get('level') > 0){
		$model = new M_p;
		$where5 = array('id_setting' => 1);
    	$data['setting'] = $model->getwhere('setting', $where5);
		echo view('header',$data);
		echo view('menu');
		echo view('dashboard');
		echo view('footer');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function login(){
		$model = new M_p;
		$where5 = array('id_setting' => 1);
    	$data['setting'] = $model->getwhere('setting', $where5);
		echo view('header',$data);
		echo view('login');
	}

	public function aksi_login()
	{
		// Periksa koneksi internet
		if (!$this->checkInternetConnection()) {
			// Jika tidak ada koneksi, cek CAPTCHA gambar
			$captcha_code = $this->request->getPost('captcha_code');
			if (session()->get('captcha_code') !== $captcha_code) {
				session()->setFlashdata('toast_message', 'Invalid CAPTCHA');
				session()->setFlashdata('toast_type', 'danger');
				return redirect()->to('home/login');
			}
		} else {
			// Jika ada koneksi, cek Google reCAPTCHA
			$recaptchaResponse = trim($this->request->getPost('g-recaptcha-response'));
			$secret = '6LeKfiAqAAAAAFkFzd_B9MmWjX76dhdJmJFb6_Vi'; // Ganti dengan Secret Key Anda
			$credential = array(
				'secret' => $secret,
				'response' => $recaptchaResponse
			);
	
			$verify = curl_init();
			curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($verify, CURLOPT_POST, true);
			curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
			curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($verify);
			curl_close($verify);
	
			$status = json_decode($response, true);
	
			if (!$status['success']) {
				session()->setFlashdata('toast_message', 'Captcha validation failed');
				session()->setFlashdata('toast_type', 'danger');
				return redirect()->to('home/login');
			}
		}
	
		// Proses login seperti biasa
		$u = $this->request->getPost('username');
		$p = $this->request->getPost('password');
	
		$where = array(
			'username' => $u,
			'password' => md5($p),
		);
		$model = new M_p;
		$cek = $model->getWhere('user', $where);
	
		if ($cek) {
			// $this->log_activitys('User Mel$where5 = array('id_setting' => 1);
			session()->set('nama', $cek->username);
			session()->set('id', $cek->id_user);
			session()->set('level', $cek->id_level);
			return redirect()->to('home/');
		} else {
			session()->setFlashdata('toast_message', 'Invalid login credentials');
			session()->setFlashdata('toast_type', 'danger');
			return redirect()->to('home/login');
		}
	}

	public function checkInternetConnection()
	{
		$connected = @fsockopen("www.google.com", 80);
		if ($connected) {
			fclose($connected);
			return true;
		} else {
			return false;
		}
	}

	public function Standard(){
		if(session()->get('level') > 0){
			$model = new M_p;
			$where5 = array('id_setting' => 1);
			$data['setting'] = $model->getwhere('setting', $where5);
			echo view('header',$data);
			echo view('menu');
			echo view('standard');
			echo view('footer');
		}else{
			return redirect()->to('home/login');
		}
	}

	public function AddHistory()
	{
		$model = new M_p();
	
		// Ambil data dari request
		$input_expression = $this->request->getVar('input_expression');
		$result = $this->request->getVar('result');
		$feature = $this->request->getVar('feature');
	
		// Siapkan data untuk disimpan ke database
		$data = [
			'id_user' => session()->get('id'),
			'expression' => $input_expression,  // Ekspresi yang digunakan
			'result' => $result,  // Hasil perhitungan
			'feature' => $feature,
			'create_at' => date('Y-m-d H:i:s')
		];
	
		// Simpan data ke database
		if ($model->tambah('history', $data)) {
			return $this->response->setJSON(['status' => 'success', 'message' => 'History saved successfully']);
		} else {
			return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save history']);
		}
	}
	
	public function GetHistory()
	{
		$model = new M_p();
		$where = array('feature' => 'Standard');
		$where2 = array('id_user' => session()->get('id'));
		// Ambil data yang diurutkan berdasarkan 'created_at' terbaru
		$data = $model->tampilwhere3('history', $where, $where2,'create_at DESC');
		return $this->response->setJSON($data); // Kembalikan data sebagai JSON
	}
	
	
	public function GetProgrammer()
{
    $model = new M_p();
    $where = array('feature' => 'Programmer');
    $where2 = array('id_user' => session()->get('id'));

    try {
        $data = $model->tampilwhere3('history', $where, $where2, 'create_at DESC');
        if ($data) {
            return $this->response->setJSON(['status' => 'success', 'history' => $data]);
        }
        return $this->response->setJSON(['status' => 'failed', 'message' => 'No data found.']);
    } catch (\Exception $e) {
        log_message('error', $e->getMessage());
        return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
    }
}


	public function GetScientific()
	{
		$model = new M_p();
		$where = array('feature' => 'Scientific');
		$where2 = array('id_user' => session()->get('id'));
	
		// Ambil data yang diurutkan berdasarkan 'created_at' terbaru
		$data = $model->tampilwhere3('history', $where, $where2, 'create_at DESC');
	
		if ($data) {
			return $this->response->setJSON(['status' => 'success', 'history' => $data]);
		} else {
			return $this->response->setJSON(['status' => 'error', 'message' => 'No history found']);
		}
	}
	



	public function Scientific(){
		if(session()->get('level') > 0){
			$model = new M_p;
			$where5 = array('id_setting' => 1);
			$data['setting'] = $model->getwhere('setting', $where5);
			echo view('header',$data);
			echo view('menu');
			echo view('scientific');
			echo view('footer');
		}else{
			return redirect()->to('home/login');
		}
	}

	public function Programmer(){
		if(session()->get('level') > 0){
			$model = new M_p;
			$where5 = array('id_setting' => 1);
			$data['setting'] = $model->getwhere('setting', $where5);
			echo view('header',$data);
			echo view('menu');
			echo view('programmer');
			echo view('footer');
		}else{
			return redirect()->to('home/login');
		}
	}

	public function DateCalculation(){
		if(session()->get('level') > 0){
			$model = new M_p;
			$where5 = array('id_setting' => 1);
			$data['setting'] = $model->getwhere('setting', $where5);
			echo view('header',$data);
			echo view('menu');
			echo view('datecalculation');
			echo view('footer');
		}else{
			return redirect()->to('home/login');
		}
	}

	public function Temperature(){
		if(session()->get('level') > 0){
			$model = new M_p;
			$where5 = array('id_setting' => 1);
			$data['setting'] = $model->getwhere('setting', $where5);
			echo view('header',$data);
			echo view('menu');
			echo view('temperature');
			echo view('footer');
		}else{
			return redirect()->to('home/login');
		}
	}

	public function logout()
{
    // $this->log_activity('User Logout');
    session()->destroy();
    return redirect()->to('home/login');
}

public function aksi_signup()
{
	$model = new M_p();

	// Ambil data dari request
	$username = $this->request->getPost('username');
	$password = $this->request->getPost('password');
	// Siapkan data untuk disimpan ke database
	$data = [
		'username' => $username,
		'password' => md5($password),  // Ekspresi yang digunakan
		'id_level' => 2
	];

	// Simpan data ke database
	if ($model->tambah('user', $data)) {
		$model->tambah('user_backup', $data);
		return redirect()->to('home/login');
	} else {
		return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save User']);
	}
}

public function aksi_edit_website()
{
    // Load the model that interacts with your settings
    $model = new M_p(); // Replace M_p with the actual model name

    // Retrieve the settings from the database
    $where5 = array('id_setting' => 1);
    $setting = $model->getwhere('setting',$where5); // Assuming you have a method to get current settings

    // Get the name from the request
    $name = $this->request->getPost('name');

    $icon = $this->request->getFile('icon');
    $menu = $this->request->getFile('menu');

    // Array to hold image names
    $images = [];

    // Check and upload icon
    if ($icon && $icon->isValid()) {
        $images['icon'] = $icon->getName();
        $model->uploadimages($icon); // Call uploadimages from the model
    } else {
        // Keep the existing icon name if no new file is uploaded
        $images['icon'] = $setting->icon;
    }

    // Check and upload menu image
    if ($menu && $menu->isValid()) {
        $images['menu'] = $menu->getName();
        $model->uploadimages($menu); // Call uploadimages from the model
    } else {
        // Keep the existing menu image name if no new file is uploaded
        $images['menu'] = $setting->menu;
    }
    // Update the settings in the database with the new image names and the new name
    $model->updateSettings($name, $images['icon'], $images['menu']); // Corrected parameter usage

    return redirect()->to('home/Website'); // Redirect after processing
}

public function Website(){
	if(session()->get('level') == 1){
    $model = new M_p();
    $where5 = array('id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where5);
    echo view('header', $data);
    echo view('menu', $data);
    echo view('setting', $data);
    echo view('footer');
}else{
	return redirect()->to('home/login');
}
}

public function User(){
	if(session()->get('level') == 1){
    $model = new M_p();
    $where5 = array('id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where5);
	$where = array('user.deleted'=> null);
    $data['user'] = $model->join1where1('user', 'level','user.id_level = level.id_level',$where);
    echo view('header', $data);
    echo view('menu', $data);
    echo view('user', $data);
    echo view('footer');
}else{
	return redirect()->to('home/login');
}
}

public function EditUser($id){
	if(session()->get('level') == 1){
    $model = new M_p();
    $where = array('id_user' => $id);
    $data['user'] = $model->getwhere('user', $where);
    $data['level'] = $model->tampil('level');
    $where5 = array('id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where5);
    echo view('header', $data);
    echo view('menu', $data);
    echo view('e_user', $data);
    echo view('footer');
}else{
	return redirect()->to('home/login');
}
}
public function aksi_edit_user() {
    $model = new M_p();

    // Retrieve form data
    $username = $this->request->getPost('username');
    $level = $this->request->getPost('level');
	$id = $this->request->getPost('id');



    // Prepare data array for update
    $data = [
        'username' => $username,
        'id_level' => $level,
    ];


    $where = array('id_user' => $id);
    // Update the user in the 'user' table
    if ($model->edit('user', $data, $where)) {
        return redirect()->to('home/User')->with('message', 'User updated successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to update user.');
    }
}

public function SDuser($id){
    $model = new M_p();
    $data = [
        'deleted' => date('Y-m-d H:i:s')
    ];
    $where = array('id_user' => $id);
    $model->edit('user', $data, $where);
    return redirect()->to('home/user');
}

public function resetedituser($id)
{
    $model = new M_p();

    // Get the current data from the barang table
    $currentData = $model->getWherearray('user', ['id_user' => $id]);

    // Get the backup data from the barang_backup table
    $backupData = $model->getWherearray('user_backup', ['id_user' => $id]);

    $model->restoreProduct('user_backup', 'id_user', $id);

    return redirect()->to('home/User');
}

public function t_user(){
	if(session()->get('level') == 1){
    $model = new M_p();
    $data['level'] = $model->tampil('level');
    $where5 = array('id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where5);
    echo view('header', $data);
    echo view('menu', $data);
    echo view('t_user', $data);
    echo view('footer');
}else{
    return redirect()->to('home/login');
}
}

public function aksi_tambah_user() {
    $model = new M_p();

    // Retrieve form data
    $username = $this->request->getPost('username');
    $level = $this->request->getPost('level');



    // Prepare data array for update
    $data = [
        'username' => $username,
        'id_level' => $level,
		'password' => md5('sph')
    ];


    // Update the user in the 'user' table
    if ($model->tambah('user', $data)) {
		$model->tambah('user_backup', $data);
        return redirect()->to('home/User')->with('message', 'User updated successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to update user.');
    }
}

public function history(){
	if(session()->get('level') == 1){
    $model = new M_p();
	$where = array('history.deleted' => Null);
	$data['user'] = $model->join1where1('history', 'user','history.id_user = user.id_user',$where);
    $where5 = array('id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where5);
    echo view('header', $data);
    echo view('menu', $data);
    echo view('history', $data);
    echo view('footer');
}else{
    return redirect()->to('home/login');
}
}


public function SDhistory($id){
    $model = new M_p();
    $data = [
        'deleted' => date('Y-m-d H:i:s')
    ];
    $where = array('id_history' => $id);
    $model->edit('history', $data, $where);
    return redirect()->to('home/History');
}


public function RUser(){
	if(session()->get('level') == 1){
    $model = new M_p();
    $where5 = array('id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where5);
	$where = "user.deleted is not null";
    $data['user'] = $model->join1where1('user', 'level','user.id_level = level.id_level',$where);
    echo view('header', $data);
    echo view('menu', $data);
    echo view('ruser', $data);
    echo view('footer');
}else{
	return redirect()->to('home/login');
}
}

public function RHistory(){
	if(session()->get('level') == 1){
    $model = new M_p();
	$where = "history.deleted is not null";
	$data['user'] = $model->join1where1('history', 'user','history.id_user = user.id_user',$where);
    $where5 = array('id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where5);
    echo view('header', $data);
    echo view('menu', $data);
    echo view('rhistory', $data);
    echo view('footer');
}else{
    return redirect()->to('home/login');
}
}

public function RDhistory($id){
    $model = new M_p();
    $data = [
        'deleted' => Null
    ];
    $where = array('id_history' => $id);
    $model->edit('history', $data, $where);
    return redirect()->to('home/RHistory');
}

public function RDuser($id){
    $model = new M_p();
    $data = [
        'deleted' => Null
    ];
    $where = array('id_user' => $id);
    $model->edit('user', $data, $where);
    return redirect()->to('home/RUser');
}
}
