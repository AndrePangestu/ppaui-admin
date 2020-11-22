<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
     <?php
echo form_open_multipart($this->uri->segment(1).'/post');
$class      ="class='form-control'";
?><div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
	<tr>
    <td width="150">Tanggal</td><td>
        <?php echo inputan('text', 'tgl','col-sm-2','Tanggal...', 0, '',array('id'=>'datepicker'));?>
    </td>
    </tr>
	<tr>
    <td width="150">Nama Calon Peserta</td><td>
        <?php echo inputan('text', 'nama' ,'col-sm-5', 'Nama...', 4, '','');?>
    </td>
    </tr>
	<tr>
    <td width="150">No. Handphone</td><td>
        <?php echo inputan('text', 'no_hp' ,'col-sm-3', 'No Handphone...', 2, '','');?>
    </td>
    </tr>
	<tr>
    <td width="150">Email</td><td>
        <?php echo inputan('text', 'email' ,'col-sm-3', 'Email...', 2, '','');?>
    </td>
    </tr>
    <tr>
    <td width="150">Nama Pelatihan</td><td>
        <?php echo inputan('text', 'pel' ,'col-sm-3', 'Pelatihan...', 2, '','');?>
    </td></tr>
    <tr>
    <td width="150">Keterangan</td><td>
        <?php echo textarea('ket', '', 'col-sm-8', 3, '');?>
    </td>
    </tr>
	<tr>
	<td width="150">Pelatihan Lain</td><td>
        <?php echo inputan('text', 'prodis' ,'col-sm-3', 'Pelatihan lain...', 2, '','');?>
    </td>
    </tr>
	<tr>
    <td width="150">Tanggal Tindak Lanjut</td><td>
        <?php echo inputan('text', 'tgltin','col-sm-2','Tanggal...', 0, '',array('id'=>'datepicker1'));?>
    </td>
    </tr>
	<tr>
    <td width="150">Tindakan</td><td>
        <?php echo textarea('tindakan', '', 'col-sm-8', 3, '');?>
    </td>
    </tr>	
	<tr>
    <td width="150">User</td><td>
        <?php echo buatcombo('username','app_users','col-sm-3','username','id_users','',''); ?>
    </td>
    </tr>
    <tr>
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
  </div></div>
</form>