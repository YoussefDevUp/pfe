<?php
     require 'database.php';
     $id = null;
     if ( !empty($_GET['ID_Client'])) {
        $id = $_REQUEST['ID_Client'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }

  
     if ( !empty($_POST)) {
         // keep track validation errors
         $nomError = null;
         $prenomError =null;
         $adresseError = null;
         $telephoneError = null;
          
         // keep track post values
         $nom = $_POST['Nom'];
        $prenom = $_POST['Prenom'];
         $telephone = $_POST['Telephone'];
         $adresse = $_POST['Adresse'];
         
          
         // validate input
         $valid = true;
         if (empty($nom)) {
             $nomError = 'Please enter Name';
             $valid = false;
         }
         if (empty($prenom)) {
            $prenomError = 'Please enter Prenom';
            $valid = false;
        }
          
         if (empty($adresse)) {
             $adresseError = 'Please enter  Address';
             $valid = false;
         } else if ( !filter_var($adresse,FILTER_VALIDATE_EMAIL) ) {
             $adresseError = 'Please enter a valid  Address';
             $valid = false;
         }
          
         if (empty($telephone)) {
             $telephoneError = 'Please enter telephone Number';
             $valid = false;
         }
          
         // insert data
         if ($valid) {
             $pdo = Database::connect();
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = "UPDATE client  set Nom = ?, Prenom = ? , Telephone =? , Adresse = ? WHERE ID_Client = ?";
             $q = $pdo->prepare($sql);
             $q->execute(array($nom,$prenom,$telephone,$adresse,$id));
             Database::disconnect();
             header("Location: index.php");
         }
     } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM client where ID_Client = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $nom = $data['Nom'];
        $prenom = $data['Prenom'];
        $telephone = $data['Telephone'];
        $adresse = $data['Adresse'];
        
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update a Client</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?ID_Client=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($nomError)?'error':'';?>">
                        <label class="control-label">Nom</label>
                        <div class="controls">
                            <input name="Nom" type="text"  placeholder="Nom" value="<?php echo !empty($nom)?$nom:'';?>">
                            <?php if (!empty($nomError)): ?>
                                <span class="help-inline"><?php echo $nomError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($prenomError)?'error':'';?>">
                        <label class="control-label">Prenom</label>
                        <div class="controls">
                            <input name="Prenom" type="text"  placeholder="Prenom" value="<?php echo !empty($prenom)?$prenom:'';?>">
                            <?php if (!empty($prenomError)): ?>
                                <span class="help-inline"><?php echo $prenomError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($adresseError)?'error':'';?>">
                        <label class="control-label"> Adresse</label>
                        <div class="controls">
                            <input name="Adresse" type="text" placeholder="Email Address" value="<?php echo !empty($adresse)?$adresse:'';?>">
                            <?php if (!empty($adresseError)): ?>
                                <span class="help-inline"><?php echo $adresseError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($telephoneError)?'error':'';?>">
                        <label class="control-label">Telephone</label>
                        <div class="controls">
                            <input name="Telephone" type="text"  placeholder="Mobile Number" value="<?php echo !empty($telephone)?$telephone:'';?>">
                            <?php if (!empty($telephoneError)): ?>
                                <span class="help-inline"><?php echo $telephoneError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
