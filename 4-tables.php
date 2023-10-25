<?php 
include_once 'headfoot\header.php';
require 'connexion.php';
?>
</head>
<body>
<br><br><br><br><br>
    <div class="container">
        <div class="card">
            <div class="card-header container">
                <div class="row">
                    <h3 class="col">Chantier Informations</h3>
                    <a href="3-formulaire.php" payment="button" class="btn btn-secondary col-2 ajouter_btn">Ajouter un chantier</a>
                </div>
            </div>
            <div class="card-body container">
    <div class="row">
        <table class="table table-bordered table-striped" id="table_data">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>nom</th>
                    <th>Ville</th>
                    <th>Paiement</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT chantier.chantierID, chantier.nom, chantier.ville, chantier.date, paiment.nom as nompaiment, GROUP_CONCAT(paiment.nom SEPARATOR '<br>') AS paiements
                    FROM chantier
                    LEFT JOIN administration ON chantier.chantierID = administration.chantierID
                    LEFT JOIN paiment ON administration.paimentID = paiment.paimentID
                    GROUP BY chantier.chantierID, chantier.nom, chantier.ville, chantier.date";
                $statement = $connection->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                if ($result) {
                    foreach ($result as $row) {
                ?>
                        <tr>
                            <td><?= $row['chantierID'] ?></td>
                            <td><?= $row['nom'] ?></td>
                            <td><?= $row['ville'] ?></td>
                            <td><?= $row['paiements'] ?></td>
                            <td><?= $row['date'] ?></td>
                            <td>
                                <a href="5-update.php?id=<?= $row['chantierID']; ?>" class="btn btn-primary">Edit</a>
                                <a href="8-pdf.php?id=<?= $row['chantierID']; ?>" class="btn btn-primary">Facteur</a>
                                <a href="6-statistiques.php?id=<?= $row['chantierID']; ?>" class="btn btn-primary">Statistique</a>
                                <a href="delete.php?id=<?= $row['chantierID']; ?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="6">Aucun chantier trouvé.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
</body>
<br><br><br><br><br>
<br><br><br><br><br>
<br><br><br><br><br>
<?php 
include_once 'headfoot\footer.php';
?>