<?php
require('connexion.php');
$query4 = "SELECT  COUNT(administration.chantierID) as nbr_pat, administration.paimentID,paiment.nom 
FROM administration  
LEFT JOIN paiment ON administration.paimentID = paiment.paimentID 
GROUP BY paimentID";
$stm4 = $connection->prepare($query4);
$stm4->execute();
$row4 = $stm4->fetchAll();
$nb1 = $row4[0]['nbr_pat'] ?? 0;
$nb2 = $row4[1]['nbr_pat'] ?? 0;
$nb3 = $row4[2]['nbr_pat'] ?? 0;
$nb4 = $row4[3]['nbr_pat'] ?? 0;
$nb5 = $row4[4]['nbr_pat'] ?? 0;
$nb6 = $row4[5]['nbr_pat'] ?? 0;
$nb7 = $row4[6]['nbr_pat'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <title>Document</title>
</head>

<body>
    <?php
    require_once('headfoot\header.php')
    ?>
    <br><br><br><br><br><br>
    
    <canvas id="myChart"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['cheque', 'espece', 'enligne', 'par-carte', 'Bon d achat', 'Bitcoin', 'autres'],
                datasets: [{
                    label: 'administration',
                    data: [<?php echo json_encode($nb1); ?>, <?php echo json_encode($nb2); ?>,
                        <?php echo json_encode($nb3); ?>, <?php echo json_encode($nb4); ?>,
                        <?php echo json_encode($nb5); ?>, <?php echo json_encode($nb6); ?>,
                        <?php echo json_encode($nb7); ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)'

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    
    <?php require_once('headfoot\footer.php') ?>
</body>

</html>