<p>Silakan login dengan email dan password Anda.</p> 
<div id="infoMessage"><?php echo $message;?></div> 
<?php echo form_open("auth/login");?> 
<p> <label for="email">Email:</label><?php echo form_input($email);?> </p> 
<p> <label for="password">Password:</label> <?php echo form_input($password);?> </p> 
<p> <label for="remember">Remember Me:</label> <?php echo form_checkbox('remember', '1', FALSE);?> </p> 
<p><?php echo form_submit('submit', 'Login');?></p> 
<?php echo form_close();?> 

<a href="<?php echo site_url('auth/registrasi'); ?>">Buat akun baru</a> &middot; 
<a href="<?php echo site_url('auth/lupa_password'); ?>">Lupa password?</a>

