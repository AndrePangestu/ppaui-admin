<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
<?php
echo anchor($this->uri->segment(1).'/post','Tambah Data',array('class'=>'btn btn-danger   btn-sm'))
?>
                    <table id="example-datatables" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
                                <th>Level</th>
                                <th>Last Login</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                            $i=1;							
                            foreach ($record as $r)
                            {
								$active=$r->active==1?'Active':'Deactive';
                            ?>
							
                            
							
                            <tr>
                                <td width="80" class="text-center">
                                    <div class="btn-group">
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/edit/'.$r->id;?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/delete/'.$r->id;?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                    </div>
                                <td><?php echo $i;?></td>
                                <td><?php echo $r->first_name;?></a></td>
								<td><?php echo $r->last_name;?></a></td>
								<td><?php echo $r->email;?></a></td>
                                <td><?php foreach ($user->groups as $group):?><?php echo $group->name;?></td><?php endforeach?>
                                <td><?php echo tgl_indo($r->last_login);?></td>
                                <td><?php echo $active; ?></td>
                            </tr>
							
                            <?php $i++;}?>
                            
                            
                        </tbody>
                    </table>
                    <!-- END Datatables -->