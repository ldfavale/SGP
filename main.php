<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            body{
    background: url(public/img/harvard.jpg);
	background-color: #444;background-attachment: fixed; background-size: cover;
        
    /*background: url(http://mymaplist.com/img/parallax/pinlayer2.png),url(http://mymaplist.com/img/parallax/pinlayer1.png),url(http://mymaplist.com/img/parallax/back.png);*/    
}

.vertical-offset-100{
    padding-top:100px;
}
        </style>
        
    
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Login</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                <link href="public/css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
<!--                <link href="public/css/styles.css" rel="stylesheet">-->
	</head>
    <body>
        <?php
        // put your code here
        ?>
        <div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
                                    <h3 class="panel-title">Ingrese Aqu&iacute;:</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Nombre de Usuario o E-mail" name="email" type="text">
			    		</div>
			    		<div class="form-group">
                                            <input class="form-control" placeholder="Contrase&ntilde;a" name="pass" type="password" value="">
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Recuerdame
			    	    	</label>
                                            <a href="" class="pull-right " >Registrarme</a>    
			    	    </div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
    </body>
</html>
