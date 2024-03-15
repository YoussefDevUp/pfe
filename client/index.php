<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>PHP CRUD Grid</h3>
            </div>
            <div class="row">
            <p>
                    <a href="create.php" class="btn btn-success">Create</a>
                </p>

                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Telephone</th>
                      <th>Adresse</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM Client ORDER BY ID_Client DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Nom'] . '</td>';
                            echo '<td>'. $row['Prenom'] . '</td>';
                            echo '<td>'. $row['Telephone'] . '</td>';
                            echo '<td>'. $row['Adresse'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn " href="read.php?ID_Client='.$row['ID_Client'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="update.php?ID_Client='.$row['ID_Client'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?ID_Client='.$row['ID_Client'].'">Delete</a>';
                            echo '</td>';

                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> 
  </body>
</html>
