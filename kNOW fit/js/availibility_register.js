document.addEventListener('DOMContentLoaded', init, false);
function init(){
var btn2 = document.getElementById("register_button");

function disableClick(event) {
    event.preventDefault();
    event.stopPropagation();
}

document.getElementById('username').addEventListener('input', function() {
    var username = this.value;
    if (username.length >= 3) {
        checkUsernameAvailability(username);
    } else {
        document.getElementById('username_availibityspan').innerHTML = '';
    }
});

function checkUsernameAvailability(username) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_username_availibilty.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('username_availibityspan').innerHTML = xhr.responseText;
            updateButtonStatus();
        }
    };
    xhr.send('username=' + username);
}

document.getElementById('email').addEventListener('input', function() {
    var email = this.value;
    if (email.length >= 10) {
        checkEmailAvailability(email);
    } else {
        document.getElementById('email_availibityspan').innerHTML = '';
    }
});

function checkEmailAvailability(email) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_email_availibilty.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('email_availibityspan').innerHTML = xhr.responseText;
            updateButtonStatus();
        }
    };
    xhr.send('email=' + email);
}

function updateButtonStatus() {
    var usernameAvailability = document.getElementById('username_availibityspan').innerHTML;
    var emailAvailability = document.getElementById('email_availibityspan').innerHTML;
    
    if (usernameAvailability === "<span>Username not available</span>" || 
        emailAvailability === "<span>Email already in use</span>") {
        btn2.addEventListener("click", disableClick);
    } else {
        btn2.removeEventListener("click", disableClick);
    }
}
};