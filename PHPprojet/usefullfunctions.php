<?php
echo '<head>
        <link rel="stylesheet" href="StyleSheet.css">
      </head>';
function start_page($title) {
    echo '<!doctype html>
             <html lang="fr">
             <head>
                <meta charset="utf-8">
                <title>' . $title . '</title>
                <script src=\'https://www.google.com/recaptcha/api.js\'></script>
                <link rel="stylesheet" href="StyleSheet.css">
             </head>
             <body>';
}

function Navigation() {
    echo '<div class="row">
            <div class="side">
                <div class="flex-container">
                    <div class="flex1">1</div>
                    <div class="flex2">2</div>
                    <div class="flex3">3</div>
                </div>;
            </div>
          </div>';
}

function end_page() {
    echo '</body>
          </html>';
}

function NAVIGATIONtest() {
    echo'<!DOCTYPE html>
    <html>
    <head>
        <title>Page Title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            * {
                box-sizing: border-box;
            }
    
            /* Style the body */
            body {
                font-family: Arial;
                margin: 0;
            }
    
            /* Header/logo Title */
            .header {
                padding: 60px;
                text-align: center;
                background: #1abc9c;
                color: white;
            }
    
            /* Style the top navigation bar */
            .navbar {
                display: flex;
                background-color: #333;
                flex-direction: column;
            }
    
            /* Style the navigation bar links */
            .navbar a {
                color: white;
                padding: 14px 20px;
                text-decoration: none;
            }
    
            /* Change color on hover */
            .navbar a:hover {
                background-color: #ddd;
                color: black;
            }
    
            /* Column container */
            .row {
                display: flex;
                flex-wrap: wrap;
            }
    
            /* Create two unequal columns that sits next to each other */
            /* Sidebar/left column */
            .side {
                flex: 30%;
                background-color: #f1f1f1;
                padding: 20px;
            }
    
            /* Main column */
            .main {
                flex: 70%;
                background-color: white;
                padding: 20px;
            }
    
            /* Fake image, just for this example */
            .fakeimg {
                background-color: #aaa;
                width: 100%;
                padding: 20px;
            }
    
            /* Footer */
            .footer {
                padding: 20px;
                text-align: center;
                background: #ddd;
            }
    
            /* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 700px) {
                .row, .navbar {
                    flex-direction: column;
                }
            }
        </style>
    </head>
    <body>
    
    <!-- Note -->
    <div style="background:yellow;padding:5px">
        <h4 style="text-align:center">Resize the browser window to see the responsive effect.</h4>
    </div>
    
    <!-- Header -->
    <div class="header">
        <h1>My Website</h1>
        <p>With a <b>flexible</b> layout.</p>
    </div>
    
    <div class="row">
        <div class="side">
            <div class="navbar">
            </div>
         </div>
    </div>
    
    <!-- The flexible grid (content) -->
    <div class="row">
        <div class="side">
            <a href="#">Link</a>
        </div>
        <div class="main">
            <p>la bite</p>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <h2>Footer</h2>
    </div>
    
    </body>
    </html>';
}
?>