<?php
// Retrieve word info from database.
require 'db_configuration.php';
if (isset($_GET['id'])){
    $conn = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    $word = $_GET['id'];
    $sql = "SELECT * FROM puzzle_words
            WHERE word = '$word'";
    $result = $conn->query($sql);

    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $date = $row["date"];
            $time = $row["time"];
            $clue = $row["clue"];
        }
        $conn -> close(); 
    }
}

// Retrieve current date (Words with dates that have passed cannot be revised since they were already played)
date_default_timezone_set('America/Chicago');
$today_date = date("Y-m-d");

// Date of word we want to revise is in the future, so word hasn't been played yet.  Ok to revise.
if($date > $today_date) {
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
                    <a href="list_words.php"><img class="menu_button_image" src="images/back_icon.png" alt="Back Icon"></a>
                </div>
            </div>
            <div id="secondary_screen_title">
                <p>Update Puzzle Word</p>
            </div>
            <div id="secondary_screen_logo">
                <a href="https://telugupuzzles.com"><img class="logo_image" src="images/logo.png" alt="10000 Icon"></a>
            </div>
        </header>

    <?php
    $word;
    $date;
    $time;
    $winning_plays;
    $total_plays;
    $clue;

    if (isset($_GET['id'])){
        $conn = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
        $word = $_GET['id'];
        $sql = "SELECT * FROM puzzle_words WHERE word = '$word'";
        $result = $conn->query($sql);

        if ($result -> num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $date = $row["date"];
                $time = $row["time"];
                $winning_plays = $row["winning_plays"];
                $total_plays = $row["total_plays"];
                $clue = $row["clue"];
            }
        }
        $conn -> close();
    }
    ?>
        <body style="background-color: darkblue">
            <div id="body_panel">
                <div id="form_panel">
                    <form id="update_word_form" action="update.php?rn=<?php echo $_GET['id'] ?>" method="POST" autocomplete="off">
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

<?php 
// Date of word we want to revise is in the past.  Word has already been played.  Not ok to revise.
} else {
?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <title>Animals Table</title>
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
                <div id="back_button">
                    <a href="index.php"><img class="menu_button_image" src="images/back_icon.png" alt="Back Icon"></a>
                </div>
                <div id="add_button">
                    <a href="create_word.php"><img class="menu_button_image" src="images/add_icon.png" alt="Add Icon"></a>
                </div>
            </div>
            <div id="secondary_screen_title">
                <p>Puzzle Word List</p>
            </div>
            <div id="secondary_screen_logo">
                <a href="https://telugupuzzles.com"><img class="logo_image" src="images/logo.png" alt="10000 Icon"></a>
            </div>
        </header>
        <body style="background-color:#f2edf2">

            <!-- Page Content -->
            <br>
            <br>
    
            <h2 id="title">Word List</h2><br>
            <h3 id="title">Unable to update words that have dates/times in the past.</h3>

            <?php include('table_puzzle_words.php'); ?>
        
        </body>
    </html>
<?php
}
?>