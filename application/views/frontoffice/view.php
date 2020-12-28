<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
 
 <?php
echo anchor($this->uri->segment(1).'/post',"<i class='fa fa-pencil-square-o'></i> Tambah Data",array('class'=>'btn btn-danger   btn-sm','title'=>'Tambah Data'))
?>
      
                    <table id="tbl-frontoffice" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No.</th>
								<th width="120">Tanggal</th>
								<th>Nama</th>
								<th>No. Handphone</th>
								<th>Email</th>
								<th>Pelatihan Utama</th>
								<th>Keterangan</th>
								<th>Pelatihan Lain</th>
								<th width="120">Tanggal Tindak Lanjut</th>
								<th>Tindak Lanjut</th>
								<th>User</th>
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
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/edit/'.$r->id;?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/delete/'.$r->id;?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                    </div>
                                </td>
                                <td><?php echo $i;?></td>
								<td><?php echo ($r->tgl)?></td>
								<td><?php echo ucwords($r->nama)?></td>
								<td><?php echo ($r->no_hp)?></td>
								<td><?php echo strtolower($r->email)?></td>
                                <td><?php echo strtoupper($r->pel)?></td>  							
								<td><?php echo ($r->ket)?></td>
								<td><?php echo strtoupper($r->prodis)?></td>
								<td><?php echo ($r->tgltin)?></td>	
								<td><?php echo ($r->tindakan)?></td>								
								<td><?php echo ucwords($r->username)?></td>
                            </tr>
                            <?php $i++;}?>
                            
                            
                        </tbody>
                    </table>
                    <!-- END Datatables -->
<script src="<?php echo base_url()?>uadmin/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#tbl-frontoffice').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          'excel'
        ]
    } );
});

</script>