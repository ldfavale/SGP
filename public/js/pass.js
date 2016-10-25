function goLostPass(){

  var connect, form, respose, result, user, pass , rec;

  email = __('email').value;


  form = 'email='+email;

  connect = window.XMLHttpRequest ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
  connect.onreadystatechange = function(){

      if(connect.readyState == 4 && connect.status == 200 ){

        // if(connect.responseText == 1){



            //  __('_AJAX_CHANGE_PASS_').innerHTML = result;
             console.log(connect.responseText);
             //window.location = "index.php";
        // }else{
          __('_AJAX_LOST_PASS_').innerHTML = connect.responseText;
        //}
        // if(connect.responseText == 1){
        //
        //      result = '<div class="alert alert-dismissible alert-success">';
        //      result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        //      result +='<h4>Contrase&ntilde;a Reseteada!</h4>';
        //      result +='<p>Te hemos enviado un email con la nueva contrase&ntilde;a.</p>';
        //      result += '</div>';
        //
        //      __('_AJAX_LOST_PASS_').innerHTML = result;
        //      console.log(result);
        //      //window.location = "index.php";
        // }else{
        //   __('_AJAX_LOST_PASS_').innerHTML = connect.responseText;
        // }

      }else if (connect.readyState == 4) {


        result = '<div class="alert alert-dismissible alert-warning">';
   result += '<button type="button" class="close" data-dismiss="alert">x</button>';
   result +='<h4>Procesando...</h4>';
   result +='<p></p>';
 result += '</div>';


 __('_AJAX_LOST_PASS_').innerHTML = result;
 console.log(result);

      }

      // __('_AJAX_LOGIN_').innerHtml = result;

  }
  connect.open('POST','ajax.php?mode=lostpass',true);
  connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');// Sin esta linea NO HACE NADA!!!!
  connect.send(form);
}
function goChangePass(){

  var connect, form, respose, result, actual ,nueva, confirma;

  actual = __('actual').value;
  nueva = __('nueva').value;
  confirma = __('confirma').value;
  validacion = validarPass(nueva);

if( validacion === true){

  form = 'actual='+actual+'&nueva='+nueva+'&confirma='+confirma;

  connect = window.XMLHttpRequest ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
  connect.onreadystatechange = function(){
      

   if(connect.readyState == 4 && connect.status == 200 ){

        // if(connect.responseText == 1){



            //  __('_AJAX_CHANGE_PASS_').innerHTML = result;
             console.log(result);
             //window.location = "index.php";
        // }else{
          __('_AJAX_CHANGE_PASS_').innerHTML = connect.responseText;
        //}

      }else if (connect.readyState == 4) {


        result = '<div class="alert alert-dismissible alert-warning">';
   result += '<button type="button" class="close" data-dismiss="alert">x</button>';
   result +='<h4>Procesando...</h4>';
   result +='<p></p>';
 result += '</div>';


 __('_AJAX_CHANGE_PASS_').innerHTML = result;
 console.log(result);

      }

      // __('_AJAX_LOGIN_').innerHtml = result;

  }
  connect.open('POST','ajax.php?mode=changepass',true);
  connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');// Sin esta linea NO HACE NADA!!!!
  connect.send(form);
  
    }else{
        
        result = '<div class="alert alert-dismissible alert-danger">';
   result += '<button type="button" class="close" data-dismiss="alert">x</button>';
   result +='<h4>Error</h4>';
   result +='<p>'+validacion+'</p>';
 result += '</div>';


 __('_AJAX_CHANGE_PASS_').innerHTML = result;
 console.log(result);
    }
}

function runScriptChangePass(e){

if(e.keyCode == 13){
  goChangePass();
}
}
function runScriptLostPass(e){

if(e.keyCode == 13){
  goLostPass();
}
}
function validarPass(pass){

if(pass === ''){
    
  result = 'La contrasena no puede ser vacia';
  
}else {
    
        result = '';
   if(pass.length < 8 || !tiene_numeros(pass) || !tiene_minusculas(pass) || !tiene_mayusculas(pass) ) {     
        
        result += 'La contrasena debe contener:<br/>';
        
            if(pass.length < 8){
    
            result += '  -> Al menos 8 caracteres<br/>';
  
        }
        if(!tiene_numeros(pass) ){
    
            result += '-> Al menos un numero<br/>';
  
        }
        if(!tiene_minusculas(pass) ){
    
            result += '-> Al menos una minuscula.<br/>';
  
        }
        if(!tiene_mayusculas(pass) ){
    
            result += '-> Al menos una mayúscula<br/>';
  
        }
    }else{
        return true; 
        
    } 
    
}
    return result;
}



function tiene_numeros(texto){
    
    var numeros="0123456789";
    
   for(i=0; i<texto.length; i++){
      if (numeros.indexOf(texto.charAt(i),0)!=-1){
         return true;
      }
   }
   return false;
}



function tiene_minusculas(texto){
    
    var letras="abcdefghyjklmnñopqrstuvwxyz";
    
   for(i=0; i<texto.length; i++){
      if (letras.indexOf(texto.charAt(i),0) !== -1){
         return true;
      }
   }
   return false;
}

var letras_mayusculas="ABCDEFGHYJKLMNÑOPQRSTUVWXYZ";

function tiene_mayusculas(texto){
    
    var letras_mayusculas="ABCDEFGHYJKLMNÑOPQRSTUVWXYZ";
    
   for(i=0; i<texto.length; i++){
      if (letras_mayusculas.indexOf(texto.charAt(i),0) !== -1){
         return true;
      }
   }
   return false;
}


