<?php
include("db.php");

session_start();

// a general function to check if the server get request method ot type post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["insert"])) {
        insertProduct($pdo);
    }
    if (isset($_POST["delete_button"])){
        $productIdToDelete = $_POST['productId'];
        deleteProduct($pdo, $productIdToDelete);
    }
    if(isset($_POST["searchByTitle"])){
        $titleToSearch = $_POST["valueToSearch"];
        searchBytTitle($pdo, $titleToSearch);
    }
    if(isset($_POST["searchByCategory"])){
        $categoryToSearch = $_POST["valueToSearch"];
        searchBytCategory($pdo, $categoryToSearch);
    }
}elseif($_SERVER['REQUEST_METHOD'] == "GET" ){

    if (isset($_GET["id"])) {
        $productIdToUpdate = intval($_GET['id']);
        updateProduct($pdo, $productIdToUpdate);
    }
}



// function of insert the data in database;
function insertProduct($pdo)
{
    $sql = "INSERT INTO product (title, price, taxes, ads, discount, total, category, count) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $totalValue = Total($_POST);

    $result = $pdo->prepare($sql);
    $result->execute([$_POST["title"], $_POST["price"], $_POST["taxes"], $_POST["ads"], $_POST["discount"], $totalValue, $_POST["category"], $_POST["count"]]);
    header("location: ../index.php");
}

// and this one is for select and display database;
function selectProduct($pdo)
{
    $selectQuery = "SELECT * FROM product;";
    $select = $pdo->prepare($selectQuery);
    $select->execute();

    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
            <td><?=$row["id"]?></td>
            <td><?=$row["title"]?></td>
            <td><?=$row["price"]?></td>
            <td><?= $row["taxes"]?></td>
            <td><?= $row["ads"]?></td>
            <td><?= $row["discount"]?></td>
            <td><?= $row["total"]?></td>
            <td><?= $row["category"]?></td>

            <form action="" method="post">
                <input type="hidden" name="productId" value="<?=$row["id"]?>">
                <td>
                    <a href="http://localhost/crudPhp/index.php?id=<?= $row["id"] ?>">Update</a>
                </td>
                <td>
                    <button type="submit" name="delete_button">Delete</button>
                </td>
            </form>
        </tr>
    <?php
    }
}

// and this one is for updating a specific product
function updateProduct($pdo, $productIdToUpdate)
{

    $updateSql = "SELECT * FROM PRODUCT WHERE id = ?;";
    $updateResult = $pdo->prepare($updateSql);
    $updateResult->execute([$productIdToUpdate]);

    $Getrow = $updateResult->fetch(PDO::FETCH_ASSOC);
    $id = $Getrow["id"];

    $_SESSION["data"] = $Getrow;

    session_write_close();
    header("Location: http://localhost/crudPhp/index.php");

   exit();
}

// delete product function
function deleteProduct($pdo, $productIdToDelete){
    $deleteQuery = " delete from product where id = ?;";
    $deleteResult = $pdo->prepare($deleteQuery);
    $deleteResult->execute([$productIdToDelete]);
}

//function to search by title
function searchBytTitle($pdo, $titleToSearch){
    $searchQuery = "SELECT * FROM product where title = ?";
    $searhResult = $pdo->prepare($searchQuery);
    $searhResult->execute([$titleToSearch]);


    $row = $searhResult->fetch(PDO::FETCH_ASSOC);
    header("Location: ../index.php?$row");
}
function searchBytCategory($pdo, $categoryToSearch){
    $searchQuery = "SELECT * FROM product where title = ?";
    $searhResult = $pdo->prepare($searchQuery);
    $searhResult->execute([$categoryToSearch ]);


    $row = $searhResult->fetch(PDO::FETCH_ASSOC);
    header("Location: ../index.php?$row");
}




// function calculate the total

function Total($post)
{
    $price = floatval($post["price"]);
    $ads = floatval($post["ads"]);
    $taxes = floatval($post["taxes"]);
    $discount = floatval($post["discount"]);
    $count = intval($post["count"]);

    return ($price + $ads + $taxes - $discount) * $count;
}
?>
