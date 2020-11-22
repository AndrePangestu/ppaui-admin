<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
<script src="<?php echo base_url();?>assets/js/1.8.2.min.js"></script>
<script>
  $( document ).ready(function() {
    $( "#jurusan" ).hide();
  });
  </script>
  <script>
$(document).ready(function(){
    $("#level").change(function(){
        var level = $("#level").val();  
        if(level==2)
            {
                $( "#jurusan" ).show();
            }
            else
            {
                $( "#jurusan" ).hide();  
            }
  });
});
</script>
<?php
//echo form_open($this->uri->segment(1).'/edit');
echo form_open_multipart(uri_string());
$level=array(1=>'Super Admin',2=>'Staf Administrasi',3=>'Staff Keuangan',4=>'Boss');
$class      ="class='form-control' id='level'";
?>
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
  
    <!-- <tr>
    <td width="150">Username</td><td>
        <?php echo inputan('text', 'username','col-sm-3','Username ..', 1, $user->username,'');?>
    </td>
    </tr> -->
	<tr>
    <td width="150">First name</td><td>
    <?php echo inputan('text', 'first_name','col-sm-3','First name ..', 1, $user->first_name,'');?>
    </td>
    </tr>
    <tr>
    <td width="150">Last name</td><td>
    <?php echo inputan('text', 'last_name','col-sm-3','Last Name ..', 1, $user->last_name,'');?>
    </td>
    </tr>
    <tr>
    <td width="150">Company name</td><td>
    <?php echo inputan('text', 'company','col-sm-3','Company ..', 1, $user->company,'');?>
    </td>
    </tr>
	<tr>
    <tr>
    <td width="150">Phone</td><td>
        <?php echo inputan('number', 'phone','col-sm-3','Phone ..', 1, $user->phone,'');?>
    </td>
    </tr>
    <tr>
    <tr>
    <td width="150">Email</td><td>
        <?php echo inputan('text', 'email','col-sm-3','Email ..', 1, $user->email,'');?>
    </td>
    </tr>
    
    <tr>
    <td width="150">Password</td><td>
        <?php echo inputan('password', 'password','col-sm-3','Password ..', 0, '','');?>
    </td>
    </tr>
    <tr>
    <td width="150">Confirm Password: </td><td>
        <?php echo inputan('password', 'password_confirm','col-sm-3','Password ..', 0, '','');?>
    </td>
    </tr>
    <tr>
    <td width="150">Level</td><td>
        <div class="col-sm-3">
        <?php echo form_dropdown('id_lvl_admin',$level,$user->id_lvl_admin,$class);?>
        </div>
    </td>
    </tr>
    <tr id="jurusan">
    <td width="150">Jurusan</td><td>
    <?php echo inputan('admin_jurusan', 'admin_jurusan','col-sm-3','jurusan ..', '', '','');?>
    </td>
    </tr>
    <tr>
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
  </div></div>
  <?php echo form_hidden('id', $user->id);?>
     <?php echo form_hidden($csrf); ?>
     <?php echo  form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());  ?>
<?php echo form_close();?>