<?php
require "../dbBroker.php";
require "../game.php";

if ($_POST['gameName']!= "" && $_POST['gameType']!=""
    && $_POST['gamePrice']!="" ){
    Game::addGame($_POST['gameName'], $_POST['gameType'], $_POST['gamePrice'],$_POST['userId'], $connection);
}

