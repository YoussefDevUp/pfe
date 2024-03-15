<?php 
     
     require 'database.php';
  
     if ( !empty($_POST)) {
         // keep track validation errors
         $nomError = null;
         $prenomError =null;
       
         $telephoneError = null;
          
         // keep track post values
         $nom = $_POST['Nom'];
        $prenom = $_POST['Prenom'];
         $telephone = $_POST['Telephone'];
    
         
          
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
          
         
          
         if (empty($telephone)) {
             $telephoneError = 'Please enter telephone Number';
             $valid = false;
         }
          
         // insert data
         if ($valid) {
             $pdo = Database::connect();
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = "INSERT INTO Coiffeur (Nom,Prenom,Telephone) values(?,?, ?)";
             $q = $pdo->prepare($sql);
             $q->execute(array($nom,$prenom,$telephone));
             Database::disconnect();
             header("Location: index.php");
         }
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
                        <h3>Create a Coiffeur</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nomError)?'error':'';?>">
                        <label class="control-label">Nom</label>
                        <div class="controls">
                            <input name="Nom" type="text"  placeholder="Name" value="<?php echo !empty($nom)?$nom:'';?>">
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
                      
                      <div class="control-group <?php echo !empty($telephoneError)?'error':'';?>">
                        <label class="control-label">telephone Number</label>
                        <div class="controls">
                            <input name="Telephone" type="text"  placeholder="telephone Number" value="<?php echo !empty($telephone)?$telephone:'';?>">
                            <?php if (!empty($telephoneError)): ?>
                                <span class="help-inline"><?php echo $telephoneError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn " href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>
