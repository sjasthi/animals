<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Animals Table</title>
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
            <a href="index.php"><img src="images/logo.png" alt="10000 Icon" style="height:80px;width:auto;"></a>
        </div>
        <div id="game_title">
            <p>Word Bank Table</p>
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
        <div style="position: absolute; right: 20px;">
            <button><a href="create_word.php" style="background-color:white">Create a Custom Word</a></button>
       </div>
        <div>
            <h1 style="text-align:center">Custom Words</h3>
        </div>
        <div>
        <table style="margin-left:auto; margin-right:auto">
            <tr>
                <th>Word Id</th>
                <th>Custom Word</th>
                <th>Email</th>
                <th>Winning Plays</th>
                <th>Total Plays</th>
            </tr>
            <?php
                $conn = mysqli_connect("localhost", "root", "", "ics499_animals");
                $sql = "SELECT * FROM custom_words";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result -> fetch_assoc()) {
                        echo "<tr><td>" . $row["Id"] . "</td><td>" . $row["word"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["total_plays"] . "</td><td>" . $row["winning_plays"] . "</td></tr>";
                    }
                } else {
                    echo "No results";
                }
            ?>
        </table>
        </div>
        <div>
            <h1 style="text-align:center">Puzzle Words</h3>
        </div>
        <div>
            <table style="margin-left:auto; margin-right:auto">
                <tr>
                    <th>Word</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Total Plays</th>
                    <th>Winning Plays</th>
                    <th>Modify</th>
                    <th>Delete</th>
                </tr>
                <?php
                    $conn = mysqli_connect("localhost", "root", "", "ics499_animals");
                    $word=$_GET['rn'];
                    $query = "DELETE FROM puzzle_words WHERE word = '$word'";
                    $data=mysqli_query($conn,$query);

                    $sql = "SELECT * FROM puzzle_words";
                    
                    $result = $conn->query($sql);

                    if($data) {
                        echo "<br><p style='text-align:center'>Record deleted successfully</p> <br>";
                    } else {
                        echo "Error <br><br> <a href='list_words.php'>Return To List</a>";
                    }

                    if ($result->num_rows > 0) {
                        while ($row = $result -> fetch_assoc()) {
                            echo "<tr><td>" . $row["word"] . "</td>
                            <td>" . $row["date"] . "</td>
                            <td>" . $row["time"] . "</td>
                            <td>" . $row["total_plays"] . "</td>
                            <td>" . $row["winning_plays"] . "</td>
                            <td><a href='update_word.php?rn=$row[word]'>Modify</a></td>
                            <td><a href='delete.php?rn=$row[word]'>Delete</a></td>
                            </tr>";
                        }
                    } else {
                        echo "No results";
                    }
                $conn -> close();
                ?>
            </table>
        </div>
    </body>
</html>