<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Animals</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/animals.css">
        <script src="js/animals.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>     
        <style>
            td {
                font-family: Arial, Helvetica, sans-serif;
                border: 5px solid;
                text-align: center;
                font-weight: bold;
            }
        </style>
    </head>

    <header style="background-color:white">
        <div id="secondary_screen_buttons">
            <div id="back_button" class="header_button">
                <a href="index.php"><img class="menu_button_image" src="images/back_icon.png" alt="Back Icon"></a>
            </div>
        </div>
        <div id="secondary_screen_title">
            <p>Create Custom Word</p>
        </div>
        <div id="secondary_screen_logo">
            <a href="https://telugupuzzles.com"><img class="logo_image" src="images/logo.png" alt="10000 Icon"></a>
        </div>
    </header>

    <body style="background-color:#f2edf2">
        <p style="text-align:center">Words must be 3 to 5 characters</p>
        <form action="custom_word_url.php" method="POST" autocomplete="off">
            <table style="color:black; margin-left:auto; margin-right: auto;">
                <tr>
                    <td>
                        Enter Custom Word:                     
                    </td>
                    <td>
                        <input type="text" name="word" required>
                    </td>

                <tr>
                    <td>
                        <input type="Submit" value="Submit" name = "submit">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>