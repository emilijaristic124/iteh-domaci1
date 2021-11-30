<?php
class Game
{
    public $id;
    public $name;
    public $type;
    public $price;
    
    public function __construct($id = null, $name = null, $type = null, $price = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        
    }

    public static function getAllGames(mysqli $connection)
    {
        $q = "SELECT * FROM game";
        return $connection->query($q);
    }

    public static function getGameById($id, mysqli $connection)
    {
        $q = "SELECT * FROM game WHERE id=$id";
        $myArray = array();
        if ($result = $connection->query($q)) {

            while ($row = $result->fetch_array(1)) {
                $myArray[] = $row;
            }
        }
        return $myArray;
    }

    public static function deleteGameById($id, mysqli $connection)
    {
        $q = "DELETE FROM game WHERE id=$id";
        return $connection->query($q);
    }

    public static function addGame($name, $type, $price, mysqli $connection)
    {
        $q = "INSERT INTO game(name,type,price) values('$name','$type', '$price')";
        return $connection->query($q);
    }

    public static function editGame($id, $name, $type, $price, mysqli $connection)
    {
        $q = "UPDATE game set name='$name', type='$type', price='$price' where id=$id";
        return $connection->query($q);
    }
}