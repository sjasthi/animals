let puzzleWord = "";
let puzzleWordLanguage = "";
let puzzleWordLength;
let customWord = false;
let guessLimit;
let numberOfAttempts = 1;
let animal = "";
let pictureFile = "";
let gameResult = "";
let userRole = "";
const tableData = [];
//let accessLevel = "guest";

/* Function which fills word with input. Used for custom plays
*/
function fillWord(word) {
    puzzleWord = word;
    customWord = true;
}

/* Function to pull puzzleWord. This function uses ajax to call helper_functions.php method
to load the puzzleWord from the database. */
function pullWord() {
    $.ajax({
        async: false,
        url: "lib/helper_functions.php",
        type: "POST",
        data: {method: "getWord"}
    }).done(function(data) {
        puzzleWord = data;
    });
}

function loadGame() {
    // Check for a tableData cookie. The function builds an empty table based on the puzzleWord in the database
    // first because if there is a valid tableData cookie, it should be for the current puzzleWord.
    buildTables();

    if(customWord) {
        let saveData = getCookie("customTableData");
        if(saveData != "") {
            loadSaveData(saveData);     // If cookie exists, call loadSaveData to re-create tables
        }
    } else {
        let saveData = getCookie("tableData");
        if(saveData != "") {
            loadSaveData(saveData);     // If cookie exists, call loadSaveData to re-create tables
        }
    }
}

/* Function to pull puzzleWord details and build UI tables. This function uses ajax to
call methods in helper_functions.php to get puzzleWord details from the database. Then it
uses the guessLimit and puzzleWordLength to build tables of appropriate sizes. */
function buildTables() {
    let tableRows = "";
    let cells = "";
    let tdTag = "";

    $.ajax({
        async: false,
        url: "lib/helper_functions.php",
        type: "POST",
        data: {method: "getlanguage", arg: puzzleWord}
    }).done(function(data) {
        puzzleWordLanguage = data;
    });

    $.ajax({
        async: false,
        url: "lib/helper_functions.php",
        type: "POST",
        data: {method: "getLength", arg1: puzzleWord, arg2: puzzleWordLanguage}
    }).done(function(data) {
        puzzleWordLength = data;
    });

    $.ajax({
        async: false,
        url: "lib/helper_functions.php",
        type: "POST",
        data: {method: "getGuessLimit"}
    }).done(function(data) {
        guessLimit = data;
    });

    if(puzzleWordLanguage == "English") {
        if(guessLimit == 8) {
            tdTag = "<td style='width:100px;height:70px;font-size:48px'></td>"
        } else if (guessLimit == 10) {
            tdTag = "<td style='width:90px;height:60px;font-size:42px'></td>"
        } else {
            tdTag = "<td style='width:80px;height:50px;font-size:36px'></td>"
        }
    } else {
        if(guessLimit == 8) {
            tdTag = "<td style='width:100px;height:70px;font-size:36px'></td>"
        } else if (guessLimit == 10) {
            tdTag = "<td style='width:90px;height:60px;font-size:30px'></td>"
        } else {
            tdTag = "<td style='width:80px;height:50px;font-size:24px'></td>"
        }
    }

    for(let i = 0; i < puzzleWordLength; i++) {
        cells = cells + tdTag;
    }
    for(let j = 0; j < guessLimit; j++) {
        tableRows = tableRows + "<tr>" + cells + "</tr>";
    }

    document.getElementById("character_table").innerHTML = tableRows;
    document.getElementById("animal_table").innerHTML = tableRows;
    document.getElementById("game_message").innerHTML = "<p></p><p>Puzzle Word Language: " + puzzleWordLanguage + 
        "</p><p>You have " + guessLimit + " guesses to solve the puzzle!</p><p>Good luck!</p>"
}

