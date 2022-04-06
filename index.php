<?php
require_once './connect.php';
$pdo = new \PDO(DSN, USER, PASS);

if (!empty($_POST)) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);

    $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
    $statement = $pdo->prepare($query);

    $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
    $statement->execute();
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Le formulaire des "amis"</h1>
    <ul>
        <?php 
        $query = "SELECT * FROM friend";
        $statement = $pdo->query($query);
        $friends = $statement->fetchAll();
        foreach ($friends as $friend) : ?>
            <li> <?= $friend["firstname"] ?>
                <?= $friend["lastname"] ?></li>
        <?php
        endforeach; ?>
    </ul>

    <form action="" method="post">
        <div>
            <label for="firstname">Prénom: </label>
            <input type="text" id="firstname" name="firstname">
        </div><br>

        <div>
            <label for="lastname">Nom :</label>
            <input type="text" id="lastname" name="lastname">
        </div>
        <button type="submit">Submit</button>
    </form>

</body>

</html>