let word = "check";
const wordArray = word.split("");
let wordLength;
let numOfGuesses, currentGuessNumber = 0, guesses = [];


function findLengthGuesses() {
		wordLength = word.length;
		if (wordLength == 3) {
			numOfGuesses = 8;
		} else if (wordLength == 4) {
			numOfGuesses = 10;
		} else {
			numOfGuesses = 12;
		}
}

function buildTables() {
    let guessTableRows = "";
	let animalTableRows = "";
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
        guessTableRows = guessTableRows + '<tr id="guessRow' + (j + 1) + '" >' + cells + "</tr>";
    }
	for(let j = 0; j < numOfGuesses; j++) {
        animalTableRows = animalTableRows + '<tr id="animalRow' + (j + 1) + '" >' + cells + "</tr>";
    }

    document.getElementById("character_table").innerHTML = guessTableRows;
    document.getElementById("animal_table").innerHTML = animalTableRows;
}

// sample of the tag to add a picture in a table cell. The size will have to vary based on
// the number of cells since the cells change sizes.  50px will be good for 8 guesses. We'll probably
// need to go down by 5 or 10 px for 10 and 12 guesses:
// <img src="images/cow.png" alt="Cow" style="width:50px;height:auto;">

function inputGuess() {
	
	if (currentGuessNumber >= numOfGuesses) {
		return;
	}
	
	var currentGuess = document.getElementById("input_box").value;
	
	if (currentGuess.length < wordLength || currentGuess.length > wordLength) {
		return;
	}
	
	
	const currentGuessArray = currentGuess.split("");
	currentGuessNumber++;
	let currentGuessRow = "guessRow" + currentGuessNumber;
	let currentAnimalRow = "animalRow" + currentGuessNumber;
	let guessTableRows = "", animalTableRows = "";
    let tdTagBegin = "", tdTagEnd = "</td>";
    let guessCells = "", animalCells = "";
    let guessTdTag = "", animalTdTag = "";

    if(numOfGuesses == 8) {
        tdTag = "<td style='width:90px;height:70px;font-size:48px'>"
    } else if (numOfGuesses == 10) {
        tdTagBegin = "<td style='width:80px;height:60px;font-size:42px'>"
    } else {
        tdTagBegin = "<td style='width:70px;height:50px;font-size:36px'>"
    }

	for (let i = 0; i < wordLength; i++) {
		guessTdTag = guessTdTag + tdTagBegin + currentGuessArray[i] + tdTagEnd;
	}
	
	for (let i = 0; i < wordLength; i++) {
		let animalImage;
		if (currentGuessArray[i] == wordArray[i]) {
			animalImage = '<img src="images/bull.png" alt="Bull" style="Display:Block;width:45px;height:45px;">';
		} else if (word.includes(currentGuessArray[i])) {
			animalImage = '<img src="images/cow.png" alt="Cow" style="Display:Block;width:45px;height:45px;">';
		} else {
			animalImage = "";
		}
		
		animalTdTag = animalTdTag + tdTagBegin + animalImage + tdTagEnd;
		
	}
	
	document.getElementById(currentGuessRow).innerHTML = guessTdTag;
	document.getElementById(currentAnimalRow).innerHTML = animalTdTag;
}