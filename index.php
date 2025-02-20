<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./model/modelUser.php" method="POST">
        <label for="name">Nom:</label>
        <input type="text" name="name" placeholder="Exemple : RAAAVVUUUS">
        <Label for="">Prenom:</Label>
    </form>
    <script>
        fetch('http://localhost/API/utilisateur.php',{method : "POST"})
            .then(response => response.json())
            .then(data => console.log(data))
    </script>
</body>
</html>