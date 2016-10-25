



<link href="public/css/bootstrap.min.css" rel="stylesheet">
<link href="public/css/login.css" rel="stylesheet">
<div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <div id="_AJAX_LOST_PASS_"></div>

            <form class="form-signin">

                <span id="reauth-email" class="reauth-email"></span>
                <h3>Resetear Contrase&ntilde;a</h3>
                <input type="text" id="email" class="form-control inputEmail" onkeypress="runScriptLostPass(event)" placeholder="Email address" required autofocus>
                <!-- <input type="password" id="pass" class="form-control inputPassword" placeholder="Password" required> -->
                <!-- <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" id="rec"  checked> Recuerdame
                    </label>
                </div> -->
                <button class="btn btn-lg btn-primary btn-block btn-signin" id="recuperar_pass" onclick="goLostPass()" type="button">Resetear</button>
            </form><!-- /form -->
            <a href="login.php" class="forgot-password">
                Iniciar Sesi&oacute;n
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script type="text/javascript" src="public/js/generales.js" > </script>
<script src="public/js/pass.js"></script>
