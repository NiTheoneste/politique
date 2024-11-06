<?php
class crudEtat
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    // Create a new Etat
    public function createEtat($nom, $pid, $population, $superficie, $capitale, $flugs_id, $date_fondation)
    {
        try
        {
            $stmt = $this->db->prepare("INSERT INTO Etat(nom, pid, population, superficie, capitale, flugs_id, date_fondation) 
                                        VALUES(:nom, :pid, :population, :superficie, :capitale, :flugs_id, :date_fondation)");
            $stmt->bindparam(":nom", $nom);
            $stmt->bindparam(":pid", $pid);
            $stmt->bindparam(":population", $population);
            $stmt->bindparam(":superficie", $superficie);
            $stmt->bindparam(":capitale", $capitale);
            $stmt->bindparam(":flugs_id", $flugs_id);
            $stmt->bindparam(":date_fondation", $date_fondation);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }


    // Get Etat by ID
    public function getEtatByID($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Etat WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    // Update Etat by ID
    public function updateEtat($id, $nom, $pid, $population, $superficie, $capitale, $flugs_id, $date_fondation)
    {
        try
        {
            $stmt = $this->db->prepare("UPDATE Etat 
                                        SET nom = :nom, pid = :pid, population = :population, superficie = :superficie, 
                                            capitale = :capitale, flugs_id = :flugs_id, date_fondation = :date_fondation 
                                        WHERE id = :id");
            $stmt->bindparam(":nom", $nom);
            $stmt->bindparam(":pid", $pid);
            $stmt->bindparam(":population", $population);
            $stmt->bindparam(":superficie", $superficie);
            $stmt->bindparam(":capitale", $capitale);
            $stmt->bindparam(":flugs_id", $flugs_id);
            $stmt->bindparam(":date_fondation", $date_fondation);
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


    // Soft delete an Etat
    public function deleteEtat($id)
    {
        try
        {
            $stmt = $this->db->prepare("UPDATE Etat SET deleted_at = NOW() WHERE id = :id");
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


    // Permanently delete an Etat
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM Etat WHERE id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
    }

    // Display Etat data with pagination
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
                    <td><?php print($row['nom']); ?></td>
                    <td><?php print($row['pid']); ?></td>
                    <td><?php print($row['population']); ?></td>
                    <td><?php print($row['superficie']); ?></td>
                    <td><?php print($row['capitale']); ?></td>
                    <td><?php print($row['flugs_id']); ?></td>
                    <td><?php print($row['date_fondation']); ?></td>
                    <td><?php print($row['created_at']); ?></td>
                    <td><?php print($row['updated_at']); ?></td>
                    <td align="center">
                        <a href="edit-etat.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
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
                <td colspan="11">Nothing here...</td>
            </tr>
            <?php
        }
    }

    // Paginate Etat results
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

    // Pagination links
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
