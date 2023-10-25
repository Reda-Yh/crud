<?php
require('connexion.php');
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
        /* Styles pour le tableau */
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
        }
        
        /* Styles pour les boutons */
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        
        .btn-success {
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
        }
        
        .btn-success:hover {
            background-color: #449d44;
            border-color: #398439;
        }
        
        /* Styles supplémentaires */
        .d-flex {
            display: flex;
        }
        
        .justify-content-center {
            justify-content: center;
        }
        
        .text-center {
            text-align: center;
        }
        
        /* Ajoutez d'autres styles personnalisés ici */
    </style>

</head>

<body>
    <?php
    include_once 'headfoot\header.php';
    ?>
    <br><br>
    <img src="img/p1.jpg" class="rounded float-start" alt="" width="300px">
    <img src="img/p2.jpg" class="rounded float-end " alt="" width="200px">
    <img src="/img/p3.jpg" class="rounded float-start" alt="" width="150px">
    <img src="img/p4.jpg" class="rounded " alt="" width="200px">
    <img src="img/p5.jpg" class="rounded float-end " alt="" width="200px">
    <div class="container col-7">

        <table class="table">
            <?php
            $sql = "SELECT p.*, GROUP_CONCAT(s.nom SEPARATOR '<br>') as paiments
            FROM chantier p
            JOIN administration c ON p.chantierID = c.chantierID
            JOIN paiment s ON c.paimentID = s.paimentID
            WHERE p.chantierID = :id
            LIMIT 1";

            $statement = $connection->prepare($sql);
            $statement->execute([':id' => $id]);
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            ?>
            <br><br><br><br><br><br>
            <tr>
                <th>Lieu</th>
                <td><?php echo $row['nom']; ?></td>
            </tr>
            <tr>
                <th>Ville</th>
                <td><?= $row['ville'] ?></td>
            </tr>
            <tr>
                <th>Paiments</th>
                <td><?= $row['paiments'] ?></td>
            </tr>
            <tr>
                <th>Prix totale</th>
                <td><?= (substr_count($row['paiments'], "<br>") + 1) * 12365 ?> DH</td>
            </tr>
            <tr>
                <td class="d-flex justify-content-center text-center">
                    <a href="downloadpdf.php?id=<?= $id; ?>" class="btn btn-success">Download &nbsp <i class="fa fa-download"></i></a>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <table>
            <th>Date d'edition</th>
            <td> &nbsp <?= date("d/m/Y") ?></td>
        </table>
    </div>
    <br><br><br><br>
    <br><br><br><br>
    

    <?php include_once('headfoot\footer.php') ?>
    
</body>

</html>