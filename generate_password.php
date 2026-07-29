<?php

$passwords = [
    "admin123",
    "myles123",
    "calorine123",
    "shija123",
    "sabr123",
    "nesta123",
    "richard123",
    "sarah123"
];


foreach($passwords as $password)
{

    echo $password . " = ";

    echo password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    echo "<br><br>";

}