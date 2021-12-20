<?php

require "../dbBroker.php";
require "../game.php";

if ($_POST['gameName']!="" && $_POST['gameType']!=""
     && $_POST['gamePrice']!="") {
  Game::editGame($_POST['gameId'], $_POST['gameName'], $_POST['gameType'], $_POST['gamePrice'], $connection);
}
