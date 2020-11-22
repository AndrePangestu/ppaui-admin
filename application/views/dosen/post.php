 <h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>
 
<?php
echo form_open_multipart($this->uri->segment(1).'/post');
$gender=array(1=>'Laki Laki',2=>'Perempuan');
$kawin=array(1=>'Kawin',2=>'Belum Kawin');
$jenjang=array('S1'=>'S1','S2'=>'S2','S3'=>'S3');
$class="class='form-control'";
?>
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Entry Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">

    <tr>
    <td width="150">Nama Lengkap</td><td>
        <?php echo inputan('text', 'nama','col-sm-4','Nama Lengkap ..', 1, '','');?>
    </td>
    </tr>
	<tr>
    <td width="150">NIP</td><td>
         <?php echo inputan('text', 'nip','col-sm-4','Nomor Induk Pengajar ..', 0, '','');?>
    </td>
    </tr>
     <tr>
    <td width="150">Tempat - Tanggal Lahir</td><td>
        <?php echo inputan('text', 'tempat_lahir','col-sm-3','Tempat Lahir ..', 0, '','');?>
        <?php echo inputan('text', 'tanggal_lahir','col-sm-2','Tanggal Lahir ..', 0, '',array('id'=>'datepicker'));?>
    </td>
    </tr>
        <tr>
            <td width="180">Jenis Kelamin</td><td>
                <div class="col-sm-3">
                    <?php echo form_dropdown('gender',$gender,'',$class)?>
                </div>
            </td>
            </tr>    
        <tr>
    <td width="150">Agama - Status Kawin</td><td>
        <?php echo buatcombo('agama','app_agama','col-sm-3','keterangan','agama_id','',''); ?>
         <div class="col-sm-3">
            <?php echo form_dropdown('kawin',$kawin,'',$class)?>
         </div>
    </td>
    </tr>
        <tr>
		<td width="150">Pendidikan Terakhir - Gelar Sertifikasi</td><td>
        <div class="col-sm-2">
			<?php echo form_dropdown('jenjang',$jenjang,'',$class)?>
        </div> 
            <?php echo inputan('text', 'gelar_pendidikan', 'col-sm-4', 'Gelar Pendidikan/Sertifikasi ..', 0, '','');?>
    </td>
    </tr>
    <tr>
    <td width="150">Alamat</td><td>
        <?php echo textarea('alamat', '', 'col-sm-6', 2, '');?>
    </td>
    </tr>
        <tr>
    <td width="150">Email</td><td>
         <?php echo inputan('email', 'email','col-sm-4','Email ..', 0, '','');?>
    </td>
    </tr>
	    <tr>
    <td width="150">No. Hp</td><td>
        <?php echo inputan('text', 'hp','col-sm-4','No. HP ..', 0, '','');?> 
    </td>
    </tr>
	    <tr>
    <td width="150">Nama Pelatihan</td><td>
        <?php echo inputan('text', 'pelatihan','col-sm-4','Nama Pelatihan ..', 0, '','');?> 
    </td>
    </tr>
 <!--<tr>
    <td width="150">username & Password</td><td>
        <?php #echo inputan('text', 'username','col-sm-4','Username ..', 1, '','');?> 
        <?php #echo inputan('password', 'password','col-sm-3','Password ..', 1, '','');?>
    </td>
    </tr>
-->
           
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
  </div></div>
</form>