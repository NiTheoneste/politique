<?php
// Inclusion de la configuration de la base de données et de la classe de CRUD
include_once '../dbconfig.php';
include_once 'flug.crud.php';
$crudFlugs = new crudFlugs($DB_con);

// Vérification si le formulaire a été soumis
if(isset($_POST['btn-save']))
{
    // Récupération des données du formulaire
    $image = $_POST['image'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    
    // Tentative d'insertion dans la base de données
    if($crudFlugs->create($image, $nom, $description))
    {
        // Redirection avec un message de succès
        header("Location: index.php?inserted");
    }
    else
    {
        // Redirection avec un message d'erreur
        header("Location: add-flug.php?failure");
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
            <strong>Success!</strong> Record was inserted successfully. <a href="index.php">HOME</a>
        </div>
    </div>
    <?php
}
else if(isset($_GET['failure']))
{
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>Error!</strong> There was an issue inserting the record.
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
                <td>Image URL</td>
                <td><input type="text" name="image" class="form-control" required></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="nom" class="form-control" required></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name="description" class="form-control" required></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-save">
                        <span class="glyphicon glyphicon-plus"></span> Create New Record
                    </button>  
                    <a href="index.php" class="btn btn-large btn-success">
                        <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index
                    </a>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include_once '../footer.php'; ?>
