<?php
include_once '../dbconfig.php';
include_once 'etat.crud.php';
$crudEtat = new crudEtat($DB_con);
?>
<?php include_once '../header.php'; ?>

<div class="clearfix"></div>

<div class="container">
    <a href="add-etat.php" class="btn btn-large btn-info">
        <i class="glyphicon glyphicon-plus"></i> &nbsp; Add Etat
    </a>
</div>

<div class="clearfix"></div><br />

<div class="container">
    <table class='table table-bordered table-responsive'>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>PID</th>
            <th>Population</th>
            <th>Superficie</th>
            <th>Capitale</th>
            <th>Flug ID</th>
            <th>Date de fondation</th>
            <th>Date d'ajout</th>
            <th>Date de modification</th>
            <th colspan="2" align="center">Actions</th>
        </tr>
        <?php
            $query = "SELECT * FROM Etat WHERE deleted_at IS NULL ORDER BY id DESC";
            $records_per_page = 3;
            $newquery = $crudEtat->paging($query, $records_per_page);
            $crudEtat->dataview($newquery);
        ?>
        <tr>
            <td colspan="12" align="center">
                <div class="pagination-wrap">
                    <?php $crudEtat->paginglink($query, $records_per_page); ?>
                </div>
            </td>
        </tr>
    </table>
</div>

<?php include_once '../footer.php'; ?>
