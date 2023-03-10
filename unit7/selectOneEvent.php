<!DOCTYPE html>
<html lang="en">
<style>
    h1 {
        color: red;
    }
    
    table {
        border: 1px solid black;
    }

    table th {
        padding: 0 3rem;
    }

    table td {
        padding: 0 1rem;
    }

    table td + td { 
        border-left:2px solid black; 
    }

    table tr + tr {
        
    }
</style>
<body>


<table>
    
    <?php
    
    $serverName = "localhost";
    $username = "wdv341_user";
    $password = "wdv341_password!";
    $database = "wdv341";

    try {
        $conn = new PDO("mysql:host=$serverName;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $aName = 'Mr.Fork';
        
        $sql = ("SELECT id, name, presenter, description FROM wdv341_events WHERE presenter = :aName");
        
        $stmt = $conn->prepare($sql);
        $stmt->execute(['aName' => $aName]);
        $results = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($results) {
            echo '<tr>
            <th>ID</th>
            <th>NAME</th>
            <th>PRESENTER</th>
            <th>DESCRIPTION</th>
            </tr>';
            $row = $stmt->fetch();
            echo '<tr>
                     <td>' . $row['id'] . '</td>
                     <td>' . $row['name']. '</td>
                     <td>' . $row['presenter'] . '</td>
                     <td class="description">' . $row['description'] .  '</td>
                 </tr>';
        }
    }
    catch(PDOException $e)
        {
            echo '<h1>Event table is empty</h1>';
        }
    ?>

</table>

</body>
</html>