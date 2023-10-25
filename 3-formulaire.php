<?php include_once('headfoot\header.php') ?>

<?php
require('connexion.php');

if (isset($_POST['submit'])) {
  $nom = $_POST['nom'];
  $ville = $_POST['ville'];
  $paiment = $_POST['paiment'];
  $date = $_POST['date'];

  if ($nom && $ville !== false && $date) {
      try {
          $sql = "INSERT INTO chantier (nom, ville, date)
          VALUES (:nom, :ville, :date)";
          $stmt = $connection->prepare($sql);
          $stmt->execute(['nom' => $nom, 'ville' => $ville, 'date' => $date]);
          $chantierID = $connection->lastInsertId();

          foreach ($paiment as $value) {
              $sql = "INSERT INTO administration (paimentID, chantierID) VALUES (:value, :chantierID)";
              $statement = $connection->prepare($sql);
              $statement->execute(['value' => $value, 'chantierID' => $chantierID]);
          }

          // Redirect to a success page or display a success message
          header('Location: 4-tables.php');
          exit();
      } catch (Exception $e) {
          // Handle exceptions, display an error message, or redirect to an error page
          echo "An error occurred: " . $e->getMessage();
          header('Location: erreur.php');
      }
  } else {
      // Handle invalid inputs, display an error message, or redirect to an error page
      echo "Invalid inputs";

  }
}

?>
<!--==============================content================================-->
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Formulaire de rendez-vous médical</title>

  <!-- Liens Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- CSS personnalisé -->
  <link rel="stylesheet" href="/css/formulaire.css">
</head>
<body>
  <form method="POST">
  <div class="container col-6">
        <div class="card cardcolor">
        <div class="card-header">
            Formulaire d'inscription
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
            <form class=" container  d-flex justify-content-center card-body " method="post">
                <div class="form-group">
                    <div class="form-group">
                        <label for="lieu" class="couleur">Lieu</label>
                        <input type="text" class="form-control" id="lieu" name="nom" required>
                    </div>

                    <div class="form-group">
                        <label for="ville" class="couleur">ville</label>
                        <input type="text" name="ville" class="form-control" id="ville" required>
                    </div>
                   
                    <div class="form-group">
                        <label for="type">Type de paiment :</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="paiment[]" value="1" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">cheque</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="paiment[]" value="2" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">espece</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="paiment[]" value="3" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">enligne</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="paiment[]" value="4" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">par-carte</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="paiment[]" value="5" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Bon d achat</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="paiment[]" value="6" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Bitcoin</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="paiment[]" value="7" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">autres</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="date" class="form-label">Date_debut</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input required type="submit" name="submit" id="submit" class="btn btn-primary">
                    </div>
                </div>
            </form>

</body>

</html>

<div class="clear"></div>
</div><!--the end of wrapper-->
</div>
</section>
<?php include_once('headfoot\footer.php') ?>