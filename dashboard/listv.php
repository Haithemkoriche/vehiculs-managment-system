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

// Suppression d'un enregistrement si l'ID est spécifié en paramètre d'URL
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "DELETE FROM cars WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Enregistrement supprimé avec succès";
    } else {
        echo "Erreur lors de la suppression de l'enregistrement: " . $conn->error;
    }
}

// Requête SQL pour sélectionner tous les enregistrements de la table "cars"
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

// Affichage du tableau avec les enregistrements
if ($result->num_rows > 0) {
    echo "<div class='container mt-5 mb-5'><h3 class='text-center mb-5'>liste des vehicules</h3><table class='table table-striped '><thead><tr><th>Matricule</th><th>Position</th><th>Nom</th><th>Company</th><th>Actions</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["matricule_v"]."</td><td>".$row["position_v"]."</td><td>".$row["nom_v"]."</td><td>".$row["company_v"]."</td>";
        echo "<td><a href='afficher.php?id=".$row["id"]."' class='btn btn-info'>Afficher</a> <a href='editer.php?id=".$row["id"]."' class='btn btn-primary'>Editer</a> <a href='?id=".$row["id"]."' class='btn btn-danger' onClick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')\">Supprimer</a></td></tr>";
    }
    echo "</tbody></table></div>";
} else {
    echo "Aucun enregistrement trouvé";
}

// Fermeture de la connexion
$conn->close();
?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
 