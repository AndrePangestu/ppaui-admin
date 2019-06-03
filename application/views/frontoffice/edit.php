<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
     <?php
echo form_open_multipart($this->uri->segment(1).'/edit');
echo "<input type='hidden' name='id' value='$r[id]'>";
$class      ="class='form-control'";
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
    <tr>
    <td width="150">Tanggal</td><td>
		<?php echo inputan('text', 'tgl', 'col-sm-3', 'Tanggal...', 0, $r['tgl'],array('id'=>'datepicker'));?>
    </td>
    </tr>
    <tr><td>Nama Calon Peserta</td>
    <td><?php echo inputan('text', 'nama', 'col-sm-6', 'Nama..', 1, $r['nama'],'');?>
    </td>
	</tr>
    <tr><td>No. Handphone</td>
    <td><?php echo inputan('text', 'no_hp', 'col-sm-6', 'No. Handphone...', 1, $r['no_hp'],'');?>
    </td>
	</tr>
    <tr><td>Email</td>
    <td><?php echo inputan('text', 'email', 'col-sm-6','Email...', 1, $r['email'],'');?>
    </td>
	</tr>	
	<tr>
    <td width="150">Nama Pelatihan</td><td>
        <?php echo inputan('text', 'pel', 'col-sm-6','Pelatihan...', 1, $r['pel'],'');?>
    </td>
	<tr><td>Keterangan</td>
	<td><?php echo textarea('ket', '', 'col-sm-6', 10, $r['ket'])?>
	</td></tr> 
	<tr>
    <td width="150">Pelatihan Lain</td><td>
        <?php echo inputan('text', 'prodis', 'col-sm-6','Pelatihan lain...', 1, $r['prodis'],'');?>
    </td>
    </tr>
	<tr>
    <td width="150">Tanggal Tindak Lanjut</td><td>
		<?php echo inputan('text', 'tgltin', 'col-sm-3', 'Tanggal Tindak Lanjut...', 0, $r['tgltin'],array('id'=>'datepicker1'));?>
    </td>
    </tr>
	<tr><td>Tindakan</td>
	<td><?php echo textarea('tindakan', '', 'col-sm-6', 10, $r['tindakan'])?>
	</td></tr> 	
	<tr><td>User</td>
	<td><?php echo editcombo('username', 'app_users', 'col-sm-6', 'username', 'id_users', '', '',$r['id_users']);?>
	</td></tr> 
    <tr>
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
  </div></div>
</form>