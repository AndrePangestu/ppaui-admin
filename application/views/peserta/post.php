<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
 
  <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>

<script>
$(document).ready(function(){
  $("#prodi").change(function(){
      var prodi=$("#prodi").val();
      $.ajax({
				//dataType:"json",
				url:"<?php echo base_url();?>peserta/tampilkankonsentrasi",
				data:"prodi=" + prodi ,
				success: function(html)
				{
						$("#konsentrasi").html(html);     
				}
			});  
	js_get_hari();	
	js_get_tgl();
  });
  
  $('[name=gedung]').change(function(){
		$("[name=prodi]").empty();
		js_get_prodi();
	});
	
  $('[name=tahun_angkatan]').change(function(){
		$("[name=prodi]").empty();
		js_get_prodi();
	});
});

function js_get_prodi(){
	$.ajax({
			type: "POST",
			url: "<?php echo site_url('peserta/get_jenis_pelatihan'); ?>", 
			data: "gedung_id="+$("[name=gedung] option:selected").val()+'&tahun_angkatan='+$("[name=tahun_angkatan] option:selected").text(),
			dataType:"json",//return type expected as json
			success: function(prodi){
				   $.each(prodi,function(prodi_id,val){
						var opt = $('<option />'); 
						opt.val(prodi_id);
						opt.text(val);
						$('[name=prodi]').append(opt);
				   });
			}
		});
}

function js_get_hari(){
	$.ajax({
			type: "POST",
			url: "<?php echo site_url('peserta/get_hari_pelatihan'); ?>", 
			data: "konsentrasi_id="+$("[name=konsentrasi] option:selected").val(),
			dataType:"json",//return type expected as json
			success: function(data){
				//alert(data.result);
				   $("#hari_pelatihan").text(data.result);
			}
		});
}

function js_get_tgl(){
	$.ajax({
			type: "POST",
			url: "<?php echo site_url('peserta/get_tgl_pelatihan'); ?>", 
			data: "konsentrasi_id="+$("[name=konsentrasi] option:selected").val(),
			dataType:"json",//return type expected as json
			success: function(data){
				//alert(data.result);
				   $("#tgl_pelatihan").text(data.result);
			}
		});
}
</script>

