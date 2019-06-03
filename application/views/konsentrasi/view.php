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
      
                    <table id="example-datatables" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5"></th>
                                <th width="5">No</th>
                                <th width="100">Nama Pelatihan</th>
								<th width="50">Angkatan Pelatihan</th>
								<th width="50">Lokasi</th>
								<th width="50">Waktu</th>
								<th width="50">Tanggal Mulai</th>
								<th width="50">Tanggal Akhir</th>
								<th width="50">Harga</th>
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
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/edit/'.$r->konsentrasi_id;?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/delete/'.$r->konsentrasi_id;?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                    </div>
                                </td>
                                <td><?php echo $i;?></td>
                                <td><?php echo strtoupper($r->nama_prodi);?></td>  
								<td><?php echo strtoupper($r->nama_konsentrasi)?></td>
								<td><?php echo strtoupper($r->nama_gedung)?></td>
								<td><?php echo strtoupper($r->nama_waktu)?></td>
								<td><?php echo strtoupper($r->tglmulai)?></td>
								<td><?php echo strtoupper($r->tglakhir)?></td>
								<td><?php echo strtoupper($r->jumlah)?></td>
                            </tr>
                            <?php $i++;}?>
                            
                            
                        </tbody>
                    </table>
                    <!-- END Datatables -->