<?php
class Ourpattern extends Controller {
	public function __construct()
    {
        parent::Controller();
		$this->load->helper('cookie');
		$this->load->helper('url');
		$this->load->model('Ourpattern_model','',TRUE);
    }
	public function index()
	{
		$data['title']='Users';
		$data['view']='OurPattern/listUsers';
		$data['users']=$this->Ourpattern_model->getUsers();
		$this->load->view('userTemplate',$data);
	}
	public function ajaxDelete($id)
	{
		$data['id']=$id;
		$data['users']=$this->Ourpattern_model->getUsersOne($id);
		$this->load->view('OurPattern/ajaxDelete',$data);
	}
	public function ajaxAddEdit($id='')
	{
		$data['id']=$id;
		if($id!='')
		{
			$data['users']=$this->Ourpattern_model->getUsersOne($id);
		}
		$this->load->view('OurPattern/ajaxAddEdit',$data);
	}
	public function postDelete()
	{
		$id=$this->input->post('userid');
		$data['users']=$this->Ourpattern_model->deleteUser($id);
		$cookie = array(
			'name'   => 'successMessage',
			'value'  => 'Successfully deleted a user.',
			'expire' => '86500',
			'domain' => '',
			'prefix' => ''
			);
		set_cookie($cookie);
		redirect('ourpattern');
	}
	public function postUser()
	{
		$id=$this->input->post('userid');
		$userName=$this->input->post('userName');
		$fName=$this->input->post('firstname');
		$lName=$this->input->post('lastname');
		$email=$this->input->post('email');
		$flgErr=0;
		if($fName=='')
		{
			$cookieFnameErr = array(
				'name'   => 'errFname',
				'value'  => 'Please enter First Name.',
				'expire' => '86500',
				'domain' => '',
				'prefix' => ''
				);
			set_cookie($cookieFnameErr);
			$flgErr=1;
		}
		if($lName=='')
		{
			$cookieLnameErr = array(
				'name'   => 'errLname',
				'value'  => 'Please enter Last Name.',
				'expire' => '86500',
				'domain' => '',
				'prefix' => ''
				);
			set_cookie($cookieLnameErr);
			$flgErr=1;
		}
		if($email=='')
		{
			$cookieEmaileErr = array(
				'name'   => 'errEmail',
				'value'  => 'Please enter Email.',
				'expire' => '86500',
				'domain' => '',
				'prefix' => ''
				);
			set_cookie($cookieEmaileErr);
			$flgErr=1;
		}
		else
		{
			$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
			if (!preg_match($regex, $email)) 
			{
				$cookieEmaileErr = array(
					'name'   => 'errEmail',
					'value'  => 'Please enter Valid Email.',
					'expire' => '86500',
					'domain' => '',
					'prefix' => ''
					);
				set_cookie($cookieEmaileErr);
				$flgErr=1;
			}	
			$emailExistsCount=$this->Ourpattern_model->emailExistsAlready($email,$id);
			if ($emailExistsCount>0) 
			{
				$cookieEmaileErr = array(
					'name'   => 'errEmail',
					'value'  => 'Email Already Exists.',
					'expire' => '86500',
					'domain' => '',
					'prefix' => ''
					);
				set_cookie($cookieEmaileErr);
				$flgErr=1;
			}	
		}
		if($flgErr==1)
		{
			$cookieUserId = array(
				'name'   => 'userId',
				'value'  => $id,
				'expire' => '86500',
				'domain' => '',
				'prefix' => ''
				);
			set_cookie($cookieUserId);
			$cookieUserName = array(
				'name'   => 'userName',
				'value'  => $userName,
				'expire' => '86500',
				'domain' => '',
				'prefix' => ''
				);
			set_cookie($cookieUserName);
			$cookieFname = array(
				'name'   => 'fname',
				'value'  => $fName,
				'expire' => '86500',
				'domain' => '',
				'prefix' => ''
				);
			set_cookie($cookieFname);
			$cookieLname = array(
				'name'   => 'lname',
				'value'  => $lName,
				'expire' => '86500',
				'domain' => '',
				'prefix' => ''
				);
			set_cookie($cookieLname);
			$cookieEmail = array(
				'name'   => 'email',
				'value'  => $email,
				'expire' => '86500',
				'domain' => '',
				'prefix' => ''
				);
			set_cookie($cookieEmail);
			$cookieErr = array(
				'name'   => 'error',
				'value'  => 'Your form has errors.',
				'expire' => '86500',
				'domain' => '',
				'prefix' => ''
				);
			set_cookie($cookieErr);
			$cookieshowPopup = array(
				'name'   => 'showPopup',
				'value'  => 'true',
				'expire' => '86500',
				'domain' => '',
				'prefix' => ''
				);
			set_cookie($cookieshowPopup);
		}
		else
		{
			$dataAdd=array(
				'firstname'=>$fName,
				'lastname'=>$lName,
				'email'=>$email
			);
			if($id=='')
			{
				$this->Ourpattern_model->insertUser($dataAdd);
				$cookie = array(
				'name'   => 'successMessage',
				'value'  => 'Successfully Added a user.',
				'expire' => '86500',
				'domain' => '',
				'prefix' => ''
				);
			}
			else
			{
				$this->Ourpattern_model->updateUser($dataAdd,$id);
				$cookie = array(
				'name'   => 'successMessage',
				'value'  => 'Successfully Updated a user.',
				'expire' => '86500',
				'domain' => '',
				'prefix' => ''
				);
			}
			set_cookie($cookie);
		}
		redirect('ourpattern');
	}
}