// Restores table data and vital game variables from cookie data when a cookie exists. If the game was unfinished when
// the player left, they will be able to resume play.
function loadSaveData(saveData) {
    let savedTableData = JSON.parse(saveData);
    let wordLength = savedTableData[0].length;
    let numberOfWords = savedTableData.length / 2;
    let wordLanguage;

    // Set numberOfAttempts in case the loaded game is unfinished and the player resumes play.
    numberOfAttempts = (savedTableData.length / 2) + 1;

    // API call to get language of words in table (uses the first character of first word as API param)
    $.ajax({
        async: false,
        url: "lib/helper_functions.php",
        type: "POST",
        data: {method: "getLanguage", arg: savedTableData[0][0]}
    }).done(function(data) {
        wordLanguage = data;
    });

    // These variables are the index of the first array of characters and animal values. The cookie data is
    // an array of arrays: [[chars] [ints] [chars] [ints]]. The first two arrays are for the first table row,
    // the next two are for the second table row, and so on. These vars are incremented by 2 each loop so the
    // correct data is pulled
    let characterIndex = 0;
    let animalIndex = 1;
    
    // Populate tables with character and animal data
    for(var r = 0; r < numberOfWords; r++) {
        for(var c = 0; c < wordLength; c++) {
            selectAnimal(wordLanguage, savedTableData[animalIndex][c]);
            pictureFile = "images/" + animal + ".png";
            document.getElementById("character_table").rows[r].cells[c].innerHTML = savedTableData[characterIndex][c].toUpperCase();
            document.getElementById("animal_table").rows[r].cells[c].innerHTML =
                "<img src=" + pictureFile + " alt=" + animal + ' style="width:40px;height:auto;">';
        }
        characterIndex += 2;
        animalIndex += 2;
    }

    // Change the most recent "result" back to a string (e.g. "1255") so it can be determined if
    // the saved game was a win, loss, or unfinished.
    latestResultString = savedTableData[savedTableData.length - 1][0];
    for (var i = 1; i < wordLength; i++) {
        latestResultString += savedTableData[savedTableData.length - 1][i];
    }

    // Checks first if the last play was a winning play.  If it was not, then it checks if the player ran out
    // of guesses or if there are still guesses remaining to be played.
    if(latestResultString == "11111" || latestResultString == "1111" || latestResultString == "111") {
        gameResult = "win";
        document.getElementById("game_message").innerHTML =
                    "<p></p><p>Congratulations!</p><p>You can now share your complete puzzle on social media.</p><p>Click here to copy the image.</p>";
    } else {
        if(numberOfWords == guessLimit) {
            gameResult = "loss";
            document.getElementById("game_message").innerHTML =
                    "<p></p><p>Sorry! You have run out of guesses...</p><p>The puzzle word was: " + puzzleWord +
                     "</p><p>Click here to share your puzzle on social media.</p>";
        } else {
            gameResult = "";
        }
    }
    // Re-creating the cookie so that prior data and any additional guesses (if possible) will be available if player leaves and returns.
    for(var j = 0; j < savedTableData.length; j++) {
        tableData.push(savedTableData[j]);
    }
    let tableDataString = JSON.stringify(tableData);
    if(customWord) {
        setCookie("customTableData", tableDataString, 1);
    } else {
        let cookieExpiration = generateCookieExpiration();
        setCookie("tableData", tableDataString, cookieExpiration);
    }
}

function logIn() {
    let role = "admin";                  // role will eventually be assigned from an API call.
    setCookie("userRole", role, 1);
    updateMenus();
}

function logOut() {
    let role = "guest";
    setCookie("userRole", role, 1);
    updateMenus();
}

