<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vms";
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    // Récupération des données du formulaire
    $matricule = $_POST['matricule_v'];
    $position = $_POST['position'];
    $nom = $_POST['nom_v'];
    $company = $_POST['company'];
    
    // Requête SQL d'insertion des données dans la table
    $sql = "INSERT INTO cars (matricule_v, position_v, nom_v, company_v) VALUES ('$matricule', '$position', '$nom', '$company')";
    
    // Exécution de la requête
    if ($conn->query($sql) === TRUE) {
        echo "Données enregistrées avec succès";
    } else {
        echo "Erreur lors de l'enregistrement des données: " . $conn->error;
    }
}
    
    // Fermeture de la connexion
$conn->close();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="display-5 text-center">Ajouter vehicle</div>
        <form action="" method="post">
            <div class="container mt-5 d-lg-flex flex-lg-column align-items-lg-center" >
            <label class="form-label " id="matricule">matricule</label>
            <input type="text" name="matricule_v" id="matricule" class="form-control w-50">
            <label class="form-label" id="nom_v">nom_v</label>
            <input type="text" name="nom_v" id="nom_v" class="form-control w-50">
            <label class="form-label" id="position">position</label>
            <input type="text" name="position" id="position" class="form-control w-50">
            <label class="form-label" id="company">company</label>
            <input type="text" name="company" id="company" class="form-control w-50">
            <input type="submit" value="ajouter" class="btn btn-primary mt-3 ">
        </form>     
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html> 