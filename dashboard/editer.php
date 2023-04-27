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

// Vérification si l'ID de l'enregistrement à éditer est spécifié en paramètre d'URL
if(isset($_GET["id"])){
    $id = $_GET["id"];
    
    // Requête SQL pour sélectionner l'enregistrement correspondant à l'ID
    $sql = "SELECT * FROM cars WHERE id=$id";
    $result = $conn->query($sql);

    // Vérification si l'enregistrement existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $matricule_v = $row["matricule_v"];
        $nom_v = $row["nom_v"];
        $position_v = $row["position_v"];
        $company_v = $row["company_v"];
    } else {
        echo "Enregistrement non trouvé";
        exit;
    }
} else {
    echo "ID de l'enregistrement non spécifié";
    exit;
}

// Traitement du formulaire d'édition lorsque l'utilisateur soumet le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricule_v = $_POST["matricule_v"];
    $nom_v = $_POST["nom_v"];
    $position_v = $_POST["position_v"];
    $company_v = $_POST["company_v"];

    // Requête SQL pour mettre à jour l'enregistrement dans la base de données
    $sql = "UPDATE cars SET matricule_v='$matricule_v', nom_v='$nom_v', position_v='$position_v', company_v='$company_v' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Enregistrement mis à jour avec succès";
    } else {
        echo "Erreur lors de la mise à jour de l'enregistrement: " . $conn->error;
    }
}

// Fermeture de la connexion
$conn->close();
?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


<!-- Affichage du formulaire d'édition -->
<form action="" method="post" class="container mt-5 d-lg-flex flex-lg-column align-items-lg-center">
    <label class="form-label" id="matricule">Matricule</label>
    <input type="text" name="matricule_v" id="matricule" class="form-control w-50" value="<?php echo $matricule_v; ?>">
    <label class="form-label" id="nom_v">Nom</label>
    <input type="text" name="nom_v" id="nom_v" class="form-control w-50" value="<?php echo $nom_v; ?>">
    <label class="form-label" id="position">Position</label>
    <input type="text" name="position_v" id="position" class="form-control w-50" value="<?php echo $position_v; ?>">
    <label class="form-label" id="company">Company</label>
    <input type="text" name="company_v" id="company" class="form-control w-50" value="<?php echo $company_v; ?>">
<input type="submit" value="Enregistrer" class="btn btn-primary mt-3">
</form>
