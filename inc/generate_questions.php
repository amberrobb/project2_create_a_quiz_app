<?php


##########################################################################################
# Generate 10 random questions and make sure they are unique and have plausible wrong answers
###########################################################################################
function generateRandomQuestion() {

	for ($x = 0; $x < 10; $x++) {
		$leftAdder = rand(1,100);
		$rightAdder = rand(1,100);
		$correctAnswer = $rightAdder + $leftAdder;
		$firstIncorrectAnswer = plausibleWrongAnswers($correctAnswer);
    $secondIncorrectAnswer = plausibleWrongAnswers($correctAnswer);

    # check for duplicate wrong answers
		if($firstIncorrectAnswer == $secondIncorrectAnswer) {
			# we found two of the same wrong choices -> generate a new set of questions
			generateRandomQuestion();
		}

		# choices-array holds all three answers and will be shuffled randomly 
		$choices = [
			$correctAnswer,
			$firstIncorrectAnswer,
			$secondIncorrectAnswer
		];

		shuffle($choices);

		# fill the questions-array accordingly
		$questions[] =
    [
        "leftAdder" => $leftAdder,
        "rightAdder" => $rightAdder,
        "correctAnswer" => $correctAnswer,
        "answer1" => $choices[0],
        "answer2" => $choices[1],
        "answer3" => $choices[2]
    ];
	}

	# check for duplicate questions
	$validatedQuestions = checkForDuplicates($questions);

	return $validatedQuestions;	
}


#######################################################
# generate plausible answers for the wrong choices
#######################################################
function plausibleWrongAnswers($correctAnswer) {

		# subtract or add a random number between 1 and 10
		if(rand(0,1)) {
			$dummyResult = $correctAnswer + rand(1,10);
			#echo "<script>console.log('true');</script>";
		} else {
			$dummyResult = $correctAnswer - rand(1,10);
			#echo "<script>console.log('wrong');</script>";
		}


	return $dummyResult;
}

############################################################
# compare all left and right adders and check for duplicates
############################################################
function checkForDuplicates($questions) {
	# copy questions string for comparison
	$testArray = $questions;

	# iterate through $questions array
	for ($x = 0; $x < count($questions); $x++) {

		# iterate through $testarray
		for ($y = 0; $y < count($questions); $y++) {

			# compare both arrays and look for leftAdder and rightAdder duplicates 
			if($questions[$x]['leftAdder'] == $testArray[$y]['leftAdder'] && $questions[$x]['rightAdder'] == $testArray[$y]['rightAdder']) {

				if ($x != $y) {
					#we found a duplicate numbers pair -> generate a new set of questions
					generateRandomQuestion();
				}
				
			}
		}

	}

	return $questions;
}