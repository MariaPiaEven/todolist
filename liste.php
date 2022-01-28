<?php 
include("header.php");

// ! --> inverser la condition
if (!isset($_SESSION['pseudo'])) {
    header('Location: index.php');
}

$connexion = new PDO(

    'mysql:dbname=cci_todolist;host=localhost:3306;charset=UTF8',
    'root',
    ''
);

$requete = $connexion->prepare(
    'SELECT * 
    FROM tache' 
);

$requete->execute();

$listeTaches = $requete->fetchAll(); 
?>

<a href="ajouter-tache.php" class="btn btn-success">Ajouter un tache</a>

<div class="row">

    <?php
    foreach($listeTaches as $tache){
    ?>
        <div class="col-3 mx-auto">
            <div class="card text-white bg-primary mt-5 align-items-center">
                    <div class="card-header">
                        <h2>Tache à réaliser</h2>
                            <div class="text-center">
                            <a href="suprimer-tache.php?id=<?= $tache["id"] ?>" class="btn btn-danger">X</a>
                            <a href="editer-tache.php?id=<?= $tache["id"] ?>" class="btn btn-info">
                            <i class="fas fa-edit"></i>
                            </a>
                            </div>
                    </div>
                    <div class="card-body">
                    <h4 class="card-title"><?= $tache["titre"] ?></h4>
                    <p class="card-text"><?= $tache["contenu"] ?></p>
                </div>
            </div>
        </div>

    <?php } ?>

</div>

<?php 
include("footer.php")
?>