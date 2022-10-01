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
                <a href="list_words.php"><img class="menu_button_image" src="images/back_icon.png" alt="Back Icon"></a>
            </div>
        </div>
        <div id="secondary_screen_title">
            <p>Add Puzzle Word</p>
        </div>
        <div id="secondary_screen_logo">
            <a href="https://telugupuzzles.com"><img class="logo_image" src="images/logo.png" alt="10000 Icon"></a>
        </div>
    </header>

    <body style="background-color:darkblue">
        <div id="body_panel">
            <div id="form_panel">
                <form id="add_word_form" action="insert.php" method="POST" autocomplete="off">
                    <div id="input_radio_buttons">
                        <div id="radio_options">
                            <input class="input_radio" type="radio" id="english" name="language_choice" value="English">
                            <label class="input_label" for="english">English</label>
                            <input class="input_radio" type="radio" id="telugu" name="language_choice" value="Telugu">
                            <label class="input_label" for="telugu">Telugu</label>
                        </div>
                    </div>
                    <label class="input_label" for="word">Word:</label><br>
                    <input class="input_text_field" type="text" name="word"><br>
                    <label class="input_label" for="clue">Clue:</label><br>
                    <textarea class="input_text_area" name="clue" maxlength="200"></textarea><br>
                    <input class="form_panel_submit" type="submit" value="Submit" name="submit">
                </form>
            </div>
        </div>
    </body>
</html>