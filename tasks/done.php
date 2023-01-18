<?php  
session_start();
require_once '../backend/config.php'; 
if (!isset($_SESSION['user_id']))
{
$msg = "Je moet eerst inloggen!";

header("Location:../inlog.php");
exit;
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title>hier een overzicht van alle taken met de status done</title>
    <?php require_once '../head.php'; ?>
</head>

<body>
    <?php require_once '../header.php'; ?>



<?php
    require_once '../backend/conn.php';
    $query = "SELECT * FROM taken WHERE status = 'done'";
    $statement = $conn->prepare($query);
    $statement->execute();
    $taken = $statement->fetchAll(PDO::FETCH_ASSOC);

?>



 <table>
    
<tr>
<th>titel</th>
<th>beschrijving</th>
<th>afdeling</th>
<th>status</th>
<th>Deadline</th>
<th>edit</th>
<th>delete</th>


</tr>

<?php foreach ($taken as $taak): ?>
<tr>
        <td><?php echo $taak['titel'];?></td>
        <td><?php echo $taak['beschrijving'];?></td>
        <td><?php echo $taak['afdeling'];?></td>
        <td><?php echo $taak['status'];?></td>
         <td><?php echo $taak['deadline'];?></td>
        <td><a href="edit.php?id=<?php echo $taak ['id'];?>">edit </a></td>
        <td><a href="edit.php?id=<?php echo $taak ['id'];?>">delete </a></td>
</tr>
<?php endforeach ?>
</table>






<?php require_once '../footer.php'; ?>



</body>