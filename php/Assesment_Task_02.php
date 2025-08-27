<?php

echo "Task 1: Write a PHP script to calculate the simple interest.";
echo "Hints: Simple Interest = (Principal × Rate × Time) / 100<br>";

$loanAmount = 5000;
$interestRate = 7;
$durationYears = 3;
$totalInterest = ($loanAmount * $interestRate * $durationYears) / 100;
echo "Simple Interest = $totalInterest<br><br>";


echo "Task 2: Write a PHP script to swap two numbers without using a third variable.";

$firstNumber = 25;
$secondNumber = 50;
echo "Before Swap: a = $firstNumber, b = $secondNumber<br>";
$firstNumber = $firstNumber + $secondNumber;
$secondNumber = $firstNumber - $secondNumber;
$firstNumber = $firstNumber - $secondNumber;
echo "After Swap: a = $firstNumber, b = $secondNumber<br><br>";


echo "Task 3: Write a PHP script to check whether a given year is a leap year or not.";
echo "Hints: A year is a leap year if it is divisible by 4, but not divisible by 100, unless it is also divisible by 400.<br>";

$testYear = 2028;
if (($testYear % 4 == 0 && $testYear % 100 != 0) || ($testYear % 400 == 0)) {
    echo "$testYear is a Leap Year<br><br>";
} else {
    echo "$testYear is NOT a Leap Year<br><br>";
}


echo "Task 4: Write a PHP script to find the factorial of a number.";
echo "Hints: Use loop (for/while).<br>";

$inputNumber = 7;
$resultFactorial = 1;
for ($i = 1; $i <= $inputNumber; $i++) {
    $resultFactorial *= $i;
}
echo "Factorial of $inputNumber is $resultFactorial<br><br>";


echo "Task 5: Write a PHP script to print all the prime numbers between 1 to 50.";

echo "Prime numbers between 1 and 50:<br>";
for ($number = 2; $number <= 50; $number++) {
    $is_prime = true;
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0) {
            $is_prime = false;
            break;
        }
    }
    if ($is_prime) {
        echo $number . " ";
    }
}
echo "<br><br>";


echo "Task 6: Write a PHP script to print the following patterns using nested loops:";

echo "<b>Pattern 1:</b><br>";
$patternRows = 4;
for ($i = $patternRows; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}
echo "<br>";


echo "<b>Pattern 2:</b><br>";
$patternRows = 4;
for ($i = 1; $i <= $patternRows; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $j . " ";
    }
    echo "<br>";
}
echo "<br>";


echo "<b>Pattern 3:</b><br>";
$patternRows = 4;
$currentLetter = 'A';
for ($i = 1; $i <= $patternRows; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $currentLetter . " ";
    }
    echo "<br>";
    $currentLetter++;
}
echo "<br>";

?>