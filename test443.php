<?php

$PhoneNumber = "0205035737";
$CountryCode = "+1";

// Replace the first '0' with an empty string
$NewNumber = preg_replace('/0/', '', $PhoneNumber, 1);

$FormattedPhoneNumber = $CountryCode . $NewNumber;

echo $FormattedPhoneNumber;

?>
