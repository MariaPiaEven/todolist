<?php 
include("header.php");

$connexion = new PDO(
    
    'mysql:dbname=cci_todolist;host=localhost:3306;charset=UTF8',
    'root',
    ''
);

$requete = $connexion->prepare(
    'SELECT * FROM tache
    WHERE id = ?'
);

$requete->execute([
    $_GET['id'],
]);

$tache = $requete ->fetch();

?>

<div class="container">
<form method="POST">

    <div class="form-group">
    <label class="col-form-label mt-4" for="titre">Titre</label>
    <input value="<?= $tache['titre']?>" name="titre" type="text" class="form-control" id="titre">
    </div>

    <div class="form-group">
      <label for="contenu" class="form-label mt-4">Contenu</label>
      <textarea name="contenu" class="form-control" id="contenu" rows="5"><?= $tache['titre']?></textarea>
    </div>

    <input name="valider" class="btn btn-success mt-4" type="submit" value="Enregistrer">

</form>
</div>


<?php 
include("footer.php")
?>