/*
settings_menu_1 -> Access Level: <userRole> (Informational message)
settings_menu_2 -> Set # of Guesses
settings_menu_3 -> Set Language
profile_menu_1 -> Access Level: <userRole> (Informational message)
profile_menu_2 -> Create Custom Word
profile_menu_3 -> Puzzle Word List
profile_menu_4 -> Custom Word List
profile_menu_5 -> Log In/Log Out
*/
function updateMenus() {
    // Check for a userRole cookie
    let role = getCookie("userRole");
    if(role != "") {
        userRole = role;        // If cookie exists, update to appropriate menus
    } else {
        userRole = "guest";     // If no cookie, update to "guest" menus
    }

    // Update menus
    if (userRole == "guest") {
        document.getElementById("settings_menu_1").innerHTML = "Access Level: GUEST";
        document.getElementById("settings_menu_2").setAttribute('href', "#");                       // No access to set guesses
        document.getElementById("settings_menu_3").setAttribute('href', "#");                       // No access to set languages
        document.getElementById("profile_menu_1").innerHTML = "Access Level: GUEST";
        document.getElementById("profile_menu_2").setAttribute('href', "#");                        // No access to create custom word
        document.getElementById("profile_menu_3").setAttribute('href', "#");                        // No access to puzzle word list
        document.getElementById("profile_menu_4").setAttribute('href', "#");                        // No access to custom word list
        document.getElementById("profile_menu_5").innerHTML = "Log In";
        document.getElementById("profile_menu_5").setAttribute('href', "#");                        // Guest will be able to log in
        document.getElementById("profile_menu_5").setAttribute('onclick', "logIn()");
    } else if (userRole == "member") {
        document.getElementById("settings_menu_1").innerHTML = "Access Level: MEMBER";
        document.getElementById("settings_menu_2").setAttribute('href', "#");                       // No access to set guesses
        document.getElementById("settings_menu_3").setAttribute('href', "#");                       // No access to set language
        document.getElementById("profile_menu_1").innerHTML = "Access Level: MEMBER";
        document.getElementById("profile_menu_2").setAttribute('href', "add_custom_word.php");      // Member will have access to create custom word
        document.getElementById("profile_menu_3").setAttribute('href', "#");                        // No access to puzzle word list
        document.getElementById("profile_menu_4").setAttribute('href', "#");                        // Member will have access to custom word list (only that user's words)
        document.getElementById("profile_menu_5").innerHTML = "Log Out";
        document.getElementById("profile_menu_5").setAttribute('href', "#");                        // Member will be able to log out
        document.getElementById("profile_menu_5").setAttribute('onclick', "logOut()");
    } else if (userRole == "admin") {
        document.getElementById("settings_menu_1").innerHTML = "Access Level: ADMIN";
        document.getElementById("settings_menu_2").setAttribute('href', "#");                       // Admin will have access to set guesses
        document.getElementById("settings_menu_3").setAttribute('href', "#");                       // Admin will have access to set language
        document.getElementById("profile_menu_1").innerHTML = "Access Level: ADMIN";
        document.getElementById("profile_menu_2").setAttribute('href', "add_custom_word.php");      // Admin will have access to create custom word
        document.getElementById("profile_menu_3").setAttribute('href', "list_words.php");           // Admin will have access to puzzle word list
        document.getElementById("profile_menu_4").setAttribute('href', "list_custom_words.php");    // Admin will have access to custom world list (all words?)
        document.getElementById("profile_menu_5").innerHTML = "Log Out";
        document.getElementById("profile_menu_5").setAttribute('href', "#");                        // Admin will be able to log out
        document.getElementById("profile_menu_5").setAttribute('onclick', "logOut()"); 
    } else {
        alert("Unable to build menus. No access level data available.");
    }
}

