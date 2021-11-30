<?php
require "../dbBroker.php";
require "../game.php";

if(isset($_POST['id'])) {
    Game::deleteGameById($_POST['id'], $connection);
}
