<?php
    require 'db_configuration.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Animals</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/animals.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
        <script type="text/javascript" src="js/animals.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <style>
            .dropbtn, .modalbtn {
                background-color: white;
                border-style: none;
                cursor: pointer;
            }
            .dropdown {
                position: relative;
                display: inline-block;
            }
            .dropdown-content {
                display: none;
                position: absolute;
                right: 0px;
                background-color: #f1f1f1;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }
            .dropdown-content a, p {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                white-space: nowrap;
            }
            .dropdown-content a:hover {background-color: #ddd;}
            .dropdown:hover .dropdown-content {display: block;}
            .dropdown:hover .dropbtn {background-color: #ddd;}

            @media only screen and (max-width: 414px) {
                .dropdown-content a, .dropdown-content p {
                    font-size: 12px;
                    padding: 8px 12px;
                }
            }
        </style>
    </head>

    <header style="background-color:white">
        <div id="main_screen_logo">
            <a href="https://telugupuzzles.com"><img class="logo_image" src="images/logo.png" alt="10000 Icon"></a>
        </div>
        <div id="game_title">
            <p>Animals</p>
        </div>
        <div id="menu_buttons">
            <div id="help_button" class="header_button">
                <button onclick="showHelpModal()" class="modalbtn">
                    <img class="menu_button_image" src="images/help_icon.png" alt="Help Icon">
                </button>
            </div>
            <div id="stat_button" class="header_button">
                <button onclick="showStatModal()" class="modalbtn">
                    <img class="menu_button_image" src="images/stat_icon.png" alt="Stat Icon">
                </button>
            </div>
            <div id="profile_button" class="dropdown">
                <button class="dropbtn">
                    <img class="menu_button_image" src="images/profile_icon.png" alt="Profile Icon">
                </button>
                <div id="profile_dropdown" class="dropdown-content">
                    <p id="profile_menu_1">Access Level: GUEST</p>
                    <p id="profile_menu_2" style="color:darkGray">Create Custom Word</p>
                    <p id="profile_menu_3" style="color:darkGray">Puzzle Word List</p>
                    <p id="profile_menu_4" style="color:darkGray">Custom Word List</p>
                    <a id="profile_menu_5" href="login_page.php">Log In</a>
                </div>
            </div>
        </div>
    </header>

    <body onload=updateMenus() style="background-color:darkblue">
        <div id="main_panel">
            <div id="game_message">

            </div>
            <div id="game_panel">
                <div id="table_panel">
                    <table id="character_table"></table>
                    <table id="animal_table"></table>
                </div>
                <div id="submission_panel">
                    <!-- Form calls Javascript function processGuess when the submit button is clicked. -->
                    <form action="" method="post" autocomplete = "off" onsubmit="processGuess();return false;">
                        <input id="input_box" type="text" name="input_box">
                        <input id="submit_button" type="submit" value="Submit" name="submit">
                    </form>
                </div>
            </div>
            <div id="clue_box">
                
            </div>
        </div>

        <div id="help_modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <pre>
Check the info box on the left for the puzzle word language and number of guesses. The number of boxes in a row on the table indicate the length of the puzzle word. Enter a guess of the correct length, then press Enter or click the submit button.

The animals displayed indicate how closely the guess word matches the puzzle word. Animals are displayed in the order of how closely a character matches a character in the puzzle word. Animals do NOT indicate the match level of the character in that specific location.

Example: A result of bull - bull - cow - mouse - mouse indicates that two characters in the guess word are in the correct location, one character is in the puzzle word but not in the correct location, and two characters are not in the puzzle word at all.  But it does not mean the first two characters are in the correct positon, the third character is in the word but not in the correct position, etc.
                </pre>
                <h4>English:</h4>
                <div><img class="help_image" src="images/bull.png" alt="Bull">
                    <span>One of the characters is in the word, and in the correct position.</span></div>
                <div><img class="help_image" src="images/cow.png" alt="Cow">
                    <span>One of the characters is in the word, but in the wrong position.</span></div>
                <div><img class="help_image" src="images/mouse.png" alt="Mouse">
                    <span>One of the characters is not in the word.</span></div>
                <p></p>
                <h4>Telugu:</h4>
                <div><img class="help_image" src="images/elephant.png" alt="Elephant">
                    <span>One of the logical characters is in the word, and in the correct position.</span></div>
                <div><img class="help_image" src="images/fish.png" alt="Fish">
                    <span>One of the logical characters is in the word, but in the wrong position.</span></div>
                <div><img class="help_image" src="images/horse.png" alt="Horse">
                    <span>One of the base characters is in the word, and in the correct position.</span></div>
                <div><img class="help_image" src="images/frog.png" alt="Frog">
                    <span>One of the base characters is in the word, but in the wrong position.</span></div>
                <div><img class="help_image" src="images/mouse.png" alt="Mouse">
                    <span>None of the base or logical characters are in the word.</span></div>
                <p></p>
                <h4>About:</h4>
                <pre>
Animals: Version 2.0
This game was created as part of the ICS-499 course at Metropolitan State University, St. Paul, MN.
Marc Wedo       marc.wedo@gmail.com
Jeremy Olson    olsonjeremy33@yahoo.com
Jace Huddock    jmhuddock09@gmail.com
                </pre>
            </div>
        </div>

        <div id="stat_modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="stat_modal_title"><p>STATISTICS</p></div>
                <div id="stat_values">
                    <div id="games_played" class="stat_value">0</div>
                    <div id="games_won" class="stat_value">0</div>
                    <div id="win_percent" class="stat_value">0</div>
                    <div id="current_streak" class="stat_value">0</div>
                    <div id="max_streak" class="stat_value">0</div>
                </div>
                <div id="stat_labels">
                    <div id="games_played_label" class="stat_label">Played</div>
                    <div id="games_won_label" class="stat_label">Won</div>
                    <div id="win_percent_label" class="stat_label">Win %</div>
                    <div id="current_streak_label" class="stat_label">Current Streak</div>
                    <div id="max_streak_label" class="stat_label">Max Streak</div>
                </div>  
            </div>
        </div>

        <script>
            // Javascript function to take a screenshot of the completed game
            function screenshot(){ 
                if(userRole == "ADMIN" || userRole == "SUPER_ADMIN") {  
                    html2canvas(document.querySelector("#table_panel")).then(canvas => {
                        var myImage = canvas.toDataURL("image/png");
                        var tWindow = window.open("");
                    $(tWindow.document.body)
                        .html("<img id='Image' src=" + myImage + "></img>")
                        .ready(function() {
                        tWindow.focus();
                        //tWindow.print();
                        //document.body.appendChild(canvas)
                        });
                    });
                } else {
                    html2canvas(document.querySelector("#animal_tile_panel")).then(canvas => {
                        var myImage = canvas.toDataURL("image/png");
                        var tWindow = window.open("");
                    $(tWindow.document.body)
                        .html("<img id='Image' src=" + myImage + "></img>")
                        .ready(function() {
                        tWindow.focus();
                        //tWindow.print();
                        //document.body.appendChild(canvas)
                        });
                    });
                }
            }
        </script>

        <script>
            // Javascript function to pull puzzle_word details and build UI tables
            <?php
                if(isset($_GET['id'])) {
                    $conn = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM custom_words
                            WHERE id = '$id'";
                    $result = $conn->query($sql);
                
                    if ($result -> num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $customWord=$row["word"];
                        }
                    $conn -> close(); 
                    }
            ?>
                var word = "<?php echo $customWord; ?>";
                fillCustomWord(word);
            <?php 
                } else {
                    date_default_timezone_set('America/Chicago');
                    $date = date("Y-m-d");
                
                    $conn = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
                    if(date("H") >= 8 && date("H") < 20) {
                        $sql = "SELECT word FROM puzzle_words WHERE date = '$date' AND time = '08:00:00'";
                    } else {
                        $sql = "SELECT word FROM puzzle_words WHERE date = '$date' AND time = '20:00:00'";
                    }
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $puzzleWord = $row["word"];

                    $conn->close();

                    $puzzleWord = $row["word"]; ?>
                    var word = "<?php echo $puzzleWord; ?>";
                    fillPuzzleWord(word);
                    // TEST WORDS OF VARIOUS LENGTHS. To use, comment out previous line, then un-comment the word you want to test with:
                    //fillPuzzleWord("ask");
                    //fillPuzzleWord("test");
                    //fillPuzzleWord("final");
                    //fillPuzzleWord("కలువ");
                    //fillPuzzleWord("గణపతి");
                    //fillPuzzleWord("విశాఖపట్నం");
            <?php 
                } ?>

            loadGame();

            /* These functions make modals appear. They weren't working from the external
            file, so I put them here. */

            function showHelpModal() {
                document.getElementById("help_modal").style.display = "block";
            }

            function showStatModal() {
                loadUserStats();
                document.getElementById("stat_modal").style.display = "block";
            }

            var helpModalSpan = document.getElementsByClassName("close")[0];
            var statModalSpan = document.getElementsByClassName("close")[1];
            var helpModal = document.getElementById("help_modal");
            var statModal = document.getElementById("stat_modal");

            // When the user clicks on <span> (x), close the modal
            helpModalSpan.onclick = function() {
                helpModal.style.display = "none";
            }

            // When the user clicks on <span> (x), close the modal
            statModalSpan.onclick = function() {
                statModal.style.display = "none";
            }
            
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == helpModal) {
                    helpModal.style.display = "none";
                } else if (event.target == statModal) {
                    statModal.style.display = "none";  
                }
            }
        </script>
    </body>
</html>