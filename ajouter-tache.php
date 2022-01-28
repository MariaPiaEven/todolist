<?php include('header.php'); 

if (isset($_POST['valider'])){

$connexion = new PDO(
    
    'mysql:dbname=cci_todolist;host=localhost:3306;charset=UTF8',
    'root',
    ''
);

$requete = $connexion->prepare(
    'INSERT INTO tache (id, titre, contenu)
    VALUES (NULL, ?, ?)'
);

$requete->execute([
    $_POST['titre'],
    $_POST['contenu'],
]);

    // redirection vers la page de taches "liste.php"
    header('location: liste.php');

}
?>

<div class="container">
<form method="POST">

    <div class="form-group">
    <label class="col-form-label mt-4" for="titre">Titre</label>
    <input name="titre" type="text" class="form-control" id="titre">
    </div>

    <div class="form-group">
      <label for="contenu" class="form-label mt-4">Contenu</label>
      <textarea name="contenu" class="form-control" id="contenu" rows="5"></textarea>
    </div>

    <input name="valider" class="btn btn-success mt-4" type="submit" value="Ajouter la tache">

</form>
</div>

<?php include('footer.php'); ?>