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
            <p>Update Custom Word</p>
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

  <?php

$word;
$date;
$time;
$winning_plays;
$total_plays;

if (isset($_GET['id'])){
    $conn = mysqli_connect("localhost", "root", "", "ics499_animals");
    $word = $_GET['id'];
    $sql = "SELECT * FROM puzzle_words
            WHERE word = '$word'";
    $result = $conn->query($sql);

    if ($result -> num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $date=$row["date"];
        $time = $row["time"];
        $winning_plays = $row["winning_plays"];
        $total_plays = $row["total_plays"];
    }//end if
    $conn -> close(); 
}//end if
}

?>

    <body style="background-color: #03fce8">
        <div align="left">
            <button><a href="index.php" style="background-color:white; position: absolute; left: 20px;">Return to game</a></button>
        </div>
        <form action="update.php?rn=<?php echo $_GET['id'] ?>" method="POST">
            <table style="color:black; margin-left:auto; margin-right: auto;">
                <tr>
                    <td>
                        New Date:                     
                    </td>
                    <td>
                        <input placeholder="<?php echo $date ?>" type="date" name="new_date">
                    </td>
                </tr>
                <tr>
                    <td>
                        New Time:                     
                    </td>
                    <td>
                        <input placeholder="<?php echo $time ?>"type="time" name="new_time">
                    </td>
                </tr>
                <tr>
                    <td>
                        New Winning Plays:                     
                    </td>
                    <td>
                        <input placeholder="<?php echo $winning_plays ?>" type="number" name="new_winning_plays">
                    </td>
                </tr>
                <tr>
                    <td>
                        New Total Plays:                     
                    </td>
                    <td>
                        <input placeholder="<?php echo $total_plays ?>" type="number" name="new_total_plays">
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