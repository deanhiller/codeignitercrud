<?php
class Ourpattern_model extends Model {
	
	public function __construct()
    {
        parent::Model();
    }
	public function getUsers()
    {
		$data = array();
		$query = $this->db->get('users');
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		return $data;
		$q->free_result();
	}
	public function getUsersOne($id)
    {
		$data = array();
		$query = $this->db->get_where('users', array('id' => $id));
		foreach ($query->result() as $row)
		{
			$data = $row;
		}
		return $data;
		$q->free_result();
	}
	public function deleteUser($id)
    {
		$this->db->where('id', $id);
		$this->db->delete('users');
	}
	public function insertUser($data)
    {
		$this->db->insert('users', $data);
	}
	public function updateUser($data,$id) 
	{
		$this->db->where('id', $id);
		$this->db->update('users' ,$data);
    }
	public function emailExistsAlready($email,$id)
	{
		if($id=='')
		{
			$query = $this->db->get_where('users', array('email' => $email));
		}
		else
		{
			$this->db->where('email =', $email);
			$this->db->where('id !=', $id);
			$query = $this->db->get('users');
		}
		$rowcount = $query->num_rows();
		return $rowcount;
	}
}