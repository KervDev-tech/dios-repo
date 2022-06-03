var imageDataURL;
var qrcode = "<?php echo $code; ?>";

function doCapture() {
    window.scrollTo(0, 0);

    html2canvas(document.getElementById("id-div")).then(function (canvas) {

        var ajax = new XMLHttpRequest();
        ajax.open("POST", "generate_id.php", true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send("image=" + canvas.toDataURL("image/jpeg", 0.9) + "&code=" + qrcode);
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                alert(this.responseText);
            }
        };
    });
}