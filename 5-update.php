<?php
require_once('headfoot\header.php');
require('connexion.php');

if (isset($_GET['id'])) {
    $chantierID = $_GET['id'];

    if (isset($_POST['submit'])) {
        $nom = $_POST['nom'];
        $ville = $_POST['ville'];
        $paiment = $_POST['paiment'];
        $date = $_POST['date'];

        if ($nom && $ville !== false && $date) {
            try {
                $sql = "UPDATE chantier SET nom = :nom, ville = :ville, date = :date WHERE chantierID = :chantierID";
                $stmt = $connection->prepare($sql);
                $stmt->execute(['nom' => $nom, 'ville' => $ville, 'date' => $date, 'chantierID' => $chantierID]);

                // Supprimer les anciennes associations de paiement pour ce chantier
                $sql = "DELETE FROM administration WHERE chantierID = :chantierID";
                $stmt = $connection->prepare($sql);
                $stmt->execute(['chantierID' => $chantierID]);

                // Ajouter les nouvelles associations de paiement pour ce chantier
                foreach ($paiment as $value) {
                    $sql = "INSERT INTO administration (paimentID, chantierID) VALUES (:value, :chantierID)";
                    $statement = $connection->prepare($sql);
                    $statement->execute(['value' => $value, 'chantierID' => $chantierID]);
                }

                // Rediriger vers une page de succès ou afficher un message de succès
                header('Location: 4-tables.php');
                exit();
            } catch (Exception $e) {
                // Gérer les exceptions, afficher un message d'erreur ou rediriger vers une page d'erreur
                echo "An error occurred: " . $e->getMessage();
                header('Location: erreur.php');
            }
        } else {
            // Gérer les entrées invalides, afficher un message d'erreur ou rediriger vers une page d'erreur
            echo "Invalid inputs";
        }
    }

    // Récupérer les informations du chantier à modifier
    $query = "SELECT * FROM chantier WHERE chantierID = :chantierID";
    $statement = $connection->prepare($query);
    $statement->execute(['chantierID' => $chantierID]);
    $chantier = $statement->fetch(PDO::FETCH_ASSOC);

    // Récupérer les paiements associés à ce chantier
    $query = "SELECT paimentID FROM administration WHERE chantierID = :chantierID";
    $statement = $connection->prepare($query);
    $statement->execute(['chantierID' => $chantierID]);
    $paiements = $statement->fetchAll(PDO::FETCH_COLUMN);

    // Récupérer tous les types de paiement disponibles
    $query = "SELECT * FROM paiment";
    $statement = $connection->prepare($query);
    $statement->execute();
    $typesPaiement = $statement->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Rediriger vers une page d'erreur si l'ID du chantier n'est pas fourni
    header('Location: 1-login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Modifier le Chantier</title>
      <!-- Liens Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="/css/formulaire.css">
</head>

<body>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <?php if ($chantier) { ?>
        <form method="POST">
            <div class="container col-6">
                <div class="card cardcolor">
                    <div class="card-header">
                        Modifier le Chantier
                    </div>
                    <form class="container d-flex justify-content-center card-body" method="post">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="lieu" class="couleur">nom</label>
                                <input type="text" class="form-control" id="lieu" name="nom" value="<?= $chantier['nom'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="ville" class="couleur">Ville</label>
                                <input type="text" name="ville" class="form-control" id="ville" value="<?= $chantier['ville'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="type">Type de paiement :</label>
                                <?php foreach ($typesPaiement as $typePaiement) { ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="paiment[]" value="<?= $typePaiement['paimentID'] ?>" id="flexCheckDefault" <?php if (in_array($typePaiement['paimentID'], $paiements)) echo 'checked'; ?>>
                                        <label class="form-check-label" for="flexCheckDefault"><?= $typePaiement['nom'] ?></label>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="date" class="form-label">Date de début</label>
                                        <input type="date" class="form-control" id="date" name="date" value="<?= $chantier['date'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Enregistrer">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    <?php } else { ?>
        <div>
            Chantier non trouvé.
        </div>
    <?php } ?>
    <br><br><br><br><br>
    <?php require_once('headfoot\footer.php') ?>
</body>

</html>

