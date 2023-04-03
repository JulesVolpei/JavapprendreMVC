<!DOCTYPE html>
<html>
<head>
    <title>Confirmation d'inscription</title>
    <script>
        setTimeout(function() {
            document.getElementById('tokenDisplay').style.display = 'none';
        }, 15000);
    </script>
</head>
<body>
<h1>Confirmation d'inscription</h1>
<p id="tokenDisplay">Votre token de confirmation est : <?php echo $A_vue['token']; ?></p>
<form action="index.php?url=Prof/confirm" method="post">
    <label for="token">Entrez le token :</label>
    <input type="text" name="token" required><br>
    <input type="submit" value="Confirmer">
</form>
</body>
</html>
