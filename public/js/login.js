function goLogin(){

  var connect, form, respose, result, user, pass , rec;

  user = __('user').value;
  pass = __('pass').value;
  rec = __('rec').checked ? true : false;

  form = 'user='+user+'&pass='+pass+'&rec='+rec;

  connect = window.XMLHttpRequest ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
  connect.onreadystatechange = function(){

      if(connect.readyState == 4 && connect.status == 200 ){

        if(connect.responseText == 1){

             result = '<div class="alert alert-dismissible alert-success">';
             result += '<button type="button" class="close" data-dismiss="alert">x</button>';
             result +='<h4>Sesion Iniciada!</h4>';
             result +='<p>Te estamos redirigiendo...</p>';
             result += '</div>';

             __('_AJAX_LOGIN_').innerHTML = result;
             console.log(result);
             window.location = "index.php";
        }else{
          __('_AJAX_LOGIN_').innerHTML = connect.responseText;
        }

      }else if (connect.readyState == 4) {


        result = '<div class="alert alert-dismissible alert-warning">';
   result += '<button type="button" class="close" data-dismiss="alert">x</button>';
   result +='<h4>Procesando...</h4>';
   result +='<p></p>';
 result += '</div>';


 __('_AJAX_LOGIN_').innerHTML = result;
 console.log(result);

      }

      // __('_AJAX_LOGIN_').innerHtml = result;

  }
  connect.open('POST','ajax.php?mode=login',true);
  connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');// Sin esta linea NO HACE NADA!!!!
  connect.send(form);
}


function runScriptLogin(e){

if(e.keyCode == 13){
  goLogin();
}
}
