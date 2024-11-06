<?php
include_once '../dbconfig.php';
include_once 'flug.crud.php';
$crudFlugs = new crudFlugs($DB_con);

if(isset($_POST['btn-del']))
{
    $id = $_GET['delete_id'];
    $crudFlugs->delete($id);
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
            <strong>Success!</strong> Record was deleted...
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="alert alert-danger">
            <strong>Are you sure?</strong> You want to delete the following record?
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
                <th>Image</th>
                <th>Description</th>
            </tr>
            <?php
            $stmt = $DB_con->prepare("SELECT * FROM Flugs WHERE id=:id");
            $stmt->execute(array(":id" => $_GET['delete_id']));
            while($row = $stmt->fetch(PDO::FETCH_BOTH))
            {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['nom']); ?></td>
                    <td><img src="<?php print($row['image']); ?>" width="100"></td>
                    <td><?php print($row['description']); ?></td>
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
                <i class="glyphicon glyphicon-trash"></i> &nbsp; YES
            </button>
            <a href="index.php" class="btn btn-large btn-success">
                <i class="glyphicon glyphicon-backward"></i> &nbsp; NO
            </a>
        </form>  
        <?php
    }
    else
    {
        ?>
        <a href="index.php" class="btn btn-large btn-success">
            <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index
        </a>
        <?php
    }
    ?>
    </p>
</div>    

<?php include_once '../footer.php'; ?>
