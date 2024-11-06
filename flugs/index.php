<?php
include_once '../dbconfig.php';
include_once 'flug.crud.php';
$crudFlugs = new crudFlugs($DB_con);
?>
<?php include_once '../header.php'; ?>

<div class="clearfix"></div>

<div class="container">
    <a href="add-flug.php" class="btn btn-large btn-info">
        <i class="glyphicon glyphicon-plus"></i> &nbsp; Add Flugs
    </a>
</div>

<div class="clearfix"></div><br />

<div class="container">
    <table class='table table-bordered table-responsive'>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Image</th>
            <th>Description</th>
            <th>Date d'ajout</th>
            <th>Date de modification</th>
            <th colspan="2" align="center">Actions</th>
        </tr>
        <?php
            $query = "SELECT * FROM Flugs WHERE deleted_at IS NULL ORDER BY id DESC";
            $records_per_page = 3;
            $newquery = $crudFlugs->paging($query, $records_per_page);
            $crudFlugs->dataview($newquery);
        ?>
        <tr>
            <td colspan="10" align="center">
                <div class="pagination-wrap">
                    <?php $crudFlugs->paginglink($query, $records_per_page); ?>
                </div>
            </td>
        </tr>
    </table>
</div>

<?php include_once '../footer.php'; ?>
