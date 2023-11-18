<?php include("./includes/functions.php");?>
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
                <input name="title" type="text" id="title" placeholder="title">
                <div class="price">
                    <input name="price" type="number" id="price" placeholder="price">
                    <input name="taxes" type="number" id="taxes" placeholder="taxes">
                    <input name="ads" type="number" id="ads" placeholder="ads">
                    <input name="discount" type="number" id="discount" placeholder="discount">
                    <small id="total"></small>
                </div>
                <input name="count" type="number" placeholder="count" id="count">
                <input name="category" type="text" placeholder="cetegory" id="category">
                <button id="submit" type="submit">create</button>
            </form>
        </div>
        <div class="outputs">
            <div class="searchBlock">
                <input type="text" id="search" placeholder="search">
                <div class="btnSearch">
                    <button id="searchTitle">search by title</button>
                    <button id="searchCategory">search by category</button>
                </div>
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
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <script src="./index.js"></script>
</body>

</html>