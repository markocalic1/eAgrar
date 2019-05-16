<?php
require('connection.php');

$query = "
    SELECT
       *
    FROM totalview
";

try {
    // These two statements run the query against your database table.
    $stmt = $db->prepare($query);
    $stmt->execute();
}
catch(PDOException $ex) {
    // Note: On a production website, you should not output $ex->getMessage().
    // It may provide an attacker with helpful information about your code.
    die("Failed to run query: " . $ex->getMessage());
}
    
// Finally, we can retrieve all of the found rows into an array using fetchAll
$rows = $stmt->fetchAll();


?>

<!doctype html>
<html lang="en">
    <head>
        <title>Posjećenost</title>
        <meta charset="UTF-8">
    </head>
<body>
<h1>Posjećenost</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Stranica</th>
        <th>Broj posjeta</th>
        <th>Broj jedinstvenih posjeta</th>
        <th>Datum</th>


    </tr>
    <?php foreach($rows as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td> <!-- htmlentities is not needed here because $row['id'] is always an integer -->
            <td><?php echo htmlentities($row['page'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities($row['totalvisit'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities($row['unique_visit'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities($row['date'], ENT_QUOTES, 'UTF-8'); ?></td>


        </tr> 
    <?php endforeach; ?>
</table>
</body>
</html>