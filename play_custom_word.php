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
            .dropbtn, .modalbtn {
                background-color: white;
                border-style: none;
                cursor: pointer;
            }
            .dropdown-content {
                display: none;
                position: absolute;
                right: 0;
                background-color: #f1f1f1;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }
            .dropdown-content a, p {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }
            .dropdown-content a:hover {background-color: #ddd;}
            .show {display:block;}
        </style>
    </head>

    <header style="background-color:white">
        <div id="logo">
            <a href="https://telugupuzzles.com"><img src="images/logo.png" alt="10000 Icon" style="height:80px;width:auto;"></a>
        </div>
        <div id="game_title">
            <p>Animals</p>
        </div>
        <div id="menu_buttons">
            <div id="add_button">
                <a href="add_custom_word.php"><img src="images/plus_sign.png" alt="Add Icon" style="Display:Block;width:70px;height:70px;"></a>
            </div>
            <div id="help_button">
                <button onclick="showHelpModal()" class="modalbtn">
                    <img src="images/help_icon.png" alt="Help Icon" style="Display:Block;width:70px;height:70px;">
                </button>
            </div>
            <div id="stat_button">
                <button onclick="showStatModal()" class="modalbtn">
                    <img src="images/stat_icon.png" alt="Stat Icon" style="Display:Block;width:70px;height:70px;">
                </button>
            </div>
            <div id="settings_button">
                <button onclick="showSettingsDropdown()" class="dropbtn">
                    <img src="images/settings_icon.png" alt="Settings Icon" style="Display:Block;width:70px;height:70px;">
                </button>
                <div id="settingsDropdown" class="dropdown-content">
                    <p>Access Level: ADMIN</p>
                    <a href="#">Set # of Guesses</a>
                    <a href="#">Set Language</a>
                </div>
            </div>
            <div id="profile_button">
                <button onclick="showProfileDropdown()" class="dropbtn">
                    <img src="images/profile_icon.png" alt="Profile Icon" style="Display:Block;width:70px;height:70px;">
                </button>
                <div id="profileDropdown" class="dropdown-content">
                    <p>Access Level: ADMIN</p>
                    <a href="list_words.php">Word Lists</a>
                    <a href="#">Log Out</a>
                </div>
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
        <div id="game_message">
            
        </div>
        <div id="submission_panel">
            <!-- Form calls Javascript function processGuess when the submit button is clicked. -->
            <form action="" method="post" autocomplete = "off" onsubmit="processGuess();return false;">
                <input id="input_box" type="text" name="input_box">
                <input id="submit_button" type="submit" value="Submit" name="submit">
            </form>
        </div>

        <div id="help_modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Animals!</h2>
                <pre>
Check the info box on the right for the puzzle word language and number of guesses.
The number of boxes in a row on the table indicate the length of the puzzle word.
Enter a guess of the correct length, then press Enter or click the submit button.

The animals displayed indicate how closely the guess word matches the puzzle word.
Animals are displayed in the order of how closely a character matches a character in the puzzle word.
Animals do NOT indicate the match level of the character in that specific location.

Example: A result of bull - bull - cow - mouse - mouse indicates that two characters in the guess word
are in the correct location, one character is in the puzzle word but not in the correct location, and
two characters are not in the puzzle word at all.  But it does not mean the first two characters are
in the correct positon, the third character is in the word but not in the correct position, etc.
                </pre>
                <h3>English:</h3>
                <div><img src="images/bull.png" alt="Bull" style="width:50px;height:50px;vertical-align:middle;">
                    <span>One of the characters is in the word, and in the correct position.</span></div>
                <div><img src="images/cow.png" alt="Cow" style="width:50px;height:50px;vertical-align:middle;">
                    <span>One of the characters is in the word, but in the wrong position.</span></div>
                <div><img src="images/mouse.png" alt="Mouse" style="width:50px;height:50px;vertical-align:middle;">
                    <span>One of the characters is not in the word.</span></div>
                <p></p>
                <h3>Telugu:</h3>
                <div><img src="images/elephant.png" alt="Elephant" style="width:50px;height:50px;vertical-align:middle;">
                    <span>One of the logical characters is in the word, and in the correct position.</span></div>
                <div><img src="images/fish.png" alt="Fish" style="width:50px;height:50px;vertical-align:middle;">
                    <span>One of the logical characters is in the word, but in the wrong position.</span></div>
                <div><img src="images/horse.png" alt="Horse" style="width:50px;height:50px;vertical-align:middle;">
                    <span>One of the base characters is in the word, and in the correct position.</span></div>
                <div><img src="images/frog.png" alt="Frog" style="width:50px;height:50px;vertical-align:middle;">
                    <span>One of the base characters is in the word, but in the wrong position.</span></div>
                <div><img src="images/mouse.png" alt="Mouse" style="width:50px;height:50px;vertical-align:middle;">
                    <span>One of the logical characters is not in the word.</span></div>
            </div>
        </div>

        <div id="stat_modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Coming Soon!</p>
                <p>Statistics page...</p>
                <p><img src="images/frog.png" alt="Frog" style="width:70px;height:70px;vertical-align:middle;"></p>
            </div>
        </div>

<?php
    if (isset($_GET['id'])){
        $conn = mysqli_connect("localhost", "root", "", "ics499_animals");
        $id = $_GET['id'];
        $sql = "SELECT * FROM custom_words
                WHERE id = '$id'";
        $result = $conn->query($sql);
    
        if ($result -> num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $word=$row["word"];
        }//end if
        $conn -> close(); 
    }//end if
    } 
?>

        <script>

            var word = "<?php echo $word; ?>";

            fillWord(word);
            buildTables();

            /* These functions make the dropdown menus and modals appear. They weren't working from the external
            file, so I put them here. */
            function showProfileDropdown() {
                document.getElementById("profileDropdown").classList.toggle("show");
            }

            function showSettingsDropdown() {
                document.getElementById("settingsDropdown").classList.toggle("show");
            }

            function showHelpModal() {
                document.getElementById("help_modal").style.display = "block";
            }

            function showStatModal() {
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