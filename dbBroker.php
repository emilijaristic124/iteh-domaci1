<?php
$host = "localhost";
$db = "games";
$username = "root";
$password = "";

//konekcija sa bazom
$connection = new mysqli($host, $username, $password, $db);

if ($connection->connect_errno) {
    exit("Connection with database failed! " . $connection->connect_errno);
}