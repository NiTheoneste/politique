<?php
// Inclusion de la configuration de la base de données et de la classe CRUD pour Etat
include_once '../dbconfig.php';
include_once 'etat.crud.php'; // Assurez-vous d'avoir un fichier CRUD pour la table Etat
$crudEtat = new crudEtat($DB_con);

if(isset($_POST['btn-update']))
{
    // Récupération de l'ID de l'enregistrement à éditer et des données du formulaire
    $id = $_GET['edit_id'];
    $nom = $_POST['nom'];
    $pid = $_POST['pid'];
    $population = $_POST['population'];
    $superficie = $_POST['superficie'];
    $capitale = $_POST['capitale'];
    $flugs_id = $_POST['flugs_id'];
    $date_fondation = $_POST['date_fondation'];

    // Tentative de mise à jour de l'enregistrement
    if($crudEtat->updateEtat($id, $nom, $pid, $population, $superficie, $capitale, $flugs_id, $date_fondation))
    {
        $msg = "<div class='alert alert-info'>
                <strong>Succès!</strong> L'enregistrement a été mis à jour avec succès <a href='index.php'>Accueil</a>!
                </div>";
    }
    else
    {
        $msg = "<div class='alert alert-warning'>
                <strong>Erreur!</strong> Échec de la mise à jour de l'enregistrement.
                </div>";
    }
}

// Récupération de l'enregistrement à éditer
if(isset($_GET['edit_id']))
{
    $id = $_GET['edit_id'];
    extract($crudEtat->getEtatByID($id));
}

?>
<?php include_once '../header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
    echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
    <form method='post'>
        <table class='table table-bordered'>
            <tr>
                <td>Nom</td>
                <td><input type='text' name='nom' value="<?php echo $nom; ?>" class='form-control' required></td>
            </tr>
            <tr>
                <td>PID</td>
                <td><input type='text' name='pid' value="<?php echo $pid; ?>" class='form-control'></td>
            </tr>
            <tr>
                <td>Population</td>
                <td><input type='number' name='population' value="<?php echo $population; ?>" class='form-control' min="0"></td>
            </tr>
            <tr>
                <td>Superficie</td>
                <td><input type='number' name='superficie' value="<?php echo $superficie; ?>" class='form-control' step="0.01" min="0"></td>
            </tr>
            <tr>
                <td>Capitale</td>
                <td><input type='text' name='capitale' value="<?php echo $capitale; ?>" class='form-control'></td>
            </tr>
            <tr>
                <td>Flug ID</td>
                <td><input type='number' name='flugs_id' value="<?php echo $flugs_id; ?>" class='form-control'></td>
            </tr>
            <tr>
                <td>Date de Fondation</td>
                <td><input type='date' name='date_fondation' value="<?php echo $date_fondation; ?>" class='form-control'></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-update">
                        <span class="glyphicon glyphicon-edit"></span> Mettre à jour l'enregistrement
                    </button>
                    <a href="index.php" class="btn btn-large btn-success">
                        <i class="glyphicon glyphicon-backward"></i> &nbsp; ANNULER
                    </a>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include_once '../footer.php'; ?>
