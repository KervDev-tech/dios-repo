<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="../../app/src/scripts/instascan.min.js"></script>
    <script>
                function loadPHP(code){
            var ajax = new XMLHttpRequest();
        ajax.open("POST", "validate_code.php", true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send("code=" + code);
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //   console.log(this.responseText);
                //   alert(this.responseText);
                document.getElementById("text-scanned").innerHTML = this.responseText;
            }
        };
        }
    </script>
    <style>
      * {
        outline: 1px solid black;
      }
    </style>
  </head>
  <body>
    <video id="preview" width="320" height="320"></video>

    <!-- <form method = "POST" id="myForm" action="">
        <input type="hidden" name="user_code" value="" id="text-scanned">
    </form> -->
    <button onclick="loadPHP()">load ajax</button>
    <img src="" alt="hehe" id="qr-scanned" />
    <h1 id="text-scanned"></h1>
    <?php
    
      if(isset($_POST['code'])){

        $userCode = $_POST['code'];

        echo $userCode;
      }

    ?>
    <!-- <script src="../../app/src/scripts/qr_scanning.js"></script> -->
    <script>
        var scanner = new Instascan.Scanner({
        video: document.getElementById("preview"),
        captureImage: true,
        });
        scanner.addListener("scan", function (content, image) {

        //   document.getElementById("text-scanned").value = content;

        //   document.getElementById("text-scanned").innerHTML = content;

        document.getElementById("qr-scanned").src = image;

        loadPHP(content);

        });

        Instascan.Camera.getCameras()
        .then(function (cameras) {
            if (cameras.length > 0) {
            scanner.start(cameras[0]);
            } else {
            console.error("No cameras found.");
            }
        })
        .catch(function (e) {
            console.error(e);
        });
    </script>
  </body>
</html>
