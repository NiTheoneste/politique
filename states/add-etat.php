<?php
// Inclusion de la configuration de la base de données et de la classe de CRUD pour Etat
include_once '../dbconfig.php';
include_once 'etat.crud.php'; // Assurez-vous d'avoir un fichier CRUD pour la table Etat
$crudEtat = new crudEtat($DB_con);


// Vérification si le formulaire a été soumis
if(isset($_POST['btn-save']))
{
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $pid = $_POST['pid'];
    $population = $_POST['population'];
    $superficie = $_POST['superficie'];
    $capitale = $_POST['capitale'];
    $flugs_id = $_POST['flugs_id'];
    $date_fondation = $_POST['date_fondation'];
    
    // Tentative d'insertion dans la base de données
    if($crudEtat->createEtat($nom, $pid, $population, $superficie, $capitale, $flugs_id, $date_fondation))
    {
        // Redirection avec un message de succès
        header("Location: index.php?inserted");
    }
    else
    {
        // Redirection avec un message d'erreur
        header("Location: add-etat.php?failure");
    }
}
?>

<?php include_once '../header.php'; ?>

<div class="clearfix"></div>

<?php
// Affichage des messages de succès ou d'échec après l'insertion
if(isset($_GET['inserted']))
{
    ?>
    <div class="container">
        <div class="alert alert-info">
            <strong>Succès!</strong> L'enregistrement a été inséré avec succès. <a href="index.php">Accueil</a>
        </div>
    </div>
    <?php
}
else if(isset($_GET['failure']))
{
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>Erreur!</strong> Il y a eu un problème lors de l'insertion de l'enregistrement.
        </div>
    </div>
    <?php
}
?>

<div class="clearfix"></div><br />

<div class="container">
    <form method="post">
        <table class="table table-bordered">
            <tr>
                <td>Nom</td>
                <td><input type="text" name="nom" class="form-control" required></td>
            </tr>
            <tr>
                <td>PID</td>
                <td><input type="text" name="pid" class="form-control"></td>
            </tr>
            <tr>
                <td>Population</td>
                <td><input type="number" name="population" class="form-control" min="0"></td>
            </tr>
            <tr>
                <td>Superficie</td>
                <td><input type="number" name="superficie" class="form-control" step="0.01" min="0"></td>
            </tr>
            <tr>
                <td>Capitale</td>
                <td><input type="text" name="capitale" class="form-control"></td>
            </tr>
            <tr>
                <td>Flug ID</td>
                <td><input type="number" name="flugs_id" class="form-control"></td>
            </tr>
            <tr>
                <td>Date de Fondation</td>
                <td><input type="date" name="date_fondation" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-save">
                        <span class="glyphicon glyphicon-plus"></span> Créer un nouvel enregistrement
                    </button>  
                    <a href="index.php" class="btn btn-large btn-success">
                        <i class="glyphicon glyphicon-backward"></i> &nbsp; Retour à l'accueil
                    </a>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include_once '../footer.php'; ?>
