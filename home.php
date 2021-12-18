<?php
    require "dbBroker.php";
    require "game.php";

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    } elseif (isset($_GET['logout']) && !empty($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }

    $games = Game::getAllGames($connection);

    if (!$games) {
        echo "Nastala je greška pri izvođenju upita<br>";
        die();
    }

    else {
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon1.ico"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/home1.css">
    <title>GameWishlist</title>

</head>

<body>

    <div>
        <h1>Game list</h1> 
    </div>

    <div class="row" style="background-color: rgba(10, 65, 82, 0.0); border: none">
        <div class="col-6 col-md-4"></div>
        <div class="col-6 col-md-4">
            <input id="searchGame" placeholder="Find game" class="form-control"   onkeyup="searchGame()" >
        </div>
        <div class="col-6 col-md-4"> </div>
    </div>

    <div style="margin-top: 10px; background-color:  rgba(10, 65, 82, 0.5); border:none" >
        <table id="gameTable" class="table " style="color: white; background-color: rgba(10, 65, 82, 1);">
            <thead class=" table-dark" style="color: white; background-color: rgb(2, 47, 61);">
            <tr>
                <th scope="col"></th>
                <th scope="col">Game name</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Select game</th>
            </tr>
            </thead>

            <tbody>
                <?php
                    while ($row = $games->fetch_array()) { 
                ?>
                <tr>
                    <td></td>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["type"] ?></td>
                    <td><?php echo $row["price"] ?></td>
                    
                    <td>
                        <label class="custom-radio-btn">
                            <input type="radio" name="checked-donut" value=<?php echo $row["id"] ?>>
                        </label>
                    </td>

                </tr>
                <?php
            }
         } ?>
            </tbody>
        </table>
        <div class="row" style="padding: 10px; background-color: rgba(10, 65, 82, 0)">
            <div class="col-md-4">
        
                <button type="button" class="btn btn-primary"
                    style="color: white; background-color: rgb(13, 101, 128);" data-toggle="modal" data-target="#addGameModal">
                    <i class="bi bi-controller"></i> 
                    Add new game   
                </button>
             </div>
        
            <div class="col-sm-8" style="text-align: right">
                <button id="btnEditGame" class="btn " style="color: white; background-color: rgb(13, 101, 128);"
                    data-toggle="modal" data-target="#editGameModal">
                    <i class="bi bi-pen-fill"></i> 
                    Update game  
                </button>
                
                <button id="btnDeleteGame" class="btn " style="color: white; background-color: rgb(82, 10, 46);">
                    <i class="bi bi-eraser-fill"></i> 
                    Delete
                </button>
            </div>
        </div>
    
        <a href="home.php?logout=true" style="float: right; padding: 15px">
            <button id="logout" type="button" class="btn" style="color: white; background-color: rgb(13, 101, 128);">
                <i class="bi bi-arrow-bar-left"></i>
                Log out
            </button>
        </a>
    </div>

    <!-- Add game modal -->
    <div class="modal fade" id="addGameModal" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content" style="border: 3px solid rgb(2, 47, 61); background-color:rgb(2, 47, 61) ;">
                <div class="modal-header">
                    <h3 style="color: white; text-align:left">Add new game</h3>  
                </div>
                <div class="modal-body">
                    <div class="">
                        <form action="#" method="post" id="addGameForm">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input  type="text" style="border: 1px solid black" name="userId" class="form-control"
                                           placeholder="User ID" value="<?php echo $_SESSION['user_id'] ?>" readonly/> 
                                    </div>
                                    <div class="form-group">
                                        <input  type="text" style="border: 1px solid black" name="gameName" class="form-control"
                                           placeholder="Game name" value=""/> 
                                    </div>
                                    <div class="form-group">
                                        <input type="text" style="border: 1px solid black" name="gameType" class="form-control" placeholder="Game type"
                                           value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" style="border: 1px solid black" name="gamePrice" class="form-control"
                                           placeholder="Game price" value=""/>
                                    </div>
                                </div>
                                <div class="col-4" style="text-align: center">
                                    <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn btn-success "
                                            style="background-color: rgba(10, 65, 82, 1); border: 1px solid black;">
                                             Add game
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-default" 
                                            style="color: white; background-color: rgb(82, 10, 46); border: 1px solid white" 
                                            data-dismiss="modal">Dismiss
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>

<!-- Edit game Modal-->
    <div class="modal fade" id="editGameModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 3px solid rgb(2, 47, 61); background-color:rgb(2, 47, 61) ;">
                <div class="modal-header">
                    <h3 style="color: white; text-align:left">Edit game</h3>   
                </div>
                <div class="modal-body">
                    <div class="">
                        <form action="#" method="post" id="editGameForm">
                    
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input id="id" type="text" style="border: 1px  black" name="gameId" class="form-control"
                                           placeholder="Game ID" value="" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <input id="gameNameId" style="border: 1px solid black" type="text" name="gameName" class="form-control"
                                           placeholder="Game name" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input id="gameTypeId" style="border: 1px solid black" type="text" name="gameType" class="form-control"
                                           placeholder="Game type" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input id="gamePriceId" style="border: 1px solid black" type="number" name="gamePrice" class="form-control"
                                           placeholder="Game price" value=""/>
                                    </div>
                                </div>
                                <div class="col-4" style="text-align: center">
                                    <div class="form-group">
                                        <button id="btnIzmeni" type="submit" class="btn btn-success"
                                            style="background-color: rgba(10, 65, 82, 1); border: 1px solid black;">
                                             Update game
                                        </button>
                                    </div>
                                    <div class= "form-group">
                                        <button type="button" class="btn btn-default" 
                                        style="color: white; background-color: rgb(82, 10, 46); border: 1px solid white" 
                                        data-dismiss="modal">Dismiss
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
  
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="funkcija.js"></script>
    <script>
        function searchGame() {
            var searchInput, modified, searchTable, tr, i, td1, td2,  txtValue1, txtValue2
            searchInput = document.getElementById("searchGame");
            modified = searchInput.value.toLowerCase();
            searchTable = document.getElementById("gameTable");
            row = searchTable.getElementsByTagName("tr");
           
            for (i = 0; i < row.length; i++) {
                col1 = row[i].getElementsByTagName("td")[1];
                console.log("ispisujem col 1");
                console.log(col1);
                col2 = row[i].getElementsByTagName("td")[2];
                console.log("ispisujem col 2");
                console.log(col2);
                if (col1 || col2 ) {
                    val1 = col1.textContent;
                    val2 = col2.textContent;
                    if (val1.toLowerCase().indexOf(modified) > -1 || val2.toLowerCase().indexOf(modified) > -1) {
                        row[i].style.display = "";
                        console.log("naso sam:");
                        console.log(row[i]);
                    } else {
                        row[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>
</html>
