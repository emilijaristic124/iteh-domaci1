<?php

require "../dbBroker.php";
require "../game.php";

if(isset($_POST['id'])) {
    $game = Game::getGameById($_POST['id'], $connection);
    echo json_encode($game);
}
