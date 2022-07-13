let puzzleWord = "";
let puzzleWordLanguage = "";
let puzzleWordLength;
let guessLimit;
let numberOfAttempts = 1;
let animal = "";
let pictureFile = "";
let gameResult = "";
let accessLevel = "guest"

/* Function which fills word with input. Used for custom plays
*/
function fillWord(word) {
    puzzleWord = word;
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

function logInOut() {
    accessLevel = "admin";
    updateMenus();
}

/*
settings_menu_1 -> Access Level: <accessLevel> (Informational message)
settings_menu_2 -> Set # of Guesses
settings_menu_3 -> Set Language
profile_menu_1 -> Access Level: <accessLevel> (Informational message)
profile_menu_2 -> Create Custom Word
profile_menu_3 -> Puzzle Word List
profile_menu_4 -> Custom Word List
profile_menu_5 -> Log In/Log Out
*/
function updateMenus() {
    if (accessLevel == "guest") {
        document.getElementById("settings_menu_1").innerHTML = "Access Level: GUEST";
        document.getElementById("settings_menu_2").setAttribute('href', "#");                   // No access to set guesses
        document.getElementById("settings_menu_3").setAttribute('href', "#");                   // No access to set languages
        document.getElementById("profile_menu_1").innerHTML = "Access Level: GUEST";
        document.getElementById("profile_menu_2").setAttribute('href', "#");                    // No access to create custom word
        document.getElementById("profile_menu_3").setAttribute('href', "#");                    // No access to puzzle word list
        document.getElementById("profile_menu_4").setAttribute('href', "#");                    // No access to custom word list
        document.getElementById("profile_menu_5").innerHTML = "Log In";
        document.getElementById("profile_menu_5").setAttribute('href', "#");                    // Guest will be able to log in
    } else if (accessLevel == "member") {
        document.getElementById("settings_menu_1").innerHTML = "Access Level: MEMBER";
        document.getElementById("settings_menu_2").setAttribute('href', "#");                   // No access to set guesses
        document.getElementById("settings_menu_3").setAttribute('href', "#");                   // No access to set language
        document.getElementById("profile_menu_1").innerHTML = "Access Level: MEMBER";
        document.getElementById("profile_menu_2").setAttribute('href', "add_custom_word.php");  // Member will have access to create custom word
        document.getElementById("profile_menu_3").setAttribute('href', "#");                    // No access to puzzle word list
        document.getElementById("profile_menu_4").setAttribute('href', "#");                    // Member will have access to custom word list (only that user's words)
        document.getElementById("profile_menu_5").innerHTML = "Log Out";
        document.getElementById("profile_menu_5").setAttribute('href', "#");                    // Member will be able to log out
    } else if (accessLevel == "admin") {
        document.getElementById("settings_menu_1").innerHTML = "Access Level: ADMIN";
        document.getElementById("settings_menu_2").setAttribute('href', "#");                   // Admin will have access to set guesses
        document.getElementById("settings_menu_3").setAttribute('href', "#");                   // Admin will have access to set language
        document.getElementById("profile_menu_1").innerHTML = "Access Level: ADMIN";
        document.getElementById("profile_menu_2").setAttribute('href', "add_custom_word.php");  // Admin will have access to create custom word
        document.getElementById("profile_menu_3").setAttribute('href', "list_words.php");       // Admin will have access to puzzle word list
        document.getElementById("profile_menu_4").setAttribute('href', "#");                    // Admin will have access to custom world list (all words?)
        document.getElementById("profile_menu_5").innerHTML = "Log Out";
        document.getElementById("profile_menu_5").setAttribute('href', "#");                    // Admin will be able to log out
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
                    "<p></p><p>Sorry! You have run out of guesses...</p><p>The puzzle word was: " + puzzleWord + "</p><p>New words are available at 8am and 8pm every day!</p>";
            }
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