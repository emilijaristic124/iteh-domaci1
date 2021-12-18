<?php

require "../dbBroker.php";
require "../game.php";

if (isset($_POST['gameName']) && isset($_POST['gameType'])
     && isset($_POST['gamePrice'])) {
   Game::editGame($_POST['gameId'], $_POST['gameName'], $_POST['gameType'], $_POST['gamePrice'], $connection);
}
