<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>
 
 <?php
echo anchor($this->uri->segment(1).'/addNamaPelatihan',"<i class='fa fa-pencil-square-o'></i> Tambah Data",array('class'=>'btn btn-danger   btn-sm','title'=>'Tambah Data'))
?>
      
<table id="example-datatables" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th width="10"></th>
            <th width="5">No.</th>
            
            <th width="10">Nama Pelatihan</th>  
            <th width="10">Kode Pelatihan</th>    
        </tr>
    </thead>
    <tbody>
        
        <?php
        $i=1;
        foreach ($record as $r)
        {
        ?>
        
        <tr>
            <td class="text-center">
                <div class="btn-group">
                    <a href="<?php echo base_url().''.$this->uri->segment(1).'/editNamaPelatihan/'.$r->id_nama_pelatihan;?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                    <a href="<?php echo base_url().''.$this->uri->segment(1).'/deleteNamaPelatihan/'.$r->id_nama_pelatihan;?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                </div>
            </td>

            <td width="5" style="text-align:center;"><?php echo $i;?></td>
            <td><?php echo strtoupper($r->nama_pelatihan);?></td>
            <td><?php echo strtoupper($r->kd_pelatihan);?></td>
           
        </tr>
        <?php $i++;}?>
        
    </tbody>
</table>
<!-- END Datatables -->

<script src="<?php echo base_url()?>uadmin/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   
});

</script>
