<?php
	require 'db_configuration.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Custom Words Table</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/animals.css">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <script src="js/animals.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>     
        <style>
            td {
                font-family: Arial, Helvetica, sans-serif;
                border: 5px solid;
                text-align: center;
                font-weight: bold;
            }
            #title {
                text-align: center;
                color: darkgoldenrod;
            }
            #toggle {
                color: 	#4397fb;
            }
            #toggle:hover {
                color: #467bc7
            }
            thead input {
                width: 100%;
            }
            .thumbnailSize{
                height: 100px;
                width: 100px;
                transition:transform 0.25s ease;
            }
            .thumbnailSize:hover {
                -webkit-transform:scale(3.5);
                transform:scale(3.5);
            }
        </style>
    </head>

    <header style="background-color:white">
        <div id="secondary_screen_buttons">
            <div id="back_button" class="header_button">
                <a href="index.php"><img class="menu_button_image" src="images/back_icon.png" alt="Back Icon"></a>
            </div>
            <div id="add_button" class="header_button">
                <a href="create_custom_word.php"><img class="menu_button_image" src="images/add_icon.png" alt="Add Icon"></a>
            </div>
        </div>
        <div id="secondary_screen_title">
            <p>Custom Word List</p>
        </div>
        <div id="secondary_screen_logo">
            <a href="https://telugupuzzles.com"><img class="logo_image" src="images/logo.png" alt="10000 Icon"></a>
        </div>
    </header>
    <body style="background-color:#f2edf2">

<?php $page_title = 'Animals > custom word list';

# Page Content
include('table_custom_words.php');
?>

    </body>
</html>