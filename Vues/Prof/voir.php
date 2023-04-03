<!DOCTYPE html>
<html>
<head>
    <title>Inscription professeur</title>
</head>
<body>
<h1>Inscription professeur</h1>
<form action="index.php?url=Prof/register" method="post">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" required><br>
    <label for="profession">Profession :</label>
    <input type="text" name="profession" required><br>
    <label for="email">Email :</label>
    <input type="email" name="email" required><br>
    <input type="submit" value="S'inscrire">
</form>
</body>
</html>
