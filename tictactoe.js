var icon = "0";
var won = "0";

function Reset() {
	icon = "0";
	won = "0";
	document.getElementById("X").style.cursor = "pointer";
	document.getElementById("O").style.cursor = "pointer";
	colorIcon("X", "White");
	colorIcon("O", "White");
	document.getElementById("victory").innerHTML = "";
	var gameBoard = document.getElementsByClassName("cellButton");
	var i;
	for (i = 0; i < gameBoard.length; i++) {
		gameBoard[i].innerHTML = '<div class="cellFont">O</div>';
		gameBoard[i].style.cursor = "pointer";
		gameBoard[i].style.backgroundColor = "White";
	}
}


function initializeIcon(pick) {
	if (icon == "0") {
		icon = pick;
		document.getElementById("X").style.cursor = "default";
		document.getElementById("O").style.cursor = "default";
		colorIcon(icon, "LightGreen");
	}
}

function Mark(cell) {
	if (icon == "0") {
		alert("You didn't pick a marker!");
	}
	else if (won == "0") {
		var box = document.getElementById(cell);
		if (box.innerHTML == '<div class="cellFont">O</div>') {
			box.innerHTML = icon;
			box.style.cursor = "default";
			Evaluate();
			if (won == "0") {
				switchIcons();
			}		
		}
	}
}

function Evaluate() {
	var gameBoard = document.getElementsByClassName("cellButton");
	var i;
	var xArray = [];
	var oArray = [];
	for (i = 0; i < gameBoard.length; i++) {
		var numberOfIcons;
		if (gameBoard[i].innerHTML == "X") {
			numberOfIcons = xArray.push(gameBoard[i].value);
			if (numberOfIcons >= 3) {
				checkIfWon(xArray, "X");
			}
		}
		else if (gameBoard[i].innerHTML == "O") {
			numberOfIcons = oArray.push(gameBoard[i].value);
			if (numberOfIcons >= 3) {
				checkIfWon(oArray, "O");
			}
		}
	}
	//alert("Xs:" + xArray + "\nOs:" + oArray);
}

function checkIfWon(iconArray, marker) {
	var i;
	var winningSolutionsCheck = [ [1,2,3], [1,4,7], [1,5,9], [2,5,8], [3,6,9], [3,5,7], [4,5,6], [7,8,9] ];
	var winningSolutions = [ [1,2,3], [1,4,7], [1,5,9], [2,5,8], [3,6,9], [3,5,7], [4,5,6], [7,8,9] ];
	for (i = 0; i < iconArray.length; i++) { 
		for (var j = 0; j < winningSolutionsCheck.length; j++) {
			if (winningSolutionsCheck[j][0] == iconArray[i]) {
				winningSolutionsCheck[j].shift();
			}
			if (winningSolutionsCheck[j].length == 0) {
				won = "1";
				var victoryProclamation = document.getElementById("victory");
				victoryProclamation.innerHTML = "Victory! The " + marker + "'s have it!" 
				alert("Victory! The " + marker + "'s have it!");
				for (var k = 0; k < winningSolutions[j].length; k++) {
					document.getElementById(winningSolutions[j][k]).style.backgroundColor = "Red";
				}
			}
		}
	}
}


function switchIcons() {
	colorIcon(icon, "White");
	if (icon == "X") {
		icon = "O";		
	}
	else if (icon == "O") {		
		icon = "X";		
	}
	colorIcon(icon, "LightGreen");
}

function colorIcon(box, color){
	var x = document.getElementById(box.concat("Icon"));
	x.style.backgroundColor = color;
}

