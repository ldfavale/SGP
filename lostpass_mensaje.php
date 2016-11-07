


<body>
<head>
  <script src="public/js/jquery-2.1.4.min.js"></script>
  <script src="public/js/bootstrap.min.js"></script>
  <link href="public/css/bootstrap.min.css" rel="stylesheet">
</head>


<?php if(isset($_SESSION['id'])){
?>
<div class="alert alert-dismissible alert-success">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <strong>Ya hay una session Iniciada!</strong> Cierre la sesion y vuelva a resetear su contraseña
      </div>
  <?php
} else{


 ?>

  <div class="alert alert-dismissible alert-success">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <strong>Contraseña Cambiada!</strong> Se ha generado una nueva contraseña: <strong><?php echo $password ?></strong> Prueba <a href="login.php"> iniciar sesion </a> con ella.
     </div>

     <?php
   }

?>


</body>
</html>
