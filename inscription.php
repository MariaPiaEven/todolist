<?php 
include("header.php");

$erreurConfirmerMotDePasse = false;
$erreurMotDePasseTropCourt = false;

// si l'utilisateur a validé le formulaire
if(isset($_POST['valider'])){

    //strlen Calcule la taille de un chaine de caracter
    // si le mot de passe fait moins de 5 caracteres
    if(strlen($_POST['motDePasse']) < 5){

        $erreurMotDePasseTropCourt = true;

    // sinon si les mot de passes sont identiques
    } else if($_POST['motDePasse'] == $_POST['confirmerMotDePasse']){

    $connexion = new PDO(
    
        'mysql:dbname=cci_todolist;host=localhost:3306;charset=UTF8',
        'root',
        ''
    );

    $requete = $connexion->prepare(
        'INSERT INTO utilisateur (id, pseudo, mot_de_passe)
        VALUES (NULL, ?, ?)'
    );
    
    $requete->execute([
        $_POST['pseudo'],
        password_hash($_POST['motDePasse'], PASSWORD_BCRYPT)
    ]);

        // redirection vers la page d'accueil
        header('location: index.php');
    } else {
        $erreurConfirmerMotDePasse = true;
    }

}

?>

<form method="POST">
    <div class="container">
        <div class="form-group">
            <label class="col-form-label mt-4" for="pseudo">Pseudo</label>
            <input value="<?php if(isset($_POST["pseudo"])) echo $_POST["pseudo"]?>" name="pseudo" type="text" class="form-control" placeholder="Ex : JeanDupont" id="pseudo">
        </div>  
<!-- Pour pas effacer le pseudo et pas le recrire une autre fois-->
        <div class="form-group <?php if ($erreurMotDePasseTropCourt) echo "has-danger"?>">
            <label for="motDePasse" class="form-label mt-4">Mot de passe</label>
            <input name="motDePasse" type="password" class="form-control <?php if($erreurMotDePasseTropCourt) echo "is-invalid" ?>" id="motDePasse">
            <?php 
            if($erreurMotDePasseTropCourt){
            ?>
                <div class="invalid-feedback">Les mots passes doit avoir un minimum 5 caractères</div>

            <?php 
            } 
            ?>
        </div>

        <div class="form-group <?php if ($erreurConfirmerMotDePasse) echo "has-danger"?>">
            <label for="confirmerMotDePasse" class="form-label  mt-4">Confirmer le mot de passe</label>
            <input name="confirmerMotDePasse" type="password" class="form-control <?php if($erreurConfirmerMotDePasse) echo "is-invalid" ?>" id="confirmerMotDePasse">
            <?php 
            if($erreurConfirmerMotDePasse){
            ?>
                <div class="invalid-feedback">Les mots passes ne correspondent pas</div>

            <?php 
            } 
            ?>
            
        </div>

        <!-- <div class="form-group has-danger">
            <label class="form-label mt-4" for="inputInvalid">Invalid input</label>
            <input type="text" value="wrong value" class="form-control is-invalid" id="inputInvalid">
            <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
        </div> -->

        <input class="btn btn-success mt-4" type="submit" value="S'inscrire" name="valider">
    </div>
</form>

<?php
include("footer.php");
?>