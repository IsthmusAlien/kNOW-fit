document.addEventListener("DOMContentLoaded", function() {
    var btn1 = document.getElementById("register_box");
    var btn2 = document.getElementById("register_button");

    updateButtonState();

    btn1.addEventListener("change", updateButtonState);

    function disableClick(event) {
        event.preventDefault();
        event.stopPropagation();
    }

    function updateButtonState() {
        if (btn1.checked) {
            btn2.removeEventListener("click", disableClick);
        } else {
            btn2.addEventListener("click", disableClick);
        }
    }
});