<?php

//PARTIE CONNEXION 

function session($id, $nom, $prenom) {
    $_SESSION['id']= $id;
    $_SESSION['nom']= $nom;
    $_SESSION['prenom']= $prenom;
    $_SESSION['email']= $_POST['email'];
    $_SESSION['pswd']=$_POST['pswd'];
}


function connexion() {

     if(isset($_POST['button'])){
         if(isset($_POST["email"], $_POST["pswd"])) {
            
            $email = $_POST['email'];
            $pswd = $_POST['pswd'];
            $connexion = mysqli_connect('localhost', 'root', 'root', 'nice_eat');
            $req = mysqli_query($connexion, "SELECT * FROM `users` WHERE email='$email'; ");
            $num_ligne = mysqli_num_rows($req); // compter le nombre de ligne ayant rapport a la requete SQL
            $res = mysqli_fetch_row($req);

            if (!$res || !password_verify($pswd, $res[4])){?>
                <span style="color:red"> Email ou mot de passe incorrect</span> <?php
            }elseif(!empty($email) && !empty($pswd) && password_verify($pswd, $res[4]) && $res[5] == 1){
                session($res[0], $res[1], $res[2]);
                   header("Location: menus.admin.php");
            }elseif(!empty($email) && !empty($pswd) && password_verify($pswd, $res[4])) {
                session($rees[0],$res[1], $res[2]);
                   header("Location: index.php");
                   exit(0);
            } else if(empty($email) || empty($pswd)){?> 
                <span>Veuillez entrer les champs obligatoires</span><?php
                  
              }
         }
    }
 } connexion();





?>