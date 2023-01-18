<?php  
session_start();
require_once '../backend/config.php'; 
if (!isset($_SESSION['user_id']))
{
$msg = "Je moet eerst inloggen!";

header("Location:". $base_url ."/inlog.php");
exit;
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title>takenlijst / taken / Aanpassen</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>

<div class="editcontainer">
        <h1>taken aanpassen</h1>

        <?php
       
        $id = $_GET['id']; 

        require_once '../backend/conn.php';


        $query = "SELECT * FROM taken WHERE id = :id";

        
        $statement = $conn->prepare($query);

        
        $statement->execute([
            ":id" => $id
        ]);

        //5. Ophalen gegevens, tip: gebruik hier fetch().
        $taak = $statement->fetch(PDO::FETCH_ASSOC);

        ?>


                <form action="../backend/tasksController.php" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $taak['id']; ?>">

            <div class="edit-form-group">
                <label for="content_task">titel:</label>
                <textarea name="title_task" id="title_task" class="form-input" ><?php echo $taak['titel']; ?></textarea>
            </div>
            <div class="edit-form-group">

                <label for="content_task">beschrijving:</label>
                <textarea name="content_task" id="content_task" class="form-input" ><?php echo $taak['beschrijving']; ?></textarea>
            </div>

             <div class="edit-form-group">

                <label for="content_task">afdeling:</label>
                <select   name="department_task" id="department_task" ><?php echo $taak['afdeling']; ?> 
                    <option value="personeel">personeel</option>
                    <option value="horeca">horeca</option>
                    <option value="techniek">techniek</option>
                    <option value="inkoop">inkoop</option>
                    <option value="klantenservice">klantenservice</option>
                    <option value="groen">groen</option>
                </select> 
            </div>

            <div class="edit-form-group">

                <label for="status_task">status:</label>
                <select   name="status_task" id="status_task" ><?php echo $taak['status']; ?> 
                 
                    <option value="to do">to do</option>
                    <option value="in progress">in progress</option>
                    <option value="done">done</option>
                </select> 
            </div>

            <div class="edit-form-group">
               <label for="">Deadline:</label>
                <input type="date" name="event_dt"  class="form-input">
            </div>

            <input type="submit" value="aanpassing">
        </form>
<form action="../backend/tasksController.php" method="POST">
              <input type="submit" value="verwijderen">
    <input type="hidden" name="id" value="<?php echo $taak['id']; ?>">
    <input type="hidden" name="action" value="delete">
    
        </form>



