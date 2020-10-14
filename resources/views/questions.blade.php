<?php


$question1 = "Welcome to 123 Main Street Bot - I see you are looking to purchase a home.  Are you looking to buy in:";
$question2 = "Are you there?";
$question3 = "Are you looking for a home?";
$question4 = "Are you a first time home owner?";
$question5 = "What ballpark price are you shooting for?";



session_start();
$_SESSION['varname'] = $question1;




?>



<form method="post" action="test.php">
    <input type="hidden" name="varname" value="question1">
    <input type="submit">
</form>


<p> {{$question1}} </p>
<p> {{$question2}} </p>
<p> {{$question3}} </p>
<p> {{$question4}} </p>
<p> {{$question5}} </p>





<p a href=""> Make Live</p>