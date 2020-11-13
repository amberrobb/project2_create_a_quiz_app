<?php
include("generate_questions.php");
session_start();


####################################################
#  PHP Techdegree Project 2: Build a Quiz App in PHP
####################################################


# due to data persistence we have to use the questions in a session-variable
# otherwise it will generate a new set of questions with every new submit
# that took me a while to figure out
if(!isset($_SESSION["questions"])) {

	$_SESSION["questions"] = generateRandomQuestion();

}


# set up all needed game parameters
if(!isset($_SESSION["score"])) {

	$_SESSION["score"] = 0;
}

$playGame = true;
$toast = null;
$totalQuestions = count($_SESSION["questions"]);
$currentQuestion = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

if(empty($currentQuestion)) {
	
	$currentQuestion = 0;

}


########################################
# player clicked answer-button 1
########################################
if (isset($_POST['answer1'])) {
	$_SESSION["answer1"] = filter_input(INPUT_POST, "answer1", FILTER_SANITIZE_STRING);


	if($_SESSION["answer1"] == $_SESSION["questions"][$currentQuestion]["correctAnswer"]) {

		$toast = "Correct!";
		$_SESSION["score"]++;

	} else {

		$toast = "Wrong!";
	}

	if($currentQuestion == $totalQuestions -1) {

		#finish game and show result
		$playGame = false;

	}

	$currentQuestion++;
	
########################################
# player clicked answer-button 2
########################################
} elseif (isset($_POST['answer2'])) {
	$_SESSION["answer2"] = filter_input(INPUT_POST, "answer2", FILTER_SANITIZE_STRING);
	
	if($_SESSION["answer2"] == $_SESSION["questions"][$currentQuestion]["correctAnswer"]) {

		$toast = "Correct!";
		$_SESSION["score"]++;

	} else {

		$toast = "Wrong!";
	}

	if($currentQuestion == $totalQuestions -1) {

		#finish game and show result
		$playGame = false;

	}

	$currentQuestion++;

########################################
# player clicked answer-button 3
########################################
} elseif (isset($_POST['answer3'])) {
	$_SESSION["answer3"] = filter_input(INPUT_POST, "answer3", FILTER_SANITIZE_STRING);
	
	if($_SESSION["answer3"] == $_SESSION["questions"][$currentQuestion]["correctAnswer"]) {

		$toast = "Correct!";
		$_SESSION["score"]++;

	} else {

		$toast = "Wrong!";
	}

	if($currentQuestion == $totalQuestions -1) {

		#finish game and show result
		$playGame = false;

	}

	$currentQuestion++;
}

###################################
# Play-Again-Button was pressed
# delete session and reset the game
###################################
if (isset($_POST["playagain"])) {

	session_destroy();
	$playGame = true;
	$currentQuestion = 0;
}