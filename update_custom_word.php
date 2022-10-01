
<?php
require 'db_configuration.php';
if (isset($_GET['id'])){
    $conn = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    $id = $_GET['id'];
    $sql = "SELECT * FROM custom_Words
            WHERE Id = '$id'";
    $result = $conn->query($sql);

    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $word = $row["word"];
            $email = $row["Email"];
            $clue = $row["clue"];
        }
    $conn -> close(); 
    }
}

?>

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
                <a href="list_custom_words.php"><img class="menu_button_image" src="images/back_icon.png" alt="Back Icon"></a>
            </div>
        </div>
        <div id="secondary_screen_title">
            <p>Update Custom Word</p>
        </div>
        <div id="secondary_screen_logo">
            <a href="https://telugupuzzles.com"><img class="logo_image" src="images/logo.png" alt="10000 Icon"></a>
        </div>
    </header>

    <body style="background-color: darkblue">
        <div id="body_panel">
            <div id="form_panel">
                <form id="update_word_form" action="update_custom.php?rn=<?php echo $_GET['id'] ?>" method="POST" autocomplete="off">
                    <label class="input_label" for="word">Word:</label><br>
                    <input class="input_text_field" type="text" placeholder=<?php echo $word ?> name="word" disabled><br>
                    <label class="input_label" for="clue">Clue:</label><br>
                    <textarea class="input_text_area" placeholder=<?php echo "'$clue'" ?> name="clue" maxlength="200"></textarea><br>
                    <input class="form_panel_submit" type="submit" value="Submit" name="submit">
                </form>
            </div>
        </div>
    </body>
</html>