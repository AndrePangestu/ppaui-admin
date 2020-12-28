<?php
class Prodi extends CI_Controller{
    
    var $folder =   "prodi";
    var $tables =   "tbl_pelatihan_master";
    var $pk     =   "id_m_pelatihan";
    var $title  =   "Master Pelatihan";
    
    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('M_masterdata');
    }
    
    function index()
    {
        $data['title']  = $this->title;
        $data['desc']    =   "";
        $data['record'] =  $this->db->query('SELECT * FROM tbl_pelatihan_master ORDER BY id_m_pelatihan DESC')->result();
	$this->template->load('template', $this->folder.'/view',$data);
    }
    function post()
    {
        if(isset($_POST['submit']))
        {
            $nama   =   $this->input->post('nama_pelatihan1');
            $kdpelatihan  =   $this->input->post('kd_pelatihan');
            $kdangkatan  =   $this->input->post('kd_angkatan');
            $lokasi  =   $this->input->post('lokasi');
            $hari  =   $this->input->post('hari');
            $jammulai  =   $this->input->post('jam_mulai');
            $jamselesai  =   $this->input->post('jam_selesai');
            $tglmulai	=	$this->input->post('tgl_mulai');
            $tglselesai   =   $this->input->post('tgl_selesai');
            $investasi   =   $this->input->post('investasi');
            $periode   =   $this->input->post('periode');
            $tahun   =   $this->input->post('tahun');
            $jmlpertemuan   =   $this->input->post('jml_pertemuan');
            $tipepelatihan   =   $this->input->post('tipe_pelatihan');
            $sts_pelatihan   =   $this->input->post('sts_pelatihan');
            $sts_aktif   =   $this->input->post('sts_aktif');
            $sts_aktif_daftar   =   $this->input->post('sts_aktif_daftar');
            $discount = $this->input->post('discount');
            $data   =   array(
                'nama_pelatihan'=>$nama,
                'kd_pelatihan'=>$kdpelatihan,
                'kd_angkatan' => $kdangkatan,
                'lokasi'=>$lokasi,
                'hari'=>$hari,
                'jam_mulai'=>$jammulai,
                'jam_selesai'=>$jamselesai,
                'tgl_mulai'=> date('Y-m-d', strtotime($tglmulai)),
                'tgl_selesai'=> date('Y-m-d', strtotime($tglselesai)),
                'investasi' => $investasi,
                'periode' => $periode,
                'tahun' => $tahun,
                'jml_pertemuan' => $jmlpertemuan,
                'tipe_pelatihan' => $tipepelatihan,
                'sts_pelatihan' =>  $sts_pelatihan,
                'status' => $sts_aktif,
                'sts_aktif_daftar' => $sts_aktif_daftar,
                'insert_date' => date('Y-m-d H:i:s'),
                'discount' => $discount
            );

            $this->db->insert($this->tables,$data);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $this->template->load('template', $this->folder.'/post',$data);
        }
    }
       
    function edit()
    {
        if(isset($_POST['submit']))
        {
            $id     = $this->input->post('id');
            $nama   =   $this->input->post('nama_pelatihan');
            $kdpelatihan  =   $this->input->post('kd_pelatihan');
            $lokasi  =   $this->input->post('lokasi');
            $hari  =   $this->input->post('hari');
            $jammulai  =   $this->input->post('jam_mulai');
            $jamselesai  =   $this->input->post('jam_selesai');
            $tglmulai	=	$this->input->post('tgl_mulai');
            $tglselesai   =   $this->input->post('tgl_selesai');
            $investasi   =   $this->input->post('investasi');
            $periode   =   $this->input->post('periode');
            $tahun   =   $this->input->post('tahun');
            $jmlpertemuan   =   $this->input->post('jml_pertemuan');
            $tipepelatihan   =   $this->input->post('tipe_pelatihan');
            $sts_pelatihan   =   $this->input->post('sts_pelatihan');
            $sts_aktif   =   $this->input->post('sts_aktif');
            $sts_aktif_daftar   =   $this->input->post('sts_aktif_daftar');
            $discount   =   $this->input->post('discount');
            $data   =   array(
                'nama_pelatihan'=>$nama,
                'kd_pelatihan'=>$kdpelatihan,
                'lokasi'=>$lokasi,
                'hari'=>$hari,
                'jam_mulai'=>$jammulai,
                'jam_selesai'=>$jamselesai,
                'tgl_mulai'=> date('Y-m-d', strtotime($tglmulai)),
                'tgl_selesai'=> date('Y-m-d', strtotime($tglselesai)),
                'investasi' => $investasi,
                'periode' => $periode,
                'tahun' => $tahun,
                'jml_pertemuan' => $jmlpertemuan,
                'tipe_pelatihan' => $tipepelatihan,
                'sts_pelatihan' =>  $sts_pelatihan,
                'status' => $sts_aktif,
                'sts_aktif_daftar' => $sts_aktif_daftar,
                'insert_date' => date('Y-m-d H:i:s'),
                'discount' => $discount
            );
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $id          =  $this->uri->segment(3);
            $data['r']   =  $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            $this->template->load('template', $this->folder.'/edit',$data);
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
    
    
    function pencarian()
    {
        $key=$_GET['key'];
        $query="select * from akademik_prodi where nama_prodi LIKE '%$key%'";

        echo "<table class='table table-bordered'>
            <tr><th width=15>No</th><th>Singkatan Pelatihan</th><th width=315>Nama Pelatihan</th><th colspan=3 width=30>Option</th></tr>";
        $data=  $this->db->query($query)->result();
        $no=1;
        foreach ($data as $r)
        {
             echo "<tr>
                 <td>$no</td>
                 <td>".  strtoupper($r->nama_prodi)."</td>
                 <td>".  strtoupper($r->prodi)."</td>
                 <td width=10><span class='glyphicon glyphicon-trash' onclick='hapus($r->prodi_id)'></span></td>
                 <td width=10>".anchor($this->uri->segment(1).'/edit/'.$r->prodi_id,"<span class='glyphicon glyphicon-edit'></span>")."</td>
                 <td width=10><span class='fa fa-list-alt'></span></td>
                 </tr>";
             $no++;
        }
       
        echo"</table>";
    }

    public function modalDetailData() 
    {
        $stack = array();
        //$data = $this->get_session();
        $data['id_m_pelatihan'] = $this->M_masterdata->getpelatihan_id();   
        $jsonArr=array(
            'id_m_pelatihan'=>$data['id_m_pelatihan']
        );
        echo json_encode($jsonArr);
    }

    /* ===================  Nama Pelatihan  ============================*/

    public function namaPelatihan(){
        $data['title']  = 'Nama Pelatihan';
        $data['desc']    =   "";
        $data['record'] =  $this->db->query('SELECT * FROM tbl_pelatihan_nama ORDER BY id_nama_pelatihan DESC')->result();
	    $this->template->load('template', $this->folder.'/v_nama_pelatihan',$data);
    }

    function addNamaPelatihan()
    {
        if(isset($_POST['submit']))
        {
            $nama   =   $this->input->post('nama_pelatihan');
            $kdpelatihan  =   $this->input->post('kd_pelatihan');
           
            $data   =   array(
                'nama_pelatihan'=>$nama,
                'kd_pelatihan'=>$kdpelatihan,
            );

            $this->db->insert('tbl_pelatihan_nama',$data);
            redirect('/Prodi/namaPelatihan', 'refresh');
        }
        else
        {
            $data['title']  = 'Nama Pelatihan';
            $data['desc']    =   "";
            $this->template->load('template', $this->folder.'/add_nama_pelatihan',$data);
        }
    }

    function editNamaPelatihan()
    {
        if(isset($_POST['submit']))
        {
            $id     = $this->input->post('id');
            $nama   =   $this->input->post('nama_pelatihan');
            $kdpelatihan  =   $this->input->post('kd_pelatihan');
           
            $data   =   array(
                'nama_pelatihan'=>$nama,
                'kd_pelatihan'=>$kdpelatihan,
               
            );
            $this->mcrud->update('tbl_pelatihan_nama',$data, 'id_nama_pelatihan',$id);
            redirect('/Prodi/namaPelatihan', 'refresh');
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $id          =  $this->uri->segment(3);
            $data['r']   =  $this->mcrud->getByID('tbl_pelatihan_nama', 'id_nama_pelatihan',$id)->row_array();
            $this->template->load('template', $this->folder.'/edit_nama_pelatihan',$data);
        }
    }
    
    function deleteNamaPelatihan()
    {
        $id     =  $this->uri->segment(3);
        $chekid = $this->db->get_where('tbl_pelatihan_nama',array('id_nama_pelatihan'=>$id));
        if($chekid->num_rows()>0)
        {
            $this->mcrud->delete('tbl_pelatihan_nama','id_nama_pelatihan', $this->uri->segment(3));
        }
        redirect('/Prodi/namaPelatihan', 'refresh');
    }
    /* Modul Prodi */
    
    function loadNamaPelatihan(){
        $result=$this->M_masterdata->get_loadnamapel();
        $jsonArr=array(
            'rows'=>$result
        );
        $this->output->set_output(json_encode($result));
    }

    function getNamaPelatihan(){
        $kdpelatihan = $this->input->post('kdpelatihan');
        $result=$this->M_masterdata->get_namapel($kdpelatihan);
 
        $checkAngkatan = $result[0]->kd_pelatihan;
        $counter = 1;
        $kdAngkatan = $checkAngkatan.$counter;

        $found = false;
        while($found == false){
            $a = $this->M_masterdata->kdangkatan_exists($kdAngkatan);
            if($a == 'ada') {
                $kdAngkatan = $checkAngkatan.$counter;
                $counter++;
            } else {
                $found = true;
            }
        }
        $jsonArr = array(
            'nama_pelatihan'    => $result[0]->nama_pelatihan,
            'kd_pelatihan'    => $result[0]->kd_pelatihan,
            'kd_angkatan'    => $kdAngkatan,
        );  
        $this->output->set_output(json_encode($jsonArr));
    }
}