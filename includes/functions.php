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
insertProduct($pdo);
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
        <td><button>update</button></td>
        <td><button>Delete</button></td>
    </tr>
    <?php
    }
}


?>
