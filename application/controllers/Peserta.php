<?php 
class Peserta extends CI_Controller{
    
    var $folder =   "peserta";
    var $tables =   "tbl_peserta_daftar";
    var $pk     =   "id_peserta_daftar";
    var $title  =   "Daftar Peserta";
    
    function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('M_masterdata');
    }
    
    function index()
    {
        $tahun="SELECT ta.keterangan,ta.tahun_akademik_id
                FROM student_mahasiswa as sm,akademik_tahun_akademik as ta
                WHERE ta.tahun_akademik_id=sm.tahun_akademik_id
                group by ta.tahun_akademik_id";
        
        $data['tahun_angkatan'] = $this->db->get('akademik_tahun_akademik')->result();

		$data1="SELECT student_mahasiswa.mahasiswa_id, student_mahasiswa.nim, student_mahasiswa.nama, student_mahasiswa.gender, student_mahasiswa.email, 
				student_mahasiswa.no_hp1, akademik_konsentrasi.nama_konsentrasi, student_mahasiswa.bukti
				FROM (student_mahasiswa 
				LEFT JOIN akademik_konsentrasi ON student_mahasiswa.konsentrasi_id = akademik_konsentrasi.konsentrasi_id)
				GROUP BY nama
				ORDER BY nama ASC";
		
		//$data1="SELECT student_mahasiswa.mahasiswa_id, student_mahasiswa.nim, student_mahasiswa.nama, student_mahasiswa.gender, student_mahasiswa.email, 
		//		student_mahasiswa.no_hp1, akademik_konsentrasi.nama_konsentrasi, app_waktu.nama_waktu
		//		FROM (student_mahasiswa 
		//		LEFT JOIN app_waktu ON student_mahasiswa.waktu_id = app_waktu.waktu_id) 
		//		LEFT JOIN akademik_konsentrasi ON student_mahasiswa.konsentrasi_id = akademik_konsentrasi.konsentrasi_id
		//		GROUP BY nama
		//		ORDER BY nama ASC";

	$data['record']	=  $this->db->query($data1)->result();
	$data['title']	=  $this->title;
    $data['desc']	=  "";

	$this->template->load('template', $this->folder.'/view',$data);
	$this->load->library('upload');
    }

    function post()
    {
        if(isset($_POST['submit']))
        {
			
			//UPLOAD foto dan KTP
			if ($_POST['foto'] == "") {
				$_POST['foto'] = $_POST['oldimg1'];
				$image1 = $_POST['oldimg1'];
			}
			if ($_POST['ktp'] == "") {
				$_POST['ktp'] = $_POST['oldimg2'];
				$image2 = $_POST['oldimg2'];
			}
			if ($_POST['bukti'] == "") {
				$_POST['bukti'] = $_POST['oldimg3'];
				$image3 = $_POST['oldimg3'];
			}
			if ($_POST['mekanisme'] == "") {
				$_POST['mekanisme'] = $_POST['oldimg4'];
				$image4 = $_POST['oldimg4'];
			}
			if ($_POST['gl'] == "") {
				$_POST['gl'] = $_POST['oldimg5'];
				$image5 = $_POST['oldimg5'];
			}

			$target = "uploads/foto/";
			$target = $target . basename($_FILES['foto']['name']);
			$image1 = basename($_FILES['foto']['name']);

			if (move_uploaded_file($_FILES['foto']['tmp_name'], $target))
				$err = "Berhasil Upload Foto";

			$target2 = "uploads/ktp/";
			$target2 = $target2 . basename($_FILES['ktp']['name']);
			$image2 = basename($_FILES['ktp']['name']);

			if (move_uploaded_file($_FILES['ktp']['tmp_name'], $target2))
				$err = "Berhasil Upload KTP";  
				
			$target3 = "uploads/bukti/";
			$target3 = $target3 . basename($_FILES['bukti']['name']);
			$image3 = basename($_FILES['bukti']['name']);

			if (move_uploaded_file($_FILES['bukti']['tmp_name'], $target3))
				$err = "Berhasil Upload Bukti Bayar";  
			
			$target4 = "uploads/mekanisme/";
			$target4 = $target4 . basename($_FILES['mekanisme']['name']);
			$image4 = basename($_FILES['mekanisme']['name']);

			if (move_uploaded_file($_FILES['mekanisme']['tmp_name'], $target4))
				$err = "Berhasil Upload Form Mekanisme Pembayaran"; 
			
			$target5 = "uploads/gl/";
			$target5 = $target5 . basename($_FILES['gl']['name']);
			$image5 = basename($_FILES['gl']['name']);

			if (move_uploaded_file($_FILES['gl']['tmp_name'], $target5))
				$err = "Berhasil Upload Guarantee Letter"; 
			#echo $err;
			#	print_r($_FILES);
			#exit;
				
            // pribadi
            $nim    			=   $this->input->post('nim');
			$nama               =   $this->input->post('nama');
            $no_ktp             =   $this->input->post('no_ktp');
            $alamat             =   $this->input->post('alamat');
            $tempat_lahir       =   $this->input->post('tempat_lahir');
            $tanggal_lahir      =   $this->input->post('tanggal_lahir');
            $agama           	=   $this->input->post('agama');
            $gender             =   $this->input->post('gender');
			$email		   		=   $this->input->post('email');
			$no_tlp_rumah		=   $this->input->post('no_tlp_rumah');
			$no_hp1   			=   $this->input->post('no_hp1');
			$no_hp2   			=   $this->input->post('no_hp2');
			$pend_terakhir   	=   $this->input->post('pend_terakhir');

			// data perusahaan
            $nama_perus         =   $this->input->post('nama_perus');
            $bidang_usaha       =   $this->input->post('bidang_usaha');
            $alamat_ktr     	=   $this->input->post('alamat_ktr');
            $no_tlp_perus       =   $this->input->post('no_tlp_perus');
            $bagian		        =   $this->input->post('bagian');
            $jabatan         	=   $this->input->post('jabatan');
			$nama_univ         	=   $this->input->post('nama_univ');
			$sem         		=   $this->input->post('sem');
			$jurusan         	=   $this->input->post('jurusan');
            
            // data pelatihan
            $waktu				=   $this->input->post('waktu');
            $gedung   			=   $this->input->post('gedung');
            $konsentrasi        =   $this->input->post('konsentrasi');
			$angkatan        	= 	getField('student_angkatan', 'angkatan_id', 'aktif', 'y');
			$sumber				=	$this->input->post('sumber');
			$alasan				=	$this->input->post('alasan');
			$kirim_materi		=	$this->input->post('kirim_materi');
			
			//upload
			$foto   			=   $target;
			$ktp   				=   $target2;
			$metode				=	$this->input->post('metode');
			$bukti				=	$target3;
			$mekanisme			=	$target4;
			$gl					=	$target5;
			
			//status
			$ket				=	$this->input->post('ket');
            
			$pribadi            =   array(  'nim'=>$nim,
											'nama'=>$nama,
											'no_ktp'=>$no_ktp,
											'alamat'=>$alamat,
											'tempat_lahir'=>$tempat_lahir,
											'tanggal_lahir'=>$tanggal_lahir,
											'agama_id'=>$agama,
											'gender'=>$gender,
											'email'=>$email,
											'no_tlp_rumah'=>$no_tlp_rumah,
											'no_hp1'=>$no_hp1,
											'no_hp2'=>$no_hp2,
											'pend_terakhir'=>$pend_terakhir);

            $dataperus            =   array('nama_perus'=>$nama_perus,
											'bidang_usaha'=>$bidang_usaha,
											'alamat_ktr'=>$alamat_ktr,
											'no_tlp_perus'=>$no_tlp_perus,
											'bagian'=>$bagian,
											'jabatan'=>$jabatan,
											'nama_univ'=>$nama_univ,
											'sem'=>$sem,
											'jurusan'=>$jurusan);
			
            $datapel              =   array('waktu_id'=>$waktu,
											'gedung_id'=>$gedung,
											'konsentrasi_id'=>$konsentrasi,
											'angkatan_id'=>$angkatan,
											'sumber'=>implode (",", $sumber),
											'alasan'=>implode (",", $alasan),
											'kirim_materi'=>$kirim_materi);
											
			$upload			      =	  array('foto'=>$foto,
											'ktp'=>$ktp,
											'metode'=>$metode,
											'bukti'=>$bukti,
											'mekanisme'=>$mekanisme,
											'gl'=>$gl);		
											
			$ket				  =	  array('ket'=>$ket,'status'=>'1');
			
            $data=array_merge($pribadi, $dataperus, $datapel, $upload, $ket);
            $this->db->insert($this->tables,$data);
            $this->session->set_flashdata('pesan', "<div class='alert alert-success'>Data $nama Sudah Tersimpan </div>");
            redirect('peserta/post');
        }
        else
        {
            $data['title']=  $this->title;
            $data['desc']="";
            $this->template->load('template', $this->folder.'/post',$data);
        }
    }
	
    function edit()
    {
	//	print_r($_POST);
        if(isset($_POST['submit']))
        {
			$data = array();
			$errors = '';
		
		//print_r($_FILES['ktp']);
		//echo '##'.trim($_FILES['foto']['name'])."####";
		//exit;
			if(trim($_FILES['foto']['name']) != "") {
				$target = "uploads/foto/";
				$target = $target . basename($_FILES['foto']['name']);
				$image1 = basename($_FILES['foto']['name']);
				
				unlink($_POST['oldimg1']);
				
				if (move_uploaded_file($_FILES['foto']['tmp_name'], $target))
					$err = "Berhasil Upload Foto";
			}
			else
				$target = $_POST['oldimg1'];


			if(trim($_FILES['ktp']['name']) != "") {
				$target2 = "uploads/ktp/";
				$target2 = $target2 . basename($_FILES['ktp']['name']);
				$image2 = basename($_FILES['ktp']['name']);
				
				unlink($_POST['oldimg2']);
				
				if (move_uploaded_file($_FILES['ktp']['tmp_name'], $target2))
					$err = "Berhasil Upload KTP";  
			}
			else
				$target2 = $_POST['oldimg2'];
			
			if(trim($_FILES['bukti']['name'])!="") {
				$target3 = "uploads/bukti/";
				$target3 = $target3 . basename($_FILES['bukti']['name']);
				$image3 = basename($_FILES['bukti']['name']);
				
				unlink($_POST['oldimg3']);

				if (move_uploaded_file($_FILES['bukti']['tmp_name'], $target3))
					$err = "Berhasil Upload Bukti Bayar"; 	
			}
			else
				$target3 = $_POST['oldimg3'];

			if(trim($_FILES['mekanisme']['name'])!="") {
				$target4 = "uploads/mekanisme/";
				$target4 = $target4 . basename($_FILES['mekanisme']['name']);
				$image4 = basename($_FILES['mekanisme']['name']);
				
				unlink($_POST['oldimg4']);

				if (move_uploaded_file($_FILES['mekanisme']['tmp_name'], $target4))
					$err = "Berhasil Upload Form Mekanisme Pembayaran"; 	
			}
			else
				$target4 = $_POST['oldimg4'];
			
			if(trim($_FILES['gl']['name'])!="") {
				$target5 = "uploads/gl/";
				$target5 = $target5 . basename($_FILES['gl']['name']);
				$image5 = basename($_FILES['gl']['name']);
				
				unlink($_POST['oldimg5']);

				if (move_uploaded_file($_FILES['gl']['tmp_name'], $target5))
					$err = "Berhasil Upload Guarantee Letter"; 	
			}
			else
				$target5 = $_POST['oldimg5'];
			
			if (($errors!="") ) {
				$err['exception'] = "You do Upload correct Format!";
				$this->session->set_userdata($err);          
			}
			
            $id     			= 	$this->input->post('id');
            // pribadi
            $nim    			=   $this->input->post('nim');
			$nama               =   $this->input->post('nama');
            $no_ktp             =   $this->input->post('no_ktp');
            $alamat             =   $this->input->post('alamat');
            $tempat_lahir       =   $this->input->post('tempat_lahir');
            $tanggal_lahir      =   $this->input->post('tanggal_lahir');
            $agama		        =   $this->input->post('agama');
            $gender             =   $this->input->post('gender');
			$email		   		=   $this->input->post('email');
			$no_tlp_rumah		=   $this->input->post('no_tlp_rumah');
			$no_hp1   			=   $this->input->post('no_hp1');
			$no_hp2   			=   $this->input->post('no_hp2');
			$pend_terakhir   	=   $this->input->post('pend_terakhir');
			
            // data perusahaan
            $nama_perus         =   $this->input->post('nama_perus');
            $bidang_usaha       =   $this->input->post('bidang_usaha');
            $alamat_ktr     	=   $this->input->post('alamat_ktr');
            $no_tlp_perus       =   $this->input->post('no_tlp_perus');
            $bagian		        =   $this->input->post('bagian');
            $jabatan         	=   $this->input->post('jabatan');
			$nama_univ         	=   $this->input->post('nama_univ');
			$sem         		=   $this->input->post('sem');
			$jurusan         	=   $this->input->post('jurusan');
            
            // data pelatihan
            $waktu			 	=   $this->input->post('waktu');
            $gedung     		=   $this->input->post('gedung');
            $konsentrasi        =   $this->input->post('konsentrasi');
			$angkatan   		=   $this->input->post('tahun_angkatan');
			$sumber				=	$this->input->post('sumber');
			$alasan				=	$this->input->post('alasan');
			$kirim_materi		=	$this->input->post('kirim_materi');
			
			//upload
			$foto   			=   $target;
			$ktp   				=   $target2;
			$metode				=	$this->input->post('metode');
			$bukti				=	$target3;
			$mekanisme			=	$target4;
			$gl					=	$target5;
			
			//ket
			$ket				=	$this->input->post('ket');
			$status				=	$this->input->post('status');
			
            $pribadi            =   array(  'nim'=>$nim,
											'nama'=>$nama,
											'no_ktp'=>$no_ktp,
											'alamat'=>$alamat,
											'tempat_lahir'=>$tempat_lahir,
											'tanggal_lahir'=>$tanggal_lahir,
											'agama_id'=>$agama,
											'gender'=>$gender,
											'email'=>$email,
											'no_tlp_rumah'=>$no_tlp_rumah,
											'no_hp1'=>$no_hp1,
											'no_hp2'=>$no_hp2,
											'pend_terakhir'=>$pend_terakhir);

            $dataperus            =   array('nama_perus'=>$nama_perus,
											'bidang_usaha'=>$bidang_usaha,
											'alamat_ktr'=>$alamat_ktr,
											'no_tlp_perus'=>$no_tlp_perus,
											'bagian'=>$bagian,
											'jabatan'=>$jabatan,
											'nama_univ'=>$nama_univ,
											'sem'=>$sem,
											'jurusan'=>$jurusan);
			
            $datapel              =   array('waktu_id'=>$waktu,
											'gedung_id'=>$gedung,
											'konsentrasi_id'=>$konsentrasi,
											'angkatan_id'=>$angkatan,
											'sumber'=>implode (",", $sumber),
											'alasan'=>implode (",", $alasan),
											'kirim_materi'=>$kirim_materi);		

			$upload			      =	  array('foto'=>$foto,
											'ktp'=>$ktp,
											'metode'=>$metode,
											'bukti'=>$bukti,
											'mekanisme'=>$mekanisme,
											'gl'=>$gl);		
											
			$ket				  =	  array('ket'=>$ket,'status'=>$status);
			
            $data=array_merge($pribadi, $dataperus, $datapel, $upload, $ket);
			
            $data                 =	  array_merge($pribadi,$dataperus,$datapel,$upload,$ket);
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
			//echo "<script type='text/javascript'>windows.alert('Data Berhasil Disimpan');</script>";
            redirect($this->uri->segment(1));
        }
		
			
        else
        {
            $data['title']=  $this->title;
            $data['desc']="";
            $id          =  $this->uri->segment(3);
            $data['r']   =  $this->mcrud->getByID($this->tables,$this->pk,$id)->row_array();
			//print_r($data);
            $this->template->load('template', $this->folder.'/edit',$data);
        }
    }
    
	function delete()
    {
        $id     =  $_GET['id'];
        $this->mcrud->delete($this->tables,  $this->pk,  $id);
 
    }
    
	function status()
    {
        $id     =  $this->uri->segment(4);
        $status =  $this->uri->segment(3);
        if($status=='2')
        {
           $this->db->query("update akademik_tahun_akademik set status='1'"); 
        }
        $this->mcrud->update($this->tables,array('status'=>$status), $this->pk,$id);
        redirect($this->uri->segment(1));
    }
	
    function tampilkankonsentrasi()
    {
        $prodi  = $_GET['prodi'];
        $data   = $this->db->get_where('akademik_konsentrasi',array('prodi_id'=>$prodi))->result();
        foreach ($data as $r)
        {
            echo "<option value='$r->konsentrasi_id'>".  strtoupper($r->nama_konsentrasi)."</option>";
        }
    }  

	function tampilkanpeserta()
    {
        $konsentrasi    =   $_GET['konsentrasi'];
        $tahun_angkatan =   $_GET['tahun_angkatan'];
        $data           =   $this->db->get_where('student_mahasiswa',array('konsentrasi_id'=>$konsentrasi,'angkatan_id'=>$tahun_angkatan))->result();	
	

	// print_r($data);
	
	   echo "<tr><th width='5'>No</th><th width='70'>NIP</th><th width='200'>Nama</th>
            <th>P/L</th><th>Email</th><th>No. HP</th>
			<th>Bukti Bayar</th><th>Keterangan</th><th>Validasi</th><th>Status</th>
            <th width='10' colspan='2'>Operasi</th></tr>";
        $no=1;
		
        foreach ($data as $r)
        {
            $gender=$r->gender==1?'L':'P';
			$status=$r->status==1?'Non-Aktif':'Aktif';
			
			//$register=array('id'=>'1','name'=>'status_keu', 'value'=>'1');  
			//$confirm=array('id'=>'2','name'=>'status_keu', 'value'=>'2'); 
			//$active=array('id'=>'3','name'=>'status_keu', 'value'=>'3'); 
			//$cancel=array('id'=>'4','name'=>'status_keu', 'value'=>'4'); 
			
            echo "<tr id='hide$r->mahasiswa_id'>
                <td>$no</td>
                <td>".  strtoupper($r->nim)."</td>
                <td>".  ucfirst($r->nama)."</td>
                <td>$gender</td>
                <td>".  lcfirst($r->email)."</td>
				<td>".  strtoupper($r->no_hp1)."</td>
				<td>[<a href='".$r->bukti."' target='_blank'>Lihat</a>]</td>
				<td>".  ucfirst($r->ket)."</td>
				<td></td>
				<td>$status</td>
				<td width=5>".anchor('peserta/edit/'.$r->mahasiswa_id,'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit data'))."</td>
                <td width=5><i class='fa fa-trash-o' onclick='hapus($r->mahasiswa_id)'></i></td>";
                //<td width=5>".anchor('peserta/cetak/'.$r->mahasiswa_id,'<i class="fa fa-print"></i>',array('title'=>'Cetak data'))."</td>";
                echo"</tr>";
            $no++;
        } 
    }	
	
	function get_jenis_pelatihan()
    {
		 error_reporting(0);
         $gedung_id=$this->input->post('gedung_id');
		 $tgl_mulai = date('Y-m-d', mktime(0, 0, 0, "1", "1",    $this->input->post('tahun_angkatan')));
		 $tgl_akhir = date('Y-m-d', mktime(0, 0, 0, "12", "1",   $this->input->post('tahun_angkatan')));
		 	 
		 if(trim($this->input->post('gedung_id')) != '') 		$where = " AND a.gedung_id = '".$gedung_id."'";
		 if(trim($this->input->post('tahun_angkatan')) != '')	$where .= " AND a.tglmulai >= '".$tgl_mulai."'";
		 if(trim($this->input->post('tahun_angkatan')) != '')	$where .= " AND a.tglakhir <= '".$tgl_akhir."'";
		 
		 $sql	="	SELECT a.prodi_id, b.nama_prodi val
					FROM akademik_konsentrasi a, akademik_prodi b
					WHERE a.prodi_id=b.prodi_id $where
					group by a.prodi_id";
     
         $dt_jenis_pelatihan = $this->db->query($sql)->result();
		 foreach ($dt_jenis_pelatihan as $row)
         {
			 $data[$row->prodi_id] = strtoupper($row->val);
		 }
		 echo json_encode($data);
	}
	
	function get_hari_pelatihan()
    {
		 error_reporting(0);
         $konsentrasi_id=$this->input->post('konsentrasi_id');
		 $waktu_id=$this->input->post('waktu_id');
		 
		 $sql	="	SELECT a.konsentrasi_id, b.nama_waktu val
					FROM akademik_konsentrasi a
					RIGHT JOIN app_waktu b on a.waktu_id=b.waktu_id
					WHERE a.konsentrasi_id= '".$konsentrasi_id."'";
					
         $dt_hari_pelatihan = $this->db->query($sql)->result();
		
		 foreach ($dt_hari_pelatihan as $row)
         {
			 $data['result'] = ucfirst($row->val);
		 }
		 echo json_encode($data);
	
	}
	
	function get_tgl_pelatihan()
    {
		 error_reporting(0);
         $konsentrasi_id=$this->input->post('konsentrasi_id');
		 	 
		 $sql	="	SELECT a.konsentrasi_id, a.tglmulai, a.tglakhir
					FROM akademik_konsentrasi a
					WHERE a.konsentrasi_id = '".$konsentrasi_id."'";
     
         $dt_tgl_pelatihan = $this->db->query($sql)->result();
		
		 foreach ($dt_tgl_pelatihan as $row)
         {
			 $data['result'] = date('d F Y',strtotime($row->tglmulai)) . " s/d ". date('d F Y',strtotime($row->tglakhir));
		 }
		 echo json_encode($data);
	}
	
	function get_harga_pelatihan()
    {
		 error_reporting(0);
         $konsentrasi_id=$this->input->post('konsentrasi_id');
		 	 
		 $sql	="	";
				
     
         $dt_harga_pelatihan = $this->db->query($sql)->result();
		
		 foreach ($dt_harga_pelatihan as $row)
         {
			 $data['result'] = Rp;
		 }
		 echo json_encode($data);
	}


	// ==================ANDRE=================================

	public function loadtahunpelatihan(){
		$result=$this->M_masterdata->get_loadtahunpelatihan();
		echo json_encode($result);
	}

	public function loadpelatihan(){
		$tahunpelatihan = $this->input->post('tahunpelatihan');
		$result=$this->M_masterdata->get_loadpelatihan($tahunpelatihan);
		echo json_encode($result);
	}

	public function loadkdpelatihan(){
		$namapelatihan = $this->input->post('namapelatihan');
		$result=$this->M_masterdata->get_loadkdpelatihan($namapelatihan);
		echo json_encode($result);
	}	

	public function loadpeserta(){
		$kdpelatihan = $this->input->post('kdpelatihan');
		$result=$this->M_masterdata->get_loadpeserta($kdpelatihan);
		$jsonArr=array(
			'rows'=>$result
		);
		echo json_encode($jsonArr);
	}

	public function loadpesertabatal(){
		$kdpelatihan = $this->input->post('kdpelatihan');
		$result=$this->M_masterdata->get_loadpesertabatal($kdpelatihan);
		$jsonArr=array(
			'rows'=>$result
		);
		echo json_encode($jsonArr);
	}

	public function modalBatalDaftar() 
    {
        $stack = array();
        //$data = $this->get_session();
        $id = $this->input->post('id');
        $data['id_peserta_daftar'] = $this->M_masterdata->getdatapeserta_id($id);   
        $jsonArr=array(
            'id_peserta_daftar'=>$data['id_peserta_daftar']
        );
        $this->output->set_output(json_encode($jsonArr));
    }

    public function batalPelatihan(){
        $id_peserta_daftar = $this->input->post('id_peserta_daftar');
        $kd_angkatan = $this->input->post('kd_angkatan');

        $data1 = array(  
            'sts_aktif_peserta' => 0,
            'alasan_batal' => $this->input->post('alasan_batal'),
        );
        $this->M_masterdata->update_sts_pendaftaran($id_peserta_daftar, $data1);

        $status = 'success';
        $jsonArr=array(
				'status'    =>  $status,
				'kd_angkatan' => $kd_angkatan
        );  
        $this->output->set_output(json_encode($jsonArr));
	}

	public function modalJadiDaftar() 
    {
        $stack = array();
        //$data = $this->get_session();
        $id = $this->input->post('id');
        $data['id_peserta_daftar'] = $this->M_masterdata->getdatapeserta_id($id);   
        $jsonArr=array(
            'id_peserta_daftar'=>$data['id_peserta_daftar']
        );
        $this->output->set_output(json_encode($jsonArr));
    }

    public function jadiPelatihan(){
        $id_peserta_daftar = $this->input->post('id_peserta_daftar');
        $kd_angkatan = $this->input->post('kd_angkatan');

        $data1 = array(  
            'sts_aktif_peserta' => 1,
            'alasan_batal' => '',
        );
        $this->M_masterdata->update_sts_pendaftaran($id_peserta_daftar, $data1);

        $status = 'success';
        $jsonArr=array(
				'status'    =>  $status,
				'kd_angkatan' => $kd_angkatan
        );  
        $this->output->set_output(json_encode($jsonArr));
	}

	public function modalDataDaftar() 
    {
        $stack = array();
        $id = $this->input->post('id');
        $data['id_peserta_daftar'] = $this->M_masterdata->getdatadaftar_id($id);   
        $jsonArr=array(
            'id_peserta_daftar'=>$data['id_peserta_daftar']
        );
        $this->output->set_output(json_encode($jsonArr));
    }

	
}