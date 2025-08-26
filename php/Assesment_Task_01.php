<?php 
echo "ASSESSMENT TASK<br>";
echo "1. Write a PHP script to calculate the area and perimeter of a Rectangle, and display the result.<br>";
echo "Hints: The area of a Rectangle = length × width, perimeter = 2 × (length + width)<br>";

$length = 10;
$width = 5;

echo "Initial Lenth is $length and width is $width <br>";
$area = $length * $width;
$perimeter = 2 * ($length + $width);

echo "Rectangle Area: $area <br>";
echo "Rectangle Perimeter: $perimeter <br>";

echo "2. Write a PHP script to calculate the VAT (Value Added Tax) over an amount Hints: VAT = 15% of the amount<br>";

$amount = 1000;
$vat = $amount * 0.15;

echo "Amount: $amount <br>";
echo "VAT (15%): $vat <br>";
echo "Total with VAT: " . ($amount + $vat) . "<br>";

echo "3. Write a PHP script to find whether a given number is odd or even Hints: use IF-ELSE<br>";

$number = 15;
if ($number % 2 == 0) {
    echo "$number is Even <br>";
} else {
    echo "$number is Odd <br>";
}
echo "4. Write a PHP script to find the largest number from three given numbers Hints: use IF-ELSE<br>";
$a = 20; 
$b = 35; 
$c = 15;
echo "The number are $a, $b and $c";
if ($a >= $b && $a >= $c) {
    echo "Largest number is: $a <br>";
} elseif ($b >= $a && $b >= $c) {
    echo "Largest number is: $b <br>";
} else {
    echo "Largest number is: $c <br>";
}
echo "5. Write a PHP script to print all the odd numbers between 10 to 100 Hints: use LOOP & IF-ELSE<br>";
for ($i = 10; $i <= 100; $i++) {
    if ($i % 2 != 0) {
        echo $i . " ";
    }
}
echo "6. Write a PHP script to search an element from an array Hints: use LOOP, IF-ELSE & ARRAY<br>";
$arr = array(10, 20, 30, 40, 50);
$search = 30;
$found = false;

foreach ($arr as $value) {
    if ($value == $search) {
        $found = true;
        break;
    }
}

if ($found) {
    echo "Element $search found in array <br>";
} else {
    echo "Element $search not found in array <br>";
}
echo "7. Print the following shapes Hints: use NESTED LOOP<br>";
$rows = 5; // number of rows

for ($i = 1; $i <= $rows; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }
    echo "<br>";
}

$rows = 3;  // number of rows
$ch = 'A';  // starting alphabet

for ($i = 1; $i <= $rows; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $ch . " ";
        $ch++;  // move to next alphabet
    }
    echo "<br>";
}


$rows = 3; // number of rows

for ($i = $rows; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo $j . " ";
    }
    echo "<br>";
}

?>
