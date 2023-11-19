<?php
include("db.php");


// a general function to check if the server get request method ot type post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["insert"])) {
        insertProduct($pdo);
    }
    if (isset($_POST["update_button"])) {
        $productIdToDelete = $_POST['productId'];
        updateProduct($pdo, $productIdToDelete);
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
                    <button type="submit" name="update_button">Update</button>
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
function updateProduct($pdo, $productIdToDelete)
{
    $updateSql = "SELECT * FROM PRODUCT WHERE id = ?;";
    $updateResult = $pdo->prepare($updateSql);
    $updateResult->execute([$productIdToDelete]);

    $row = $updateResult->fetch(PDO::FETCH_ASSOC);
      ?>
    <form action="" method="post">
        <input type="hidden" name="productId" value="<?= $row["id"] ?>">
        <input type="text" name="title" value="<?= $row["title"] ?>" placeholder="title">
        <!-- Add other input fields with values from $row -->
        <button type="submit" name="update_product">Update Product</button>
    </form>
    <?php





}

// function calculate the total
function Total($post)
{
    return ($_POST["price"] + $_POST["ads"] + $_POST["taxes"] - $_POST["discount"]) * $_POST["count"];
}

?>
