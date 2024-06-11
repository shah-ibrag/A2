<?php

/*******w******** 
    
    Name: Shawn Ibragimov
    Date: 27-05-2024
    Description: Assignment 2

****************/



// Get current year
$year = 2024;
$porvinces = array('AB', 'BC', 'MB', 'NB', 'NL', 'NS', 'ON', 'PE', 'QC', 'SK'); // Provinces abbreviations
$postalRegex = '/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/'; // postal code regex

// Defining variables from the global $_POST by using the filter_input function
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); // built-in filter for email
$postalCode = filter_input(INPUT_POST, 'postal', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$postalRegex))); // passing $postalRegex to the filter
$creditCardNumber = filter_input(INPUT_POST, 'cardnumber', FILTER_VALIDATE_INT);
$creditCardMonth = filter_input(INPUT_POST, 'month', FILTER_VALIDATE_INT);
$creditCardYear = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
$creditCardType = filter_input(INPUT_POST, 'cardtype');
$fullName = filter_input(INPUT_POST, 'fullname');
$cardName = filter_input(INPUT_POST, 'cardname');
$address = filter_input(INPUT_POST, 'address');
$city = filter_input(INPUT_POST, 'city');
$province = filter_input(INPUT_POST, 'province');
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

// Validate form data
if (!$email) {
    echo "Invalid email address";
} elseif (!$postalCode) {
    echo "Invalid postal code";
} elseif (!$creditCardNumber || strlen($creditCardNumber) != 10) {
    echo "Invalid credit card number. It must be an integer and 10 digits";
} elseif (!$creditCardMonth || $creditCardMonth < 1 || $creditCardMonth > 12) {
    echo "Invalid credit card month. It must be an integer from 1 to 12";
} elseif (!$creditCardYear || $creditCardYear < $year || $creditCardYear > $year + 5) {
    echo "Invalid credit card year. It must be an integer with a minimum value of the current year and a maximum value of current year + 5";
} elseif (!$creditCardType) {
    echo "Credit card type must have at least one selection";
} elseif (!$fullName || !$cardName || !$address || !$city) {
    echo "One of the next fields are empty full name, card name, address and city cannot be empty";
} elseif (!in_array($province, $porvinces)) { // if given province is in the provinces array
    echo "Invalid province. It must be one of the two digit abbreviations from the form’s select options";
} elseif (!$quantity) {
    echo "Invalid quantity. All quantities must be integers";
} else {
    echo "Form data is valid";
}

function receipt($email, $postalCode, $creditCardNumber, $creditCardMonth, $creditCardYear, $creditCardType, $fullName, $cardName, $address, $city, $province, $quantity) {
    $receipt = "
    <h1>Receipt</h1>
    <table>
        <tr>
            <th>Email</th>
            <td>$email</td>
        </tr>
        <tr>
            <th>Postal Code</th>
            <td>$postalCode</td>
        </tr>
        <tr>
            <th>Credit Card Number</th>
            <td>$creditCardNumber</td>
        </tr>
        <tr>
            <th>Credit Card Expiry</th>
            <td>$creditCardMonth/$creditCardYear</td>
        </tr>
        <tr>
            <th>Credit Card Type</th>
            <td>$creditCardType</td>
        </tr>
        <tr>
            <th>Full Name</th>
            <td>$fullName</td>
        </tr>
        <tr>
            <th>Card Name</th>
            <td>$cardName</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>$address</td>
        </tr>
        <tr>
            <th>City</th>
            <td>$city</td>
        </tr>
        <tr>
            <th>Province</th>
            <td>$province</td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>$quantity</td>
        </tr>
    </table>
    ";
    return $receipt;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Thanks for your order!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <?php
        echo receipt($email, $postalCode, $creditCardNumber, $creditCardMonth, $creditCardYear, $creditCardType, $fullName, $cardName, $address, $city, $province, $quantity);
    ?>
</body>
</html>