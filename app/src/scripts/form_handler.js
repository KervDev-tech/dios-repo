
//made by Kervin Zoren Bonaobra 

window.onload=function(){

    var error = document.getElementsByClassName('hidden');

    var i;
    for (i = 0; i < error.length; i++) {
        error[i].style.display = 'none';
    }
}

function letterSpaceOnly(x, y, btn_id){
    var regexVal = /^([a-zA-Z ñÑ]{2,30})$/;
  
    var inputVal = document.getElementById(x).value;
  
    var error = document.getElementById(y);
  
    if(!inputVal == ""){
        if(!inputVal.match(regexVal)){
            error.style.display = 'block';
            document.getElementById(btn_id).disabled = true;
        }
        else{
            error.style.display = 'none';
            document.getElementById(btn_id).disabled = false;
        }
    }
    else{
        error.style.display = 'none';
        document.getElementById(btn_id).disabled = false;
    }
  }
  
  function numbersOnly(a, b, btn_id){
    var regexValNum = /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g;
  
    var inputValNum = document.getElementById(a).value;
  
    var errorNum = document.getElementById(b);
  
    if(!inputValNum == ""){
        if(!inputValNum.match(regexValNum)){
            errorNum.style.display = 'block';
            document.getElementById(btn_id).disabled = true;
        }
        else{
            errorNum.style.display = 'none';
            document.getElementById(btn_id).disabled = false;
        }
    }
    else{
        errorNum.style.display = 'none';
        document.getElementById(btn_id).disabled = false;
    }
  }

  function letterNumSpaceOnly(m, n, btn_id){
    var regexVal = /^([a-zA-Z0-9,. ñÑ]{2,50})$/;
  
    var inputVal = document.getElementById(m).value;
  
    var error = document.getElementById(n);
  
    if(!inputVal == ""){
        if(!inputVal.match(regexVal)){
            error.style.display = 'block';
            document.getElementById(btn_id).disabled = true;
        }
        else{
            error.style.display = 'none';
            document.getElementById(btn_id).disabled = false;
        }
    }
    else{
        error.style.display = 'none';
        document.getElementById(btn_id).disabled = false;
    }
  }
  
  function validateEmail(j, k, btn_id){
    var regexVal = /\S+@\S+\.\S+/;
  
    var inputVal = document.getElementById(j).value;
  
    var error = document.getElementById(k);
  
    if(!inputVal == ""){
        if(!regexVal.test(inputVal)){
            error.style.display = 'block';
            document.getElementById(btn_id).disabled = true;
        }
        else{
            error.style.display = 'none';
            document.getElementById(btn_id).disabled = false;
        }
    }
    else{
        error.style.display = 'none';
        document.getElementById(btn_id).disabled = false;
    }
  }
  
  function validatePassword(i, o, btn_id){
    var regexVal = /^([a-zA-Z0-9ñÑ_]{6,40})$/;
  
    var inputVal = document.getElementById(i).value;
  
    var error = document.getElementById(o);
  
    if(!inputVal == ""){
        if(!regexVal.test(inputVal)){
            error.style.display = 'block';
            document.getElementById(btn_id).disabled = true;
        }
        else{
            error.style.display = 'none';
            document.getElementById(btn_id).disabled = false;
        }
    }
    else{
        error.style.display = 'none';
        document.getElementById(btn_id).disabled = false;
    }
  }

  function validateRePassword(p, i, o, btn_id){
    
    var initialPw = document.getElementById(p).value;

    var rePw = document.getElementById(i).value;
  
    var error = document.getElementById(o);
  
    if(!rePw == ""){
        if(initialPw != rePw){
            error.style.display = 'block';
            document.getElementById(btn_id).disabled = true;
        }
        else{
            error.style.display = 'none';
            document.getElementById(btn_id).disabled = false;
        }
    }
    else{
        error.style.display = 'none';
        document.getElementById(btn_id).disabled = false;
    }
  }
    