function disableClick(event) {
    event.preventDefault();
    event.stopPropagation();
}

function check_true(){
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    checkUsernamePasswordValidity(username, password);
}

function blank(){
    document.getElementById('username_password_truespan').innerHTML = '';
}

function checkUsernamePasswordValidity(username, password){
    var btn2 = document.getElementById("sign_in_button");
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_username_password_validity.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('username_password_truespan').innerHTML = xhr.responseText;
            if (xhr.responseText == "<span>Username not available</span>"){
                btn2.addEventListener("click", disableClick);
            } else{
                btn2.removeEventListener("click", disableClick);
            }
        }
    };
    var data = 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password);
    xhr.send(data);
}