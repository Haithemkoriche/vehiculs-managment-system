<!-- Tableau pour afficher les véhicules -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vms";

// Créer une connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier si la connexion est réussie
if (!$conn) {
    die("La connexion a échoué: " . mysqli_connect_error());
}
echo "Connexion réussie à la base de données";

// Vérifier si l'ID a été transmis via l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Vérifier si le formulaire de suppression a été soumis
    if (isset($_POST['delete'])) {
        // Suppression du véhicule à partir de la base de données
        $result = mysqli_query($conn, "DELETE FROM cars WHERE id=$id");

        // Rediriger l'utilisateur vers la page d'affichage des véhicules
        header("Location: index.php");
        exit();
    }

    // Récupération des données du véhicule à partir de la base de données
    $result = mysqli_query($conn, "SELECT * FROM cars WHERE id=$id");

    // Vérifier si des données ont été trouvées
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $matricule_v = $row['matricule_v'];
        $nom_v = $row['nom_v'];
        $position_v = $row['position_v'];
        $company_v = $row['company_v'];
    } else {
        // Si aucun résultat n'a été trouvé pour l'ID, rediriger l'utilisateur vers la page d'affichage des véhicules
        header("Location: index.php");
        exit();
    }
} else {
    // Si aucun ID n'a été transmis via l'URL, rediriger l'utilisateur vers la page d'affichage des véhicules
    header("Location: index.php");
    exit();
}
?>

<!-- Affichage des détails du véhicule -->
<div class="container mt-5">
    <h1>Détails du véhicule</h1>
    <table class="table">
        <tr>
            <th>Matricule</th>
            <td><?php echo $matricule_v; ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?php echo $nom_v; ?></td>
        </tr>
        <tr>
            <th>Position</th>
            <td><?php echo $position_v; ?></td>
        </tr>
        <tr>
            <th>Compagnie</th>
            <td><?php echo $company_v; ?></td>
        </tr>
    </table>
    <form method="post">
    <a href="editer.php?id=<?php echo $id; ?>" class="btn btn-primary">Editer</a>
        <input type="submit" name="delete" value="Supprimer" class="btn btn-danger">
    </form>
</div>
