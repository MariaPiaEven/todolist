<?php

include("header.php");

//si la personne est déjà connecté
//on la redirige vers liste.php
if (isset($_SESSION['pseudo'])) {
    header('Location: liste.php');
}
    $erreurLogin = false;

if(isset($_POST['valider'])){

$connexion = new PDO(

    'mysql:dbname=cci_todolist;host=localhost:3306;charset=UTF8',
    'root',
    ''
);
    $requete = $connexion->prepare(
    'SELECT * 
    FROM utilisateur 
    WHERE pseudo = ?
    /*AND mot_de_passe = ?*/
    ');

// md5 pour encripter un mot de pass ou BCRYPT
    $requete->execute([
        $_POST['pseudo'],
        // md5($_POST['motDePasse'])
    ]);

    $utilisateur = $requete->fetch(); 
// si l'utilisateur existe
if ($utilisateur){

    $motDePasseSaisi= $_POST['motDePasse']; /*mdp de formulaire*/
    $motDePasseCrypte= $utilisateur['mot_de_passe']; /*mdp de bdd*/
    $motDePasseCompatible= password_verify($motDePasseSaisi, $motDePasseCrypte);
    
    if($motDePasseCompatible){
        $_SESSION["pseudo"]=$_POST['pseudo'];
        header('Location: liste.php');
    }else{
        $erreurLogin = true;
    }

}else{
    $erreurLogin = true;
}
}  
?>

<div class="container">

    <?php
    if ($erreurLogin){
    ?> 

    <div class="alert alert-dismissible alert-warning">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <h4 class="alert-heading">Warning! Mauvais login</h4>
    <p class="mb-0">Se compte n'existe pas; vous pouvez demandez à renouvelez votre mot passe</a>.</p>
    </div>

    <?php 
    }
    ?>

    <form method="POST">
        <div class="form-group">
            <label class="col-form-label mt-4" for="pseudo">Pseudo</label>
            <input value="<?php if(isset($_POST["pseudo"])) echo $_POST["pseudo"]?>" name="pseudo" type="text" class="form-control" placeholder="Ex : JeanDupont" id="pseudo">
        </div>

        <div class="form-group">
            <label for="motDePasse" class="form-label mt-4">Mot de passe</label>
            <input name="motDePasse" type="password" class="form-control mb-4" id="motDePasse">
        </div>

        <input class="btn btn-secondary" type="submit" value="Se connecter" name="valider">
        
    </form>

        <a href="inscription.php" class="btn btn-primary mt-3">Inscription</a>

</div>  

<?php
include("footer.php");
?>