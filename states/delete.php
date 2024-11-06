<?php
// Inclusion de la configuration de la base de données
include_once '../dbconfig.php';
include_once 'etat.crud.php';
$crudEtat = new crudEtat($DB_con);

if(isset($_POST['btn-del']))
{
    // Récupération de l'ID de l'enregistrement à supprimer
    $id = $_GET['delete_id'];
    $crudEtat->deleteEtat($id);
    header("Location: delete.php?deleted");    
}

?>

<?php include_once '../header.php'; ?>

<div class="clearfix"></div>

<div class="container">
    <?php
    if(isset($_GET['deleted']))
    {
        ?>
        <div class="alert alert-success">
            <strong>Succès!</strong> L'enregistrement a été supprimé...
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="alert alert-danger">
            <strong>Êtes-vous sûr ?</strong> Vous voulez supprimer l'enregistrement suivant ?
        </div>
        <?php
    }
    ?>    
</div>

<div class="clearfix"></div>

<div class="container">
    <?php
    if(isset($_GET['delete_id']))
    {
        ?>
        <table class='table table-bordered'>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>PID</th>
                <th>Population</th>
                <th>Superficie</th>
                <th>Capitale</th>
                <th>Flug ID</th>
                <th>Date de Fondation</th>
            </tr>
            <?php
            $stmt = $DB_con->prepare("SELECT * FROM Etat WHERE id=:id");
            $stmt->execute(array(":id" => $_GET['delete_id']));
            while($row = $stmt->fetch(PDO::FETCH_BOTH))
            {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['nom']); ?></td>
                    <td><?php print($row['pid']); ?></td>
                    <td><?php print($row['population']); ?></td>
                    <td><?php print($row['superficie']); ?></td>
                    <td><?php print($row['capitale']); ?></td>
                    <td><?php print($row['flugs_id']); ?></td>
                    <td><?php print($row['date_fondation']); ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    ?>
</div>

<div class="container">
    <p>
    <?php
    if(isset($_GET['delete_id']))
    {
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
            <button class="btn btn-large btn-primary" type="submit" name="btn-del">
                <i class="glyphicon glyphicon-trash"></i> &nbsp; OUI
            </button>
            <a href="index.php" class="btn btn-large btn-success">
                <i class="glyphicon glyphicon-backward"></i> &nbsp; NON
            </a>
        </form>  
        <?php
    }
    else
    {
        ?>
        <a href="index.php" class="btn btn-large btn-success">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; Retour à l'accueil
        </a>
        <?php
    }
    ?>
    </p>
</div>    

<?php include_once '../footer.php'; ?>
