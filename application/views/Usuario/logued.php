<!DOCTYPE html>
<!-- saved from url=(0042)http://www.eakroko.de/flat/more-login.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!-- Apple devices fullscreen -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <!-- Apple devices fullscreen -->
  <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent">

  <title>ALDIDACOM -Login</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?php echo  base_url() ?>recursos/login/bootstrap.min.css">

  <!-- Theme CSS -->
  <link rel="stylesheet" href="<?php echo  base_url() ?>recursos/login/style.css">
  <!-- Color CSS -->
  <link rel="stylesheet" href="<?php echo  base_url() ?>recursos/login/themes.css">


  <!-- jQuery -->
  <script type="text/javascript" async="" src="<?php echo  base_url() ?>recursos/login/ga.js"></script><script src="<?php echo  base_url() ?>recursos/login/jquery.min.js"></script>

  <!-- Nice Scroll -->
  <script src="<?php echo  base_url() ?>recursos/login/jquery.nicescroll.min.js"></script>
  <!-- Validation -->
  <script src="<?php echo  base_url() ?>recursos/login/jquery.validate.min.js"></script>
  <script src="<?php echo  base_url() ?>recursos/login/additional-methods.min.js"></script>
  <!-- icheck -->
  <script src="<?php echo  base_url() ?>recursos/login/jquery.icheck.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo  base_url() ?>recursos/login/bootstrap.min.js"></script>
  
  

</head>

<body class="login" cz-shortcut-listen="true">
  <div class="wrapper">
    <h1>
      <a href="#">
        <img src="<?php echo  base_url() ?>recursos/login/aldidacom2.png" alt="" class="retina-ready" width="59" height="49">ALDIDACOM</a>
    </h1>
    <div class="login-body">
      <h2>INGRESO AL SISTEMA</h2>
      <?= form_open('Usuarios/logued')?>
        <div class="form-group">
          <div class="email controls">
             <input  name = "username" class="form-control" id="exampleInputEmail1" placeholder="Username" required="true">
          </div>
        </div>
        <div class="form-group">
          <div class="pw controls">
             <input name ="pass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required="true">
          </div>
        </div>
        <div class="submit">          
          <?php echo form_submit(array('type'=>'submit','value'=>'Ingresar','class'=>'btn btn-primary'))?>
        </div>
      
      <?= form_close()?> 

      <? if ($error != "")
       {?>
         <div class='panel-body'><div class='alert alert-danger'>
          <?= $error?> &times;
          </div></div>
       <?}
      
      ?>
      
      <div class="forget">
        <a href="">
          <span>Empresa de Tecnología</span>
        </a>
      </div>
    </div>
  </div>
  
</body>
</html>