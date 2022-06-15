let numOfGuesses = 8;
let wordLength = 5;

function buildTables() {
    let tableRows = "";
    let cells = "";
    let tdTag = "";

    if(numOfGuesses == 8) {
        tdTag = "<td style='width:90px;height:70px;font-size:48px'></td>"
    } else if (numOfGuesses == 10) {
        tdTag = "<td style='width:80px;height:60px;font-size:42px'></td>"
    } else {
        tdTag = "<td style='width:70px;height:50px;font-size:36px'></td>"
    }

    for(let i = 0; i < wordLength; i++) {
        cells = cells + tdTag;
    }
    for(let j = 0; j < numOfGuesses; j++) {
        tableRows = tableRows + "<tr>" + cells + "</tr>";
    }

    document.getElementById("character_table").innerHTML = tableRows;
    document.getElementById("animal_table").innerHTML = tableRows;
}

// sample of the tag to add a picture in a table cell. The size will have to vary based on
// the number of cells since the cells change sizes.  50px will be good for 8 guesses. We'll probably
// need to go down by 5 or 10 px for 10 and 12 guesses:
// <img src="images/cow.png" alt="Cow" style="width:50px;height:auto;">