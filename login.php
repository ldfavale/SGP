
<?php require('core.php'); ?>
<link href="public/css/bootstrap.min.css" rel="stylesheet">
<link href="public/css/login.css" rel="stylesheet">
<div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <div id="_AJAX_LOGIN_"></div>

            <form class="form-signin">

                <span id="reauth-email" class="reauth-email"></span>
                <h2>Iniciar Sesi&oacute;n</h2>
                <input type="text" id="user" class="form-control inputEmail" onkeypress="runScriptLogin(event)" placeholder="Usuario" required autofocus>
                <input type="password" id="pass" class="form-control inputPassword" onkeypress="runScriptLogin(event)" placeholder="Contrase&ntilde;a" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" id="rec" checked> Recuerdame
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" id="iniciar_sesion" onclick="goLogin()" type="button">Iniciar Sesi&oacute;n</button>
            </form><!-- /form -->
            <a href="lostpass.php" class="forgot-password">
                Olvido su contrase&ntilde;a?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script type="text/javascript" src="public/js/generales.js" > </script>
<script src="public/js/login.js"></script>
