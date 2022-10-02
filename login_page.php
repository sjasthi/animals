<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Animals</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/animals.css">
        <script src="js/animals.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    <header style="background-color:white">
        <div id="secondary_screen_buttons">
            <div id="back_button" class="header_button">
                <a href="index.php"><img class="menu_button_image" src="images/back_icon.png" alt="Back Icon"></a>
            </div>
        </div>
        <div id="secondary_screen_title">
            <p>User Login</p>
        </div>
        <div id="secondary_screen_logo">
            <a href="https://telugupuzzles.com"><img class="logo_image" src="images/logo.png" alt="10000 Icon"></a>
        </div>
    </header>

    <body style="background-color:darkblue">
        <div id="body_panel">
            <div id="form_panel">
                <form id="login_form" action="index.php" method="post" onsubmit="processLogin();return false;">
                    <label class="login_label" for="email">Email Address:</label><br>
                    <input id="email_field" type="email" name="email"><br>
                    <label class="login_label" for="password">Password:</label><br>
                    <input id="password_field" type="password" name="password"><br>
                    <input id="login_submit_button" type="submit" value="Submit" name="submit">
                </form>
                <div id="login_message">
                </div>
            </div>
        </div>
        <script>
            let userCookieData = getCookie("userInfo");
            if(userCookieData != "") {
                let userData = JSON.parse(userCookieData);
                document.getElementById("email_field").value = userData[0];
            }
        </script>
    </body>