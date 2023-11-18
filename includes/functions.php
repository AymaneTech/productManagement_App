<?php
include("db.php");

function Total($post)
{
    return ($_POST["price"] + $_POST["ads"] + $_POST["taxes"] - $_POST["discount"]) * $_POST["count"];
}
function insertProduct($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql = "INSERT INTO product (title, price, taxes, ads, discount, total, category, count) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $totalValue = Total($_POST);

        $result = $pdo->prepare($sql);
        $result->execute([$_POST["title"], $_POST["price"], $_POST["taxes"], $_POST["ads"], $_POST["discount"], $totalValue, $_POST["category"], $_POST["count"]]);
        selectProduct($pdo);
        // header("location: ../index.php");
    }
}
function selectProduct($pdo)
{
    $selectQuery = "SELECT * FROM product;";
    $select = $pdo->prepare($selectQuery);
    $select->execute();

    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
        print_r($row);
    }
}


?>