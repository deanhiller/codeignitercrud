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

		$sessionSuccess = array('successMessage' => 'Successfully deleted a user.',);
		$this->session->set_userdata($sessionSuccess);
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
		if ($fName == '')
		{
			$sessionfnameErr = array('firstnameerr' => 'Please enter First Name.',);
			$this->session->set_userdata($sessionfnameErr);
			$flgErr=1;
		}
		if ($lName == '')
		{
			$sessionlanmeErr = array('lastnameerr' => 'Please enter Last Name.',);
			$this->session->set_userdata($sessionlanmeErr);
			$flgErr=1;
		}
		if ($email == '')
		{
			$sessionemailErr = array('emailiderr' => 'Please enter Email.',);
			$this->session->set_userdata($sessionemailErr);
			$flgErr=1;
		}
		else
		{
			$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
			if  (!preg_match($regex, $email))
			{
				$sessionemailErr = array('emailiderr' => 'Please enter Valid Email.',);
				$this->session->set_userdata($sessionemailErr);
				$flgErr=1;
			}	
			$emailExistsCount=$this->Ourpattern_model->emailExistsAlready($email,$id);
			if ($emailExistsCount>0) 
			{
			    $sessionemailErr = array('emailiderr' => 'Email Already Exists.',);
				
				$this->session->set_userdata($sessionemailErr);
				$flgErr=1;
			}	
		}
		if($flgErr==1)
		{
			$sessionUserId = array('userId' => $id,);
			$this->session->set_userdata($sessionUserId);
			
			$sessionUserName = array('userName' => $userName,);
			$this->session->set_userdata($sessionUserName);
				
			$sessionArray = array('fname' => $fName,);
			$this->session->set_userdata($sessionArray);
				
			$sessionlname = array('lname' => $lName,);
			$this->session->set_userdata($sessionlname);
				
			$sessionemail = array('email' => $email,);
			$this->session->set_userdata($sessionemail);
				
			$sessionErr = array('error' => 'Your form has errors.',);
			$this->session->set_userdata($sessionErr);
				
			$sessionPopup = array('showPopup' => 'true',);
			$this->session->set_userdata($sessionPopup);
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
				
				 $sessionSuccess = array('successMessage' => 'Successfully Added a user.',);
			}
			else
			{
				$this->Ourpattern_model->updateUser($dataAdd,$id);
				 $sessionSuccess = array('successMessage' => 'Successfully Updated a user.',);
			}
			$this->session->set_userdata($sessionSuccess);
		}
		redirect('ourpattern');
	}
}