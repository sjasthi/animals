let puzzleWord = "";
let puzzleWordLanguage = "";
let puzzleWordLength;
let guessLimit;
let numberOfAttempts = 1;
let animal = "";
let pictureFile = "";

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
        data: {method: "getWord"}
    }).done(function(data) {
        puzzleWord = data;
    });

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

    if(guessLimit == 8) {
        tdTag = "<td style='width:90px;height:70px;font-size:48px'></td>"
    } else if (guessLimit == 10) {
        tdTag = "<td style='width:80px;height:60px;font-size:42px'></td>"
    } else {
        tdTag = "<td style='width:70px;height:50px;font-size:36px'></td>"
    }

    for(let i = 0; i < puzzleWordLength; i++) {
        cells = cells + tdTag;
    }
    for(let j = 0; j < guessLimit; j++) {
        tableRows = tableRows + "<tr>" + cells + "</tr>";
    }

    document.getElementById("character_table").innerHTML = tableRows;
    document.getElementById("animal_table").innerHTML = tableRows;
}

/* Function to process guess words submitted by the player. This function uses ajax 
to call functions in helper_functions.php to get details about the guess word and
compare it to the puzzle word.  It then updates the table with the characters of the
guess word and the appropriate animal pictures.  */
function processGuess() {
    let guessWord;
    let guessWordLanguage;
    let logicalChars;
    let matchString = "";
    guessWord = document.getElementById("input_box").value;

    $.ajax({
        async: false,
        url: "lib/helper_functions.php",
        type: "POST",
        data: {method: "getLanguage", arg: guessWord}
    }).done(function(data) {
        guessWordLanguage = data;
    });

    $.ajax({
        async: false,
        url: "lib/helper_functions.php",
        type: "POST",
        data: {method: "getLogicalChars", arg1: guessWord, arg2: guessWordLanguage}
    }).done(function(data) {
        logicalChars = JSON.parse(data);
    });

    $.ajax({
        async: false,
        url: "lib/helper_functions.php",
        type: "POST",
        data: {method: "checkMatch", arg1: puzzleWord, arg2: guessWordLanguage, arg3: guessWord}
    }).done(function(data) {
        matchString = data;
    });

    for(var c = 0; c < puzzleWordLength; c += 1) {
        selectAnimal(guessWordLanguage, matchString.charAt(c));
        pictureFile = "images/" + animal + ".png";
        document.getElementById("character_table").rows[numberOfAttempts - 1].cells[c].innerHTML = logicalChars[c].toUpperCase();
        document.getElementById("animal_table").rows[numberOfAttempts - 1].cells[c].innerHTML =
            "<img src=" + pictureFile + " alt=" + animal + ' style="width:50px;height:auto;">';
    }
    document.getElementById("input_box").value = "";

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

