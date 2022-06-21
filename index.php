<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Animals</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/animals.css">
        <script src="js/animals.js"></script>    <!-- add ?newversion at end if chrome isn't updating js file -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>     
        <style>
            /* TD Settings for different numbers of guesses:
                8 guesses: width: 90px height 70px font-size 48px (image width 60px height auto)
               10 guesses: width: 80px height 60px font-size 42px (image width 50px height auto)
               12 guesses: width: 70px height 50px font-size 36px (image width 40px height auto)
            */
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
            <img src="images/logo.png" alt="10000 Icon" style="height:80px;width:auto;">
        </div>
        <div id="game_title">
            <p>Animals</p>
        </div>
        <div id="menu_buttons">
            <div id="help_button">
                <img src="images/help_icon.png" alt="Help Icon" style="Display:Block;width:70px;height:70px;">
            </div>
            <div id="stat_button">
                <img src="images/stat_icon.png" alt="Stat Icon" style="Display:Block;width:70px;height:70px;">
            </div>
            <div id="settings_button">
                <img src="images/settings_icon.png" alt="Settings Icon" style="Display:Block;width:70px;height:70px;">
            </div>
            <div id="profile_button">
                <img src="images/profile_icon.png" alt="Profile Icon" style="Display:Block;width:70px;height:70px;">
            </div>
        </div>
    </header>

    <body style="background-color:darkblue">
        <div id="game_panel">
            <div id="character_tile_panel">
                <table id="character_table"></table>
            </div>
            <div id="animal_tile_panel">
                <table id="animal_table"></table>
            </div>
        </div>
        <div id="submission_panel">
            <!-- Form calls Javascript function processGuess when the submit button is clicked. -->
            <form action="" method="post" autocomplete = "off" onsubmit="processGuess();return false">
                <input id="input_box" type="text" name="input_box">
                <input id="submit_button" type="submit" value="Submit" name="submit">
            </form>
        </div>
        <script>
            // Javascript function to pull puzzle_word details and build UI tables
            buildTables();
        </script>
    </body>
</html>