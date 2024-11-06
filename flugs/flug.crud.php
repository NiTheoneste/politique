<?php
class crudFlugs
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    // Créer un nouveau Flug
    public function create($image, $nom, $description)
    {
        try
        {
            $stmt = $this->db->prepare("INSERT INTO Flugs(image, nom, description) VALUES(:image, :nom, :description)");
            $stmt->bindparam(":image", $image);
            $stmt->bindparam(":nom", $nom);
            $stmt->bindparam(":description", $description);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    // Récupérer un Flug par ID
    public function getID($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Flugs WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    // Mettre à jour un Flug par ID
    public function update($id, $image, $nom, $description)
    {
        try
        {
            $stmt = $this->db->prepare("UPDATE Flugs SET image=:image, nom=:nom, description=:description, updated_at=NOW() WHERE id=:id");
            $stmt->bindparam(":image", $image);
            $stmt->bindparam(":nom", $nom);
            $stmt->bindparam(":description", $description);
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    // Suppression logique d'un Flug (soft delete)
    public function softDelete($id)
    {
        try
        {
            $stmt = $this->db->prepare("UPDATE Flugs SET deleted_at=NOW() WHERE id=:id");
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    // Suppression définitive d'un Flug
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM Flugs WHERE id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
    }

    // Affichage des données avec pagination
    public function dataview($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['image']); ?></td>
                    <td><?php print($row['nom']); ?></td>
                    <td><?php print($row['description']); ?></td>
                    <td><?php print($row['created_at']); ?></td>
                    <td><?php print($row['updated_at']); ?></td>
                    <td align="center">
                        <a href="edit-flug.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                    </td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
            <tr>
                <td>Nothing here...</td>
            </tr>
            <?php
        }
    }

    // Pagination des résultats
    public function paging($query, $records_per_page)
    {
        $starting_position = 0;
        if(isset($_GET["page_no"]))
        {
            $starting_position = ($_GET["page_no"]-1) * $records_per_page;
        }
        $query2 = $query . " limit $starting_position, $records_per_page";
        return $query2;
    }

    // Lien de pagination
    public function paginglink($query, $records_per_page)
    {
        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $total_no_of_records = $stmt->rowCount();

        if($total_no_of_records > 0)
        {
            ?><ul class="pagination"><?php
            $total_no_of_pages = ceil($total_no_of_records / $records_per_page);
            $current_page = 1;
            if(isset($_GET["page_no"]))
            {
                $current_page = $_GET["page_no"];
            }
            if($current_page != 1)
            {
                $previous = $current_page - 1;
                echo "<li><a href='" . $self . "?page_no=1'>First</a></li>";
                echo "<li><a href='" . $self . "?page_no=" . $previous . "'>Previous</a></li>";
            }
            for($i = 1; $i <= $total_no_of_pages; $i++)
            {
                if($i == $current_page)
                {
                    echo "<li><a href='" . $self . "?page_no=" . $i . "' style='color:red;'>" . $i . "</a></li>";
                }
                else
                {
                    echo "<li><a href='" . $self . "?page_no=" . $i . "'>" . $i . "</a></li>";
                }
            }
            if($current_page != $total_no_of_pages)
            {
                $next = $current_page + 1;
                echo "<li><a href='" . $self . "?page_no=" . $next . "'>Next</a></li>";
                echo "<li><a href='" . $self . "?page_no=" . $total_no_of_pages . "'>Last</a></li>";
            }
            ?></ul><?php
        }
    }
}
?>
