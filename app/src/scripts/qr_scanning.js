var scanner = new Instascan.Scanner({
  video: document.getElementById("preview"),
  captureImage: true,
  scanPeriod: 5,
});
scanner.addListener("scan", function (content, image) {
  
  document.getElementById("qr-scanned").src = image;
  // document.getElementById("content").innerHTML = content;

  let plusEncodedString = content.replaceAll("\+", "plus");

  var ajax = new XMLHttpRequest();
  ajax.open("POST", "validate_code.php", true);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send("code=" + plusEncodedString); 
  ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //   console.log(this.responseText);
      //   alert(this.responseText);

      // document.getElementById("user-type").innerHTML = this.responseText;


      // var userObj = JSON.parse(this.responseText);
      // document.getElementById("text-scanned").innerHTML = userObj.adminCode;
      // document.getElementById("user-picture").src = userObj.adminPic;

      // let currentDate = new Date();
      var d = new Date(),
      minutes = d.getMinutes().toString().length == 1 ? '0'+d.getMinutes() : d.getMinutes(),
      hours = d.getHours().toString().length == 1 ? '0'+d.getHours() : d.getHours(),
      ampm = d.getHours() >= 12 ? 'pm' : 'am';
      var time = hours +":"+ minutes + ampm;

      var userObj = JSON.parse(this.responseText);
      document.getElementById("user-type").innerHTML = userObj.userType;
      document.getElementById("user-picture").src = userObj.userPic;
      document.getElementById("user-lastname").innerHTML = userObj.lastName;
      document.getElementById("user-activity").innerHTML = userObj.activity;
      document.getElementById("user-time").innerHTML = time;
      // alert(this.responseText);
    }
  };
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

// function loadPHP(code) {
//   var ajax = new XMLHttpRequest();
//   ajax.open("POST", "validate_code.php", true);
//   ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   ajax.send("code=" + code);
//   ajax.onreadystatechange = function () {
//     if (this.readyState == 4 && this.status == 200) {
//       //   console.log(this.responseText);
//       //   alert(this.responseText);
//       document.getElementById("text-scanned").innerHTML = this.responseText;
//     }
//   };
// }
