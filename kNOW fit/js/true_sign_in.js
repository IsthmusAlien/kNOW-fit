document.addEventListener('DOMContentLoaded', init, false);
function init(){
var btn2 = document.getElementById("sign_in_button");

var intervalId = window.setInterval(function(){
    checkUsernamePasswordValidity();
}, 500);  

function disableClick(event) {
    event.preventDefault();
    event.stopPropagation();
}

function checkUsernamePasswordValidity(){
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    if(username != "" && password != ""){ 
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_username_password_validity.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('username_password_truespan').innerHTML = xhr.responseText;
            if (xhr.responseText == "<span>Incorrect Username or Password</span>"){
                btn2.addEventListener("click", disableClick);
            } else{
                btn2.removeEventListener("click", disableClick);
            }
        }
    };
    var data = 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password);
    xhr.send(data);
    }
}
};