<?php
echo $this->session->flashdata('pesan');
echo form_open_multipart($this->uri->segment(1).'/post');
if($this->ion_auth->get_users_groups()->row()->id==1)
{
    $param="";
}
else
{
    $param=array('prodi_id'=>$this->session->userdata('keterangan'));
}
?>
 <div class="row">
                        <div class="col-md-12 clearfix">
                            <ul id="example-tabs" class="nav nav-tabs" data-toggle="tabs">
                                <li class="active"><a href="#pribadi">Data Pribadi</a></li>
                                <li><a href="#dataperus">Data Perusahaan / Universitas</a></li>
                                <li><a href="#datapel">Data Pelatihan</a></li>
                                <li><a href="#upload">Upload</a></li>
								<li><a href="#status">Status</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="pribadi">
                                    <table class="table table-bordered">
                                        <tr class="success"><th colspan="2">DATA PRIBADI</th></tr>
                                        <tr><td width="200">No. Pendaftaran</td>
                                            <td>
                                                <?php echo inputan('text', 'nim','col-sm-4','', 1, '','');?> 
                                            </td></tr>
											<tr><td>No. KTP</td>
                                            <td>
                                                  <?php echo inputan('text', 'no_ktp','col-sm-4','No. KTP ..', 1, '','');?>
                                            </td></tr>
                                        <tr><td>Nama Lengkap</td>
                                            <td>
                                                  <?php echo inputan('text', 'nama','col-sm-6','Nama Lengkap..', 1, '','');?>
                                            </td></tr>
                                        <tr><td>Jenis Kelamin</td>
                                            <td>
                                                <div class="col-md-2">
                                                <?php  echo form_dropdown('gender',array('1'=>'Laki-Laki','2'=>'Perempuan'),'',"class='form-control'");?>
                                                </div>
                                            </td></tr>
                                        <tr><td>Agama</td>
                                            <td>
                                                <?php echo buatcombo('agama','app_agama','col-sm-2','keterangan','agama_id','',''); ?>
											</td></tr>                                        
										<tr><td>Tempat & Tanggal Lahir</td>
                                            <td>
                                                <?php echo inputan('text', 'tempat_lahir','col-sm-4','Tempat Lahir ..', 0, '','');?>
                                                <?php echo inputan('text', 'tanggal_lahir','col-sm-2','Tanggal Lahir ..', 0, '',array('id'=>'datepicker'));?>
                                            </td></tr>
                                        <tr><td>Alamat Email</td>
                                            <td>
                                                <?php echo inputan('text', 'email','col-sm-4','Alamat Email ..', 0, '','');?>
											</td></tr>                                        
										<tr><td>No. HP (1) - No. HP (2)</td>
                                            <td>
                                                <?php echo inputan('text', 'no_hp1','col-sm-4','No. HP (1) ..', 0, '','');?>
												<?php echo inputan('text', 'no_hp2','col-sm-4','No. HP (2) ..', 0, '','');?>
											</td></tr>                                       
                                        <tr><td>No. Tlp Rumah</td>
                                            <td>
                                                <?php echo inputan('text', 'no_tlp_rumah','col-sm-3','No. Telpon Rumah ..', 0, '','');?>
											</td></tr>                                                                               
										<tr><td>Alamat Rumah</td><td> 
												<?php echo textarea('alamat', '', 'col-sm-8', 2, '');?>
											</td></tr>																								
										<tr><td>Pendidikan Terakhir <br> (Asal Univ/Sekolah)</td>
                                            <td>
                                                <?php echo inputan('text', 'pend_terakhir','col-sm-4','Contoh: S1-Univ. XXX ..', 0, '','');?>
											</td></tr>  
									</table>
                                    
                                </div>                      
                                <div class="tab-pane" id="dataperus">
                                    <table class="table table-bordered">
                                        <tr class="success"><th colspan="2">INFORMASI TEMPAT KERJA (Diisi oleh peserta yang sudah bekerja)</th></tr>
                                        <tr><td width="200">Nama Perusahaan</td>
                                            <td>
                                                <?php echo inputan('text', 'nama_perus','col-sm-6','Nama Perusahaan ..', 0, '','');?>
                                            </td></tr>
                                        <tr><td>Jenis Bidang Usaha</td>
                                            <td>
                                                <?php echo inputan('text', 'bidang_usaha','col-sm-4','Jenis Bidang Usaha ..', 0, '','');?>
                                            </td></tr>                                        
										<tr><td>Alamat Perusahaan</td>
                                            <td>
                                                <?php echo textarea('alamat_ktr', '', 'col-sm-8', 2, '');?>
                                            </td></tr>
                                        <tr><td>No. Telpon Perusahaan</td>
                                            <td>
                                                <?php echo inputan('text', 'no_tlp_perus','col-sm-3','Tlp & No. Ext (Jika ada) ..', 0, '','');?>
                                            </td></tr>
										<tr><td>Bagian</td>
                                            <td>
                                                <?php echo inputan('text', 'bagian','col-sm-4','Bagian ..', 0, '','');?>
											</td></tr>
										<tr><td>Jabatan</td>
                                            <td>
                                                <?php echo inputan('text', 'jabatan','col-sm-4','Jabatan ..', 0, '','');?>
                                            </td></tr>

										<tr class="success"><th colspan="2">INFORMASI TEMPAT KULIAH (Diisi oleh peserta yang sedang kuliah)</th></tr>
									<tr><td>Nama Universitas</td>
                                            <td>
                                                <?php echo inputan('text', 'nama_univ','col-sm-4','Nama Universitas ..', 0, '','');?>
                                            </td></tr>
									<tr><td>Semester</td>
                                            <td>
                                                <div class="col-md-2">
                                                <?php  echo form_dropdown('sem',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8'),'',"class='form-control'");?>
                                                </div>
                                            </td></tr>
									<tr><td>Jurusan</td>
                                            <td>
                                                <?php echo inputan('text', 'jurusan','col-sm-4','Jurusan ..', 0, '','');?>
                                            </td></tr>	
                                    </table>
                                </div>
								
                                <div class="tab-pane" id="datapel">
                                    <table class="table table-bordered">
                                        <tr class="success"><th colspan="2">DATA PELATIHAN</th></tr>
                                        <tr><td width="170">Tahun Pelatihan</td><td>
                                                <?php echo buatcombo('tahun_angkatan','student_angkatan','col-sm-2','keterangan','angkatan_id','','','disabled="disabled"'); ?>
                                            </td></tr>
										<tr><td>Lokasi Gedung</td><td>
                                                <div class="col-sm-6">
                                                  <?php echo buatcombo('gedung', 'app_gedung', '', 'nama_gedung', 'gedung_id', $param, array('id'=>'gedung'))?>
                                               </div>
                                            </td></tr>
										<tr><td>Jenis Pelatihan</td>
                                           <td>
                                               <div class="col-sm-6">
                                                  <?php echo buatcombo('prodi', 'akademik_prodi', '', 'nama_prodi', 'prodi_id', $param, array('id'=>'prodi'))?>
                                               </div>
                                        <div class="col-sm-6">
											<?php echo combodumy('konsentrasi', 'konsentrasi')?>
                                        </div></td></tr>								
										<tr><td>Waktu Pelatihan</td>
                                           <td><div class="col-md-5">
                                               <!--<div class="col-sm-6">
                                                  <?php #echo buatcombo('waktu', 'app_waktu', '', 'nama_waktu', 'waktu_id', $param, array('id'=>'waktu'))?>
												  </div>-->
												<div id="hari_pelatihan" name="hari_pelatihan" ></div>
                                        </td></tr>
										<tr><td>Tanggal Pelatihan</td>
                                           <td><div class="col-md-5">
                                               <div id="tgl_pelatihan" name="tgl_pelatihan" ></div>    
                                        </div></td></tr>
										<tr><td>Harga Pelatihan</td>
                                           <td>
                                               <div id="harga_pelatihan" name="harga_pelatihan" ></div>
                                        </td></tr>
										
										<tr class="success"><th colspan="2">SUMBER INFORMASI TERKAIT PPA FEB UI</th></tr>
										<tr><td>Sumber <br> (bisa diisi lebih dari 1)</td>
                                            <td><div class="col-md-2">
											<input id="sumber" type="checkbox" name="sumber[]" value="a"> Website<br>
											<input id="sumber" type="checkbox" name="sumber[]" value="b"> Spanduk<br>
											<input id="sumber" type="checkbox" name="sumber[]" value="c"> Media sosial<br>
											<input id="sumber" type="checkbox" name="sumber[]" value="d"> Brosur<br>
											<input id="sumber" type="checkbox" name="sumber[]" value="e"> Teman
                                            </div></td></tr>
										<tr><td>Alasan mengikuti pelatihan <br> (bisa diisi lebih dari 1)</td>
                                            <td><div class="col-md-10">
											<input id="alasan" type="checkbox" name="alasan[]" value="f"> Menunjang pekerjaan di kantor <br>
											<input id="alasan" type="checkbox" name="alasan[]" value="g"> Mempersiapkan diri untuk ikut ujian sertifikasi <br>
											<input id="alasan" type="checkbox" name="alasan[]" value="h"> Memperoleh pengetahuan untuk bekerja di masa depan <br>
                                            </div></td></tr>
										<tr><td>Bersedia dikirimkan (email) materi seputar pelatihan</td>
                                            <td>
											<div class="col-md-2">
                                                <?php  echo form_dropdown('kirim_materi',array('Ya'=>'Ya','Tidak'=>'Tidak'),'',"class='form-control'");?>
                                            </div>
                                            </td></tr>				
                                    </table>
                                </div>
                                <div class="tab-pane" id="upload">
                                    <table class="table table-bordered">
                                        <tr class="success"><th colspan="2">UPLOAD</th></tr>
                                        <tr><td>Upload Pas Foto Uk. 3x4 <br> (Wajib upload) </td><td>
										<div class="col-md-2">
                                                <input type="file" name="foto" value="foto">
                                        </div></td></tr>
										<tr><td  width="200">Upload KTP <br> (Wajib upload) </td><td>
										<div class="col-md-2">
                                                <input type="file" name="ktp" value="ktp">
                                        </td></tr>                                                                                
										<tr><td>Metode Pembayaran</td>
											<td>								
											<div class="col-md-2">
                                                <?php  echo form_dropdown('metode',array('Lunas'=>'Lunas','Cicilan'=>'Cicilan','Invoice'=>'Invoice'),'',"class='form-control'");?>
											</div>
                                        </td></tr>
										<tr><td>Jika memilih "Lunas", Wajib upload Bukti Pembayaran</td><td>
										<div class="col-md-5">
                                                <input type="file" name="bukti" value="bukti"> <br>*Dapat di upload setelah melakukan pembayaran
                                        </div></td></tr>
										<tr><td>Jika memilih "Cicilan", Wajib upload Form Mekanisme Pembayaran </td><td>
                                        <div class="col-md-2">
											<input type="file" name="mekanisme" value="mekanisme">
                                        </div></td></tr>
										<tr><td>Jika memilih "Invoice", Wajib upload Guarantee Letter Perusahaan </td><td>
										<div class="col-md-2">
                                                <input type="file" name="gl" value="gl">
                                        </div></td></tr>
										
                                    </table>
                                </div>
								<div class="tab-pane" id="status">
                                    <table class="table table-bordered">
                                        <tr class="success"><th colspan="2">STATUS</th></tr>
                                        <tr><td  width="200">Keterangan</td><td>
                                            <?php echo textarea('ket', '', 'col-sm-6', 2, '');?>    
                                        </td></tr>                                        
                                    </table>
                                </div>
                            </div>
                        </div>
<input type="submit" name="submit" value="simpan" class="btn btn-danger btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
</form>
