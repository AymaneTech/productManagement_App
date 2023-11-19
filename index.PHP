<?php include("./includes/functions.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud App with js</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="crud">
        <div class="head">
            <h2>crud</h2>
            <p>product managment system</p>
        </div>
        <div class="inputs">
            <form action="includes/functions.php" method="post">

                <input value="<?php echo isset($_SESSION["data"]) ? $_SESSION["data"]["title"] : ""; ?>" name="title" type="text" id="title" placeholder="title">
                <div class="price">
                    <input onkeyup="getTotal()" value="<?php echo isset($_SESSION["data"]) ? $_SESSION["data"]["price"] : ""; ?>" name="price" type="number" id="price" placeholder="price">
                    <input onkeyup="getTotal()" value="<?php echo isset($_SESSION["data"]) ? $_SESSION["data"]["taxes"] : ""; ?>" name="taxes" type="number" id="taxes" placeholder="taxes">
                    <input onkeyup="getTotal()" value="<?php echo isset($_SESSION["data"]) ? $_SESSION["data"]["ads"] : ""; ?>" name="ads" type="number" id="ads" placeholder="ads">
                    <input onkeyup="getTotal()" value="<?php echo isset($_SESSION["data"]) ? $_SESSION["data"]["discount"] : ""; ?>" name="discount" type="number" id="discount" placeholder="discount">
                    <small id="total"><?php echo isset($_SESSION["data"]) ? $_SESSION["data"]["total"] : ""; ?></small>
                </div>
                <input value="<?php echo isset($_SESSION["data"]) ? $_SESSION["data"]["count"] : ""; ?>" name="count" type="number" placeholder="count" id="count">
                <input value="<?php echo isset($_SESSION["data"]) ? $_SESSION["data"]["category"] : ""; ?>" name="category" type="text" placeholder="cetegory" id="category">

                <button name="<?php echo isset($_SESSION["data"]) ? "update" : "create"; ?>" id="submit" type="submit"><?php echo isset($_SESSION["data"]) ? "update" : "create"; ?></button>
            </form>
        </div>
        <div class="outputs">
            <div class="searchBlock">
                <form action="includes/functions.php" method="post">
                    <input type="text" id="search" placeholder="search" name="valueToSearch">
                    <div class="btnSearch">
                        <button id="searchTitle" name="searchByTitle">search by title</button>
                        <button id="searchCategory" name="searchByCategory">search by category</button>
                    </div>
                </form>
            </div>
            <table>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>price</th>
                    <th>taxes</th>
                    <th>ads</th>
                    <th>discount</th>
                    <th>total</th>
                    <th>category</th>
                    <th>update</th>
                    <th>delete</th>
                </tr>
                <tbody id="tableData">
                    <?php
                    selectProduct($pdo);
                    session_unset();
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <script src="./index.js"></script>
</body>

</html>
