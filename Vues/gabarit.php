<!doctype html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Javapprendre</title>
</head>
<body>
<?php echo $A_vue['body'] ;
if (isset($_GET['url'])) {
    if (($_GET['url'] == 'Utilisateur/inscription') || ($_GET['url'] == 'TableauScore') || ($_GET['url'] == 'Utilisateur/connexion') || ($_GET['url'] == 'Utilisateur/traitementConnexion') || ($_GET['url'] == 'Utilisateur/deconnexion') || ($_GET['url'] == 'Utilisateur/traitementInscription') || ($_GET['url'] == 'Admin/checkAdmin')) {
        return;
    } else {
        Vue::montrer('standard/pied');
    }
} else {
    Vue::montrer('standard/pied');
}
?>
</body>

</html>
