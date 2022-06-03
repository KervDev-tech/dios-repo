<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiOS | Home</title>
    <link rel="stylesheet" href="app/src/styles/login_style.css">
    <link rel="stylesheet" href="app/src/styles/navbar_home_style.css">
    <link rel="stylesheet" href="app/src/styles/scroll_style.css">
    <link rel="stylesheet" href="app/src/styles/index_style.css">
</head>
<body>
    <div id="header">
        <div id="navbar">
            <div class="logo">
                <img class="logo-pic" src="app/src/img/dios_logo.png" alt="DIOS LOGO">
            </div>
            <div class="navitems">
                <li><a href="index.php">Home</a></li>
                <li><a href="public/services/qr_scanning.php">WFH QR Code Scanning</a></li>
                <li>Sign up | <a href="public/emp/emp_register.php" id="signup-btn-emp"> Employee </a></li>
                <li>Login | <a href="public/emp/emp_login.php" id="login-btn-emp"> Employee </a> | <a href="public/admin/cms_admin_login.php" id="login-btn-guest"> Admin </a></li>
            </div>
        </div>
    </div>
    <div id="container">
        <header class="intro-header">
            <div class="intro">
                No need for physical ID in your workplace.<br>Making lives better with DIOS App.
                <br>
                Not a member yet? <em><a href="public/emp/emp_register.php" id="signup-btn-home">Sign up here!</a></em>
                <!-- <div class="office-pic">
                    <img src="img/office.jpg">
                </div> -->
            </div>
        </header>
        <section class="provide-section">
            <div class="item-header">
                WE PROVIDE
            </div>
            <div class="item-list">
                <div class="item">
                    <i class="fas fa-recycle" style="font-size:10em;"></i><br>
                    <h3>PAPERLESS</h3>
                    <p>Lessening the usage of paper for employee tracker.</p>
                </div>
                <div class="item">
                    <i class="fas fa-database" style="font-size:10em;"></i><br>
                    <h3>FLEXIBLE</h3>
                    <p>Giving a new method of attendance system for virtual setups</p>
                </div>
                <div class="item">
                    <i class="fas fa-lock" style="font-size:10em;"></i><br>
                    <h3>SECURED</h3>
                    <p>Storing data in encrypted systems</p>
                </div>
            </div>
        </section>
        <section class="about-section">
            <div class="item-header">
                ABOUT APP
            </div>
            <div class="item-list">
                <img class="dios-qr"src="app/src/img/qr-code.png"> 
            </div>
            <p class="item-list">
                Biometric system is the commonly used for tracking individuals. It is used to recognize data collected from a body
                part
                or a voice of an individual through mathematical algorithms. One of the most common biometric identifier is
                fingerprint
                and it is widely used in companies for attendance systems. As the pandemic arises, fingerprint scanning can be one
                of
                the factors for contact transmission of virus from an individual to another.
                <br><br>
                Quick Response (QR) code is a new approach of recognition system where the data collected from a series of strings
                are plotted to a matrix barcode. Unlike fingerprint scanning system, QR Code can be used contactlessly and remotely.
                In addition, it is cheaper than a biometric system because it only needs a program, data, data storage and a camera
                to work.
                <br><br>
                Digital Information Operating Systems (DIOS) is a QR Code based Web Application which is
                created last 2019 by Computer Engineering students from the Polytechnic University of the Philippines - Manila. It
                aims to provide a more efficient, safer and secured system for contactless attendance tracking for companies. Also, it can be used to provide data for contact-tracing and data analytics.
            </p>
        </section>
        <section class="dios-section">
            <div class="item-header">
                OUR TEAM
            </div>
            <div class="item-list">
                WEB DEVELOPMENT
            </div>

            <div class="item-list">

                <div class="item">
                    <img class="item-pic"src="app/src/img/team/pinero.png"/>
                    <h3>John Alfred Pinero</h3>
                    <p>Leader / Web Designer</p>
                </div>

                <div class="item">
                    <img class="item-pic"src="app/src/img/team/kevin.png"/>
                    <h3>Kervin Zoren Bonaobra</h3>
                    <p>Head Full Stack Developer</p>
                </div>

                <div class="item">
                    <img class="item-pic"src="app/src/img/team/dann.png"/>
                    <h3>Dann Edric Cervantes</h3>
                    <p>Web Designer</p>
                </div>
            </div>

            <div class="item-list">
                DATA SCIENCE
            </div>

            <div class="item-list">
                <div class="item">
                    <img class="item-pic"src="app/src/img/team/mark.png"/>
                    <h3>Mark John Raymundo</h3>
                    <p>Data Engineer</p>
                </div>
                <div class="item">
                    <img class="item-pic"src="app/src/img/team/angelo.png"/>
                    <h3>Angelo Solivas</h3>
                    <p>Data Scientist</p>
                </div>
                <div class="item">
                    <img class="item-pic" src="app/src/img/team/laidez.png"/>
                    <h3>Laidez Blancas</h3>
                    <p>Data Scientist</p>
                </div>
                <div class="item">
                    <img class="item-pic"src="app/src/img/team/spongebob.jpg"/>
                    <h3>Joannes Bartolome</h3>
                    <p>Data Analyst</p>
                </div>
            </div>
        </section>
        
        <footer class="contact-footer">
            <div class="item-header">
                CONTACT US 
            </div>
            <div class="item-list">
                Tel No. : 777-7777 <br>
                    Address : 1016 Anonas, Sta. Mesa, Maynila, Kalakhang Maynila <br>
                    Email : dios.webapp@gmail.com
            </div>
        </footer>
    </div>
    <div id="footer">
        Copyright © 2021 | DiOS Web Application | Made with 💗
    </div>
</body>
</html>