/* Function to process guess words submitted by the player. This function uses ajax 
to call functions in helper_functions.php to get details about the guess word and
compare it to the puzzle word.  It then updates the table with the characters of the
guess word and the appropriate animal pictures.  */
function processGuess() {
    let guessWord;
    let guessWordLanguage;
    let guessWordLength;
    let logicalChars;
    let matchString = "";
    guessWord = document.getElementById("input_box").value.toLowerCase();

    // API call to get language of guess word
    $.ajax({
        async: false,
        url: "lib/helper_functions.php",
        type: "POST",
        data: {method: "getLanguage", arg: guessWord}
    }).done(function(data) {
        guessWordLanguage = data;
    });

    // API call to get length of guess word
    $.ajax({
        async: false,
        url: "lib/helper_functions.php",
        type: "POST",
        data: {method: "getLength", arg1: guessWord, arg2: guessWordLanguage}
    }).done(function(data) {
        guessWordLength = data;
    });

    // Guard clauses to catch guesses of incorrect length or language.
    if(guessWordLanguage == puzzleWordLanguage) {
        if(guessWordLength != puzzleWordLength) {
            alert("The puzzle word has " + puzzleWordLength + " characters.\nPlease enter a guess with " + puzzleWordLength + " characters.");
            document.getElementById("input_box").value = "";
            return;
        }
    } else {
        alert("The puzzle word is a word in " + puzzleWordLanguage + ".\nPlease enter a guess which is a word in " + puzzleWordLanguage + ".");
        document.getElementById("input_box").value = "";
        return;
    }

    // API call to get logical chars of guess word
    $.ajax({
        async: false,
        url: "lib/helper_functions.php",
        type: "POST",
        data: {method: "getLogicalChars", arg1: guessWord, arg2: guessWordLanguage}
    }).done(function(data) {
        logicalChars = JSON.parse(data);
    });

    // API call to check if guess word matches puzzle word
    $.ajax({
        async: false,
        url: "lib/helper_functions.php",
        type: "POST",
        data: {method: "checkMatch", arg1: puzzleWord, arg2: guessWordLanguage, arg3: guessWord}
    }).done(function(data) {
        matchString = data;
    });

    // Code to take the response string from the match API, convert it to an array, sort it, and then
    // rebuild it as a string again so the animals can be loaded in the table in the correct order.
    var arr = matchString.split("");
    var sorted = arr.sort();
    matchString = sorted[0];
    for (var i = 1; i < sorted.length; i++) {
        matchString += sorted[i];
    }

    // These IF/ELSE blocks handle the logical chars and match string integers from the APIs and use them
    // to populate the tables.
    if(numberOfAttempts <= guessLimit && gameResult == "") {
        for(var c = 0; c < puzzleWordLength; c += 1) {
            selectAnimal(guessWordLanguage, matchString.charAt(c));
            pictureFile = "images/" + animal + ".png";
            document.getElementById("character_table").rows[numberOfAttempts - 1].cells[c].innerHTML = logicalChars[c].toUpperCase();
            document.getElementById("animal_table").rows[numberOfAttempts - 1].cells[c].innerHTML =
                "<img src=" + pictureFile + " alt=" + animal + ' style="width:40px;height:auto;">';
        }
        document.getElementById("input_box").value = "";
        if(numberOfAttempts < guessLimit) {
            if(matchString == "11111" || matchString == "1111" || matchString == "111") {
                gameResult = "win";
                document.getElementById("game_message").innerHTML =
                    "<p></p><p>Congratulations!</p><p>You can now share your complete puzzle on social media.</p><p>Click here to copy the image.</p>";
            }
        }
        if (numberOfAttempts == guessLimit) {
            if(matchString == "11111" || matchString == "1111" || matchString == "111") {
                gameResult = "win";
                document.getElementById("game_message").innerHTML =
                    "<p></p><p>Congratulations!</p><p>You can now share your complete puzzle on social media.</p><p>Click here to copy the image.</p>";
            } else {
                gameResult = "loss";
                document.getElementById("game_message").innerHTML =
                    "<p></p><p>Sorry! You have run out of guesses...</p><p>The puzzle word was: " + puzzleWord + 
                    "</p><p>Click here to share your puzzle on social media.</p>";
            }
        }
        // tableData array is used to store the characters for character_table and the integers that are used
        // to determine the animals for animal_table. tableData is stored to a cookie called "tableData" after
        // each guess. This data can be used to "resume" the game if the player navigates away from the page.
        // The cookie code is here so that a guess after the game is over doesn't get added to the cookie in error.
        tableData.push(logicalChars);
        tableData.push(sorted);
        let tableDataString = JSON.stringify(tableData);
        if(customWord) {
            setCookie("customTableData", tableDataString, 1);
        } else {
            let cookieExpiration = generateCookieExpiration();
            setCookie("tableData", tableDataString, cookieExpiration);
        }
        numberOfAttempts++;
    } else {
        gameResult = "The game is over!";
        alert(gameResult);
        document.getElementById("input_box").value = "";
    }
}

/* Function to determine the appropriate animal based on the language and the string of characters from
the match checking API.  It updates the animal variable with the name of the animal so it can be used
to build the image tag for updating the tables. */
function selectAnimal(language, id) {
    switch(id) {
        case "1":
            if(language == "English") {
                animal = "bull";
            } else {
                animal = "elephant";
            }
            break;
        case "2":
            if(language == "English") {
                animal = "cow";
            } else {
                animal = "fish";
            }
            break;
        case "3":
            animal = "horse";
            break;
        case "4":
            animal = "frog";
            break;
        case "5":
            animal = "mouse";
            break;
        default:
            break;
    }
}

function setCookie(cname, cvalue, expiration) {
    let expires = "expires=";
    if (customWord || cname == "userRole") {
        const d = new Date();
        d.setTime(d.getTime() + (expiration * 24 * 60 * 60 * 1000));
        expires = expires + d.toUTCString();
    } else {
        expires = expires + expiration.toUTCString();
    }
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function generateCookieExpiration() {
    let todayDate = new Date();
    let tomorrowDate = new Date();
    let hour = todayDate.getHours();

    // Determine the time of day the game is being played so the correct expiration can be generated.
    // Cookie needs to expire when the next puzzle word's time arrives.
    if(hour >= 8 && hour < 20) {
        // Expiration is 8 PM of the same day
        todayDate.setHours(20, 0, 0);
        return todayDate;
    } else {
        // Expiration is 8 AM of the next day
        tomorrowDate.setDate(todayDate.getDate() + 1);
        tomorrowDate.setHours(8, 0, 0);
        return tomorrowDate;
    }
}