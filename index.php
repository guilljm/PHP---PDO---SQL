<?php

require_once '_connect.php';


if ((isset($_POST['firstname'])) && (isset($_POST['lastname']))) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $pdo = new PDO(DSN, USER, PASSWORD);
    $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $statement->execute();
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
    <p>La liste de tes amis : </p>
    <ul>
        <?php
        $pdo = new PDO(DSN, USER, PASSWORD);
        $query = "SELECT * FROM friend";
        $statement = $pdo->query($query);
        $friends = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($friends as $friend) {
            echo "<li>" . "firstname = " . $friend['firstname'] . " lastname = " . $friend['lastname'] . "</li>";
        }
        ?>
    </ul>
    <form action="/" method="POST">
        <label name="firstname">Firstname</label>
        <input type="text" id="firstname" name="firstname">
        <label name="lastname">Lastname</label>
        <input type="text" id="lastname" name="lastname">
        <input type="submit" value="Add">
    </form>

</body>

</html>
