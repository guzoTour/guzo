document.getElementById('goto-signup').onclick = ()=>{
    document.getElementById('overview').style.display = "none";
    document.getElementById('sign-up').style.display = "block";
    document.getElementById('login').style.display = "none";
}
document.getElementById('goto-login').onclick = ()=>{
    document.getElementById('overview').style.display = "none";
    document.getElementById('sign-up').style.display = "none";
    document.getElementById('login').style.display = "block";
}

document.getElementById('sign-up-form').onsubmit = ()=>{
    document.getElementById('overview').style.display = "block";
    document.getElementById('sign-up').style.display = "none";
    document.getElementById('login').style.display = "none";
    document.getElementById('goto-login').style.visibility = "hidden"
    document.getElementById('goto-signup').style.visibility = "hidden";
    document.getElementById('my-booking').style.visibility = "visible";
    document.getElementById('my-profile').style.visibility = "visible";
}

document.getElementById('login-form').onsubmit = ()=>{
    document.getElementById('overview').style.display = "block";
    document.getElementById('sign-up').style.display = "none";
    document.getElementById('login').style.display = "none";
    document.getElementById('goto-login').style.visibility = "hidden"
    document.getElementById('goto-signup').style.visibility = "hidden";
    document.getElementById('my-booking').style.visibility = "visible";
    document.getElementById('my-profile').style.visibility = "visible";
  
}