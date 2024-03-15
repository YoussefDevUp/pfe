<?php 
     
     require 'database.php';
  
     if ( !empty($_POST)) {
         // keep track validation errors
         $dateError = null;
         $heur_dError =null;
    
         $heur_fError = null;
          
         // keep track post values
         $date = $_POST['Date'];
        $heur_d = $_POST['Heur_Debut'];
         $heur_f = $_POST['Heur_Fin'];
 
         
          
         // validate input
         $valid = true;
         if (empty($date)) {
             $dateError = 'Please enter Date';
             $valid = false;
         }
         if (empty($heur_d)) {
            $heur_dError = 'Please enter Heur';
            $valid = false;
        }
          
         
         if (empty($heur_f)) {
             $heur_fError = 'Please enter Heur';
             $valid = false;
         }
          
         // insert data
         if ($valid) {
             $pdo = Database::connect();
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = "INSERT INTO Reservation (Date,Heur_Debut,Heur_Fin) values(?,?, ?)";
             $q = $pdo->prepare($sql);
             $q->execute(array($date,$heur_d,$heur_f,$adresse));
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
                        <h3>Create a Reservation</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
                        <label class="control-label">Date</label>
                        <div class="controls">
                            <input name="Date" type="text"  placeholder="Name" value="<?php echo !empty($date)?$date:'';?>">
                            <?php if (!empty($dateError)): ?>
                                <span class="help-inline"><?php echo $dateError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($heur_dError)?'error':'';?>">
                        <label class="control-label">Heur_Debut</label>
                        <div class="controls">
                            <input name="Heur_Debut" type="text"  placeholder="Heur_Debut" value="<?php echo !empty($heur_d)?$heur_d:'';?>">
                            <?php if (!empty($heur_dError)): ?>
                                <span class="help-inline"><?php echo $heur_dError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                     
                      <div class="control-group <?php echo !empty($heur_fError)?'error':'';?>">
                        <label class="control-label">Heur_Fin </label>
                        <div class="controls">
                            <input name="Heur_Fin" type="text"  placeholder="Heur_Fin " value="<?php echo !empty($heur_f)?$heur_f:'';?>">
                            <?php if (!empty($heur_fError)): ?>
                                <span class="help-inline"><?php echo $heur_fError;?></span>
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
