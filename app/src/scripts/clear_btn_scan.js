document.getElementById("reset-data-btn").addEventListener('click', clearInfo);

var scanned;

setInterval(waitElement, 3000);

function waitElement(){
    scanned = document.getElementById("user-lastname").innerHTML;

    if(scanned != "..."){
        setTimeout(clearInfo, 8000);
        scanned = "";
    }
}
function clearInfo(){
    document.getElementById("user-type").innerHTML = '...';
    document.getElementById("user-picture").src = '...';
    document.getElementById("user-lastname").innerHTML = '...';
    document.getElementById("user-activity").innerHTML = '...';
    document.getElementById("user-time").innerHTML = '...';
    document.getElementById("qr-scanned").src = '...';
}