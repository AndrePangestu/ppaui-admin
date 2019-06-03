<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Edit Record</li>
    </ol>
</div>
     <?php
echo form_open($this->uri->segment(1).'/edit');
echo "<input type='hidden' name='id' value='$r[dosen_id]'>";
$gender=array(1=>'Laki Laki',2=>'Perempuan');
$kawin=array(1=>'Kawin',2=>'Belum Kawin');
$jenjang=array('S1'=>'S1','S2'=>'S2','S3'=>'S3');
$class="class='form-control'";
?>
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
    <tr>
    <td width="150">Nama Lengkap</td><td>
        <?php echo inputan('text', 'nama','col-sm-4','Nama Lengkap ..', 1, $r['nama_lengkap'],'');?>
    </td>
    </tr>
	<tr>
    <td width="150">NIP</td><td>
        <?php echo inputan('text', 'nip','col-sm-4','Nomor Induk Pengajar ..', 1, $r['nip'],'');?>
    </td>
    </tr>
     <tr>
    <td width="150">Tempat - Tanggal Lahir</td><td>
        <?php echo inputan('text', 'tempat_lahir','col-sm-3','Tempat Lahir ..', 1, $r['tempat_lahir'],'');?>
        <?php echo inputan('text', 'tanggal_lahir','col-sm-2','Tanggal Lahir ..', 1, $r['tanggal_lahir'],array('id'=>'datepicker'));?>
    </td>
    </tr>
            <tr>
            <td width="180">Jenis Kelamin</td><td>
                <div class="col-sm-3">
                    <?php echo form_dropdown('gender',$gender,$r['gender'],$class)?>
                </div>
            </td>
            </tr>  
        <tr>
    <td width="150">Agama - Status Kawin</td><td>
        <?php echo editcombo('agama','app_agama','col-sm-3','keterangan','agama_id','','',$r['agama_id']); ?>
         <div class="col-sm-3">
            <?php echo form_dropdown('kawin',$kawin,$r['status_kawin'],$class)?>
         </div>
    </td>
    </tr>
	        <tr>
		<td width="150">Pendidikan Terakhir - Gelar Sertifikasi</td><td>
        <div class="col-sm-2">
			<?php echo form_dropdown('jenjang',$jenjang,$r['jenjang'],$class)?>
        </div> 
            <?php echo inputan('text', 'gelar_pendidikan', 'col-sm-4', 'Gelar Pendidikan/Sertifikasi ..', 0, $r['gelar_pendidikan'],'');?>
    </td>
    </tr>
            <tr>
    <td width="150">Alamat</td><td>
        <?php echo textarea('alamat', '', 'col-sm-6', 2, $r['alamat']);?>
    </td>
    </tr>
        <tr>
    <td width="150">Email</td><td>
         <?php echo inputan('email', 'email','col-sm-4','Email ..', 1, $r['email'],'');?>
    </td></tr>
        <tr>
    <td width="150">No. Hp</td><td>
        <?php echo inputan('text', 'hp','col-sm-4','No. HP ..', 1, $r['hp'],'');?> 
    </td></tr>
	<tr>
	<td width="150">Nama Pelatihan</td><td>
        <?php echo inputan('text', 'pelatihan','col-sm-4','Nama Pelatihan ..', 1, $r['pelatihan'],'');?> 
    </td>
    </tr>  
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
  </div>
</form>