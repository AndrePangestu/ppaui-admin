<?php
class Users extends CI_Controller{
    
    var $folder =   "users";
    var $tables =   "users";
    var $pk     =   "id";
    var $title  =   "Users";
    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('M_masterdata');
        $user = $this->ion_auth->user()->row();
    }
    
    function index()
    {
        $user = $this->ion_auth->user()->row();
        $data['lvl_admin'] = $user->id_lvl_admin;
        $data['title']=  $this->title;
        //$data['record']=  $this->db->get($this->tables)->result();
        $data['record']=  $this->M_masterdata->get_loaddataadmin();

	$this->template->load('template', $this->folder.'/view',$data);
    }
    
    /*function keterangan($id)
    {
        if($id=='')
        {
            return '';
        }
        else
        {
            return getField('akademik_prodi', 'nama_prodi', 'prodi_id', $id);
        }
    }
    
    function level($level)
    {
        if($level==1)
        {
            return 'admin';
        }
        elseif($level==2)
        {
            return 'staf admin';
        }
        elseif($level==3)
        {
            return 'keuangan';
        }
        else
        {
            return 'peserta';
        }
    }
	*/
    
    function post()
    {
        if(isset($_POST['submit']))
        {
            //$username  =   $this->input->post('username');
			$email     =   $this->input->post('email');
            $password  =   $this->input->post('password');
            $id_lvl_admin     =   $this->input->post('id_lvl_admin');
            //$prodi     =   $this->input->post('prodi');
            if($id_lvl_admin==2)
            {
                 $data  =  array('email'=>$email,'password'=>md5($password),'id_lvl_admin'=>$this->ion_auth->get_users_groups()->row()->id,'keterangan'=>$prodi);
            }
            else
            {
                 $data  = array('email'=>$email,'password'=>md5($password),'id_lvl_admin'=>$this->ion_auth->get_users_groups()->row()->id);
            }
            $this->db->insert($this->tables,$data);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']=  $this->title;
            //$this->template->load('template', 'auth/create_user',$data);
            $this->template->load('template', $this->folder.'/post',$data);
        }
    }
    function edit()
    {
        if(isset($_POST['submit']))
        {
            $username  =   $this->input->post('username');
			$email     =   $this->input->post('email');
            $password  =   $this->input->post('password');
            $id        =   $this->input->post('id');
            $data      =   array('username'=>$username,'email'=>$email,'password'=>md5($password));
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title'] =  $this->title;
            $id            =  $this->uri->segment(3);
            $data['r']     =  $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            $this->template->load('template', $this->folder.'/edit',$data);
            //$this->template->load('template', 'auth/edit_user',$data);
        }
    }
    function delete()
    {
        $id     =  $this->uri->segment(3);
        $chekid = $this->db->get_where($this->tables,array($this->pk=>$id));
        if($chekid->num_rows()>0)
        {
            $this->mcrud->delete($this->tables,  $this->pk,  $this->uri->segment(3));
        }
        redirect($this->uri->segment(1));
    }
    
    function profile()
    {
        $id=  $this->session->userdata('id_users');
        if(isset($_POST['submit']))
        {
			$email   =  $this->input->post('email');
            $username=  $this->input->post('username');
            $password=  $this->input->post('password');
            $data    =  array('email'=>$email,'username'=>$username,'password'=>  md5($password));
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect('users/profile');
        }
        else
        {
            $data['title']=  $this->title;
            $data['r']   =  $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            $this->template->load('template', $this->folder.'/profile',$data);
        }
    }
    
    function account()
    {
        $id=  $this->session->userdata('keterangan');
        if(isset($_POST['submit']))
        {
            $nama           =   $this->input->post('nama');
            $email          =   $this->input->post('email');
            $data           =   array('nama_lengkap'=>$nama, 'email'=>$email);
            $this->mcrud->update('app_user',$data, 'id_users',$id);
            redirect('users/account');
        }
        else
        {
            $data['title']=  $this->title;
			$data['r']   =  $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            //$data['r']   =  $this->mcrud->getByID('app_dosen',  'dosen_id',  $id)->row_array();
            $this->template->load('template', $this->folder.'/account',$data);
        }
    }
}