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
        <div id="logo">
            <a href="telugupuzzles.com"><img src="images/logo.png" alt="10000 Icon" style="height:80px;width:auto;"></a>
        </div>
        <div id="game_title">
            <p>Create Word</p>
        </div>
        <div id="menu_buttons">
            <div id="help_button">
                <img src="images/help_icon.png" alt="Help Icon" style="Display:Block;width:70px;height:70px;">
            </div>
            <div id="stat_button">
                <a href="list_words.php"><img src="images/stat_icon.png" alt="Stat Icon" style="Display:Block;width:70px;height:70px;"></a>
            </div>
            <div id="settings_button">
                <img src="images/settings_icon.png" alt="Settings Icon" style="Display:Block;width:70px;height:70px;">
            </div>
            <div id="profile_button">
                <img src="images/profile_icon.png" alt="Profile Icon" style="Display:Block;width:70px;height:70px;">
            </div>
        </div>
    </header>

    <body style="background-color: #03fce8">
        <div align="left">
            <button><a href="index.php" style="background-color:white; position: absolute; left: 20px;">Return to game</a></button>
        </div>
        <form action="insert.php" method="POST">
            <table style="color:black; margin-left:auto; margin-right: auto;">
                <tr>
                    <td>
                        Enter Word:                     
                    </td>
                    <td>
                        <input type="text" name="word" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Enter Date to be played:                     
                    </td>
                    <td>
                        <input type="date" name="date" required>
                    </td>
                </tr>
                <tr>
                <td>
                        Enter time to be played:                     
                    </td>
                    <td>
                        <input type="time" name="time" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="Submit" value="Submit" name = "submit">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>