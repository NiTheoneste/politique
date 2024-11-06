<?php
include_once '../dbconfig.php';
include_once 'flug.crud.php';
$crudFlugs = new crudFlugs($DB_con);

if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
    $nom = $_POST['nom'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    if($crudFlugs->update($id, $nom, $image, $description))
    {
        $msg = "<div class='alert alert-info'>
                <strong>Success!</strong> Record updated successfully <a href='index.php'>HOME</a>!
                </div>";
    }
    else
    {
        $msg = "<div class='alert alert-warning'>
                <strong>ERROR!</strong> Failed to update record.
                </div>";
    }
}

if(isset($_GET['edit_id']))
{
    $id = $_GET['edit_id'];
    extract($crudFlugs->getID($id));    
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
                <td>Image (URL)</td>
                <td><input type='text' name='image' value="<?php echo $image; ?>" class='form-control' required></td>
            </tr>

            <tr>
                <td>Description</td>
                <td><textarea name='description' class='form-control' required><?php echo $description; ?></textarea></td>
            </tr>

            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-update">
                        <span class="glyphicon glyphicon-edit"></span> Update Record
                    </button>
                    <a href="index.php" class="btn btn-large btn-success">
                        <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL
                    </a>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include_once '../footer.php'; ?>
