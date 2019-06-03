<p>Silakan isikan data Anda di form ini.</p> 
<div id="infoMessage">
<?php echo $message;?>
</div>

<?php echo form_open("auth/registrasi");?> 

<p>Username:<br /> <?php echo form_input($username);?> </p> 
<p>Alamat Email:<br /> <?php echo form_input($email);?> </p> 
<p>Nama Depan:<br /> <?php echo form_input($first_name);?> </p> 
<p>Nama Belakang:<br /> <?php echo form_input($last_name);?> </p> 
<p>Nama Perusahaan:<br /> <?php echo form_input($company);?> </p> 
<p>Nomor Telepon:<br /> <?php echo form_input($phone);?> </p> 
<p>Password:<br /> <?php echo form_input($password);?> </p> 
<p>Ulangi Password:<br /> <?php echo form_input($password_confirm);?> </p> 

<p><?php echo form_submit('submit', 'Buat Akun');?></p> 

<?php echo form_close();?>