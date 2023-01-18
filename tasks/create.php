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
    <title>StoringApp / Meldingen / Nieuw</title>
    <?php require_once '../head.php'; ?>
</head>

<body>
    <?php require_once '../header.php'; ?>
<h1>Nieuwe taak</h1>

<form action="../backend/tasksController.php" method="POST">
    <input type="hidden" name="action" value="create">


    <label for="title_task">titel taak:</label>
                <input type="text" name="title_task" id="title_task" class="form-input">

    <label for="content_task">beschrijving taak:</label>
                <input type="text" name="content_task" id="content_task" class="form-input">

    <label for="department_task">afdeling taak:</label>
                <select   name="department_task" id="department_task">
                    
                    <option value="personeel">personeel</option>
                    <option value="horeca">horeca</option>
                    <option value="techniek">techniek</option>
                    <option value="inkoop">inkoop</option>
                    <option value="klantenservice">klantenservice</option>
                    <option value="groen">groen</option>
                </select> 

    <label for="status_task">status taak:</label>
                <select   name="status_task" id="status_task" > 
              
                    <option value="to do">to do</option>
                    <option value="in progress">in progress</option>
                    <option value="done">done</option>
                </select> 


    <label for="">Deadline:</label>
                <input type="date" name="event_dt"  class="form-input">




    <input type="submit" value="Verstuur taak">
</body>