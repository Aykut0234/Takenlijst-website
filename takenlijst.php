<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'backend/config.php'; 
if (!isset($_SESSION['user_id']))
{
$msg = "Je moet eerst inloggen!";


header("Location: /inlog.php");
exit;
}
?>
<!doctype html>
    <html lang="nl">

    <head>
        <title></title>
        <?php require_once 'head.php'; ?>
    </head>
    <?php require_once 'header.php'; ?>


    <body>
        <form action="takenlijst.php" method="GET">
        <label for="department_task">afdeling taak:</label>
                <select name="dtf" id="dtf">
                    <option value="alle">alle</option>
                    <option value="personeel">personeel</option>
                    <option value="horeca">horeca</option>
                    <option value="techniek">techniek</option>
                    <option value="inkoop">inkoop</option>
                    <option value="klantenservice">klantenservice</option>
                    <option value="groen">groen</option>
                    <option value="my_tasks">mijn taken</option>
                </select> 
                <input type="submit" value="afdeling">
</form>


        <div class="takenlijsttitel">
            <h3>welkom bij de takenlijst </h3>    
        </div>
 <?php

if (empty($_GET['dtf']))
{
    $dtf = 'alle';
}
else
{
 $dtf = $_GET['dtf'];
}

    require_once 'backend/conn.php';
    if ($dtf == 'alle')
    {
      $query = "SELECT * FROM taken WHERE status = 'to do' ORDER BY deadline ";  
      $statement = $conn->prepare($query);
    $statement->execute();
    } 
elseif($dtf == 'my_tasks')
{

    $query = "SELECT * FROM taken WHERE status = 'to do' AND user = :user ORDER BY deadline ";
    $statement = $conn->prepare($query);
    $statement->execute([":user" => $_SESSION['user_id']]);
}
// filter werkt maar toont geen meldingen vragen dinsdag
    else
    {
        $query = "SELECT * FROM taken WHERE status = 'to do' AND afdeling = :dtf ORDER BY deadline ";
        $statement = $conn->prepare($query);
        $statement->execute([":dtf" => $dtf]);
    }
    

    
    $taken = $statement->fetchAll(PDO::FETCH_ASSOC);

?>


        <div class="takenlijsttabel">
            <div class="titel_todo">
                <a href="../b3-22-feb-team-a5/tasks/create.php">Nieuwe taak in todo</a>
                <div class="todo">
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
        <?php $date = date_create($taak['deadline']);?> <td><?php   echo date_format($date,"d/m/Y"); ?></td><!--<td><?php echo $taak['deadline'];?>  </td>-->
        <td><a href="tasks/edit.php?id=<?php echo $taak ['id'];?>">edit </a></td>
        <td><a href="tasks/edit.php?id=<?php echo $taak ['id'];?>">delete</a></td>
</tr>
<?php endforeach ?>
</table>
                    
                </div>
            </div>

            <div class="titel_in_progress">



             <div class="in_progress">
               
<?php
    require_once 'backend/conn.php';
    if ($dtf == 'alle')
    {
      $query = "SELECT * FROM taken WHERE status = 'in progress' ORDER BY deadline ";  
      $statement = $conn->prepare($query);
    $statement->execute();
    } 
    elseif($dtf == 'my_tasks')
{

    $query = "SELECT * FROM taken WHERE status = 'in progress' AND user = :user ORDER BY deadline ";
    $statement = $conn->prepare($query);
    $statement->execute([":user" => $_SESSION['user_id']]);
}
    else
    {
        $query = "SELECT * FROM taken WHERE status = 'in progress' AND afdeling = :dtf ORDER BY deadline ";
        $statement = $conn->prepare($query);
        $statement->execute([":dtf" => $dtf]);
    }
    
    
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
        <?php $date = date_create($taak['deadline']);?> <td><?php   echo date_format($date,"d/m/Y"); ?></td>
        <td><a href="tasks/edit.php?id=<?php echo $taak ['id'];?>">edit </a></td>
        <td><a href="tasks/edit.php?id=<?php echo $taak ['id'];?>">delete </a></td>
</tr>
<?php endforeach ?>
</table>


            </div>
        </div>

        <div class="titel_done">
            <a href="../b3-22-feb-team-a5/tasks/done.php">laat alle taken zien met status done</a>
         <div class="done">

<?php
    require_once 'backend/conn.php';
     if ($dtf == 'alle')
    {
     $query = "SELECT * FROM taken WHERE status = 'done' ORDER BY deadline";
    $statement = $conn->prepare($query);
    $statement->execute();
    } 
      elseif($dtf == 'my_tasks')
{

    $query = "SELECT * FROM taken WHERE status = 'done' AND user = :user ORDER BY deadline ";
    $statement = $conn->prepare($query);
    $statement->execute([":user" => $_SESSION['user_id']]);
}
 else
    {
        $query = "SELECT * FROM taken WHERE status = 'done' AND afdeling = :dtf ORDER BY deadline ";
        $statement = $conn->prepare($query);
        $statement->execute([":dtf" => $dtf]);
    }
   
   
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
        <?php $date = date_create($taak['deadline']);?> <td><?php   echo date_format($date,"d/m/Y"); ?></td>
        <td><a href="tasks/edit.php?id=<?php echo $taak ['id'];?>">edit </a></td>
        <td><a href="tasks/edit.php?id=<?php echo $taak ['id'];?>">delete </a></td>
</tr>
<?php endforeach ?>
</table>




        </div>
    </div>




</div>


</body>

<?php require_once 'footer.php'; ?>
</html>
