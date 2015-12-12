<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function register($email, $password)
    {
        $password = md5($password . 'soult228');
        $data = array(
            'email' => $email,
            'password' => $password
        );
        $this->db->insert('users', $data);

        return true;
    }
    public function login($login='',$password='')
    {
        $this->db->select('hash_password');
        $this->db->from('users');
        $this->db->where('login',$login);
        $query = $this->db->get();
        $result = $query->row();

        if($query->num_rows() == 1) {
            $password = $this->hash_password_db($login, $password);
            if ($result->hash_password === $password) {
                $_SESSION['token'] = rand(0,123456);
                return TRUE;
            }else{
                return FALSE;
            }
        }

    }

    public function get_user_id($email = "")
    {
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('email',$email);
        $query = $this->db->get();

        $result = $query->row();
        return $result->id;
    }
    public function login_in()
    {
        return isset($_SESSION['token']);
    }
    function hash_password_db($login, $password)
    {
        return md5( $password . md5($login));
    }

}