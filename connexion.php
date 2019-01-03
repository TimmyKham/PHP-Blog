<?php
session_start ();
?>
<!DOCTYPE html>
</html>
<html>
   <head>
      <title>Connexion</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="css/connexion.css">
   </head>
   <body>
      <div id=container>
         <form method="POST" action="">
          <h1>Connexion</h1>
            <label><b>E-mail</b></label>
            <input type="email" name="Email" placeholder="votre@email.fr"" required/>
            <label><b>Mot de Passe</b></label>
            <input type="password" name="MotDePasse" placeholder="********" required/>
            <input type="submit" name="submit" value="Se connecter !" />
          <?php
            try {
              $bdd = new PDO('mysql:host=localhost;dbname=blogtimmy', 'root', 'root'); 
            } 
            catch (PDOException $e) {
              echo 'Connexion échouée : ' . $e->getMessage();
            }
              if (isset($_POST['submit'])) {
                if (!empty($_POST['Email']) && !empty($_POST['MotDePasse'])) {
                  $MotDePasse = sha1($_POST['MotDePasse']);
                  $req = $bdd->prepare('SELECT * FROM Account WHERE Email = ? AND MotDePasse = ?');
                  $req->execute(array($_POST['Email'],$_POST['MotDePasse']));
                    if ($req->rowCount() == 1) {
                        header('Location: admin.php');
                    }
                    else{
                        echo "Email ou Mot de passe incorrect !";
                    }
                }
              }
          ?>
         </form>
      </div>
   </body>
</html>