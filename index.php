<?php
include("inc/quiz.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Math Quiz: Addition</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div id="quiz-box">
            <?php
            if ($playGame == true) {
            ?>
                <p class="toast"><?php echo  $toast ?></p>
                <p class="breadcrumbs">Question <?php echo $currentQuestion +1; ?> of <?php echo $totalQuestions ?> </p>
                <p class="quiz">What is <?php echo $_SESSION["questions"][$currentQuestion]["leftAdder"] ?> + 
                    <?php echo    $_SESSION["questions"][$currentQuestion]["rightAdder"] ?>?</p>
                <form action="index.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $currentQuestion; ?>"/>
                    <input type="submit" class="btn" name="answer1" value="<?php echo $_SESSION["questions"][$currentQuestion]["answer1"] ?>" />
                    <input type="submit" class="btn" name="answer2" value="<?php echo $_SESSION["questions"][$currentQuestion]["answer2"] ?>" />
                    <input type="submit" class="btn" name="answer3" value="<?php echo $_SESSION["questions"][$currentQuestion]["answer3"] ?>" />
                </form> 
            <?php
           } else {
           ?>
                <form action="index.php" method="post">
                    <p class="toast">Congratulations! You had <?php echo $_SESSION["score"] ?>  out of <?php echo $totalQuestions ?> questions correct!</p>
                    <input type="hidden" name="id" value="<?php echo $currentQuestion; ?>"/>
                    <input type="submit" class="btn" id="playagain" name="playagain" value="Play Again?" />
                    
                </form>            
           <?php 
           } 
           ?> 
        </div>
    </div>
</body>
</html>