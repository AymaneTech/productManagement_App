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
        header("location: ../index.php");
    }
}


?>