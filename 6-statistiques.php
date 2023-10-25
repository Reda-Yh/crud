<?php
    require_once('headfoot\header.php')
    ?>
    <br><br><br><br><br>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">
<?php
include_once('connexion.php');
// récupérer les statistiques de paiement à partir de la base de données
$sql = "SELECT paimentID, COUNT(*) AS total FROM administration GROUP BY paimentID";
$stmt = $connection->prepare($sql);
$stmt->execute();
$stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

// tableau HTML pour afficher les statistiques
echo '<table>';
echo '<tr><th>Type de paiement</th><th>Nombre de fois cochés</th></tr>';
foreach ($stats as $stat) {
    $paimentID = $stat['paimentID'];
    $total = $stat['total'];
    $label = '';
    switch ($paimentID) {
        case 1:
            $label = 'Cheque';
            break;
        case 2:
            $label = 'Espece';
            break;
        case 3:
            $label = 'Enligne';
            break;
        case 4:
            $label = 'Par-carte';
            break;
        case 5:
            $label = 'Bon d achat';
            break;
        case 6:
            $label = 'Bitcoin';
            break;
        case 7:
            $label = 'Autres';
            break;
        default:
            $label = 'Inconnu';
            break;
    }
    echo "<tr><td>$label</td><td>$total</td></tr>";
}
echo '</table>';
?>
<div class="container text-center">
    <button class="btn btn-action"><a href="7-graphiques.php" style="color:white">Graphique</a></button>
</div>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        /* color: #333; */
        color: red;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #e6e6e6;
    }

    td:first-child {
        color: #007bff;
    }
</style>
<br><br><br><br>
<?php require_once('headfoot\footer.php') ?>
