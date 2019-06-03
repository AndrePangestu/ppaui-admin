<h2 style="font-weight: normal;"><?php echo 'Nama Pelatihan';?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
<?php
echo form_open_multipart($this->uri->segment(1).'/addNamaPelatihan');
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Add Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
    <tr>
        <td width="150">Nama Pelatihan</td>
        <td>
            <?php echo inputan('text', 'nama_pelatihan','col-sm-6 test','...', 1, '','');?>
        </td>
    </tr>
    <tr>
        <td width="200">Kode Pelatihan</td>
        <td>
            <?php echo inputan('text', 'kd_pelatihan','col-sm-4','...', 1, '','');?>
        </td>
    </tr>
   
    <tr>
         <td></td>
         <td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <a href='<?=base_url()?>Prodi/namaPelatihan' class='btn btn-danger btn-sm'>Kembali</a>
        </td>
    </tr>

</table>
  </div></div>
</form> 
