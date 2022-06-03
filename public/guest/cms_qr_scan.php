<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Document</title>
      <script src="../../app/src/scripts/instascan.min.js"></script>
      <style>
          *{
              outline: 1px solid black;
          }

          #main{
            display: flex;
          }
          #scanner-div{
            width: 600px;
          }

          #result-div{
              width: 600px;
          }
      </style>
    </head>
    <body>

          <div id="main">

                <div id="scanner-div">
          
                    <video id="preview" width="320" height="200"></video>
                    
                    <img src="" alt="hehe" id="qr-scanned" />

                </div>
                

                <div id="result-div">
                
                    <div id="picture-div">
                        <img src="" alt="hehe" id="user-picture" />
                    </div>

                    <div id="info-div">

                        <div id="lastname-div">
                            <p class="div-label">Lastname: </p> <h1 id="user-lastname"></h1>
                        </div> 

                        <div id="type-div">
                            <p class="div-label">User Type: </p> <h1 id="user-type"></h1>
                        </div>

                    </div>
                </div>

          </div>

          <script src="../../app/src/scripts/qr_scanning.js"></script>
    </body>
</html>
