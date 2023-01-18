<?php
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);	

$action = $_POST['action'];

if ($action == 'delete'){

$id = $_POST['id'];


	require_once 'conn.php';

	$query = "DELETE FROM taken WHERE id = :id";
	$statement = $conn->prepare($query);
	$statement->execute([  ":id" => $id   
]);
header("Location:../takenlijst.php?msg=MeldingVerwijderd");
}
if ($action == "update")
{
	$id = $_POST['id'];
 	$title_task = $_POST['title_task'];
 	
 	$content_task = $_POST['content_task'];
 	$department_task = $_POST['department_task'];
 	$status_task = $_POST['status_task'];
 	$event_dt = $_POST['event_dt'];


 	
 	



require_once 'conn.php';
$query = "UPDATE taken SET titel = :title_task, beschrijving = :content_task, afdeling = :department_task, status = :status_task, deadline = :event_dt, id = :id WHERE id = :id";
$statement = $conn->prepare($query);
$statement->execute([

":title_task" => $title_task,
":content_task" => $content_task,
":department_task" => $department_task,
":status_task" => $status_task,
":event_dt" => $event_dt,
":id" => $id

]);
header("Location:../takenlijst.php?dft=personeel");
}

if ($action == "create")
{



$title_task = $_POST['title_task'];
$content_task = $_POST['content_task'];
$department_task = $_POST['department_task'];
$status_task = $_POST['status_task'];
$event_dt = $_POST['event_dt'];









$title_task = $_POST['title_task'];
if (empty($title_task))
{
	
	$errors[] = "Vul de titel van de taak in.";
}

$content_task = $_POST['content_task'];
if (empty($content_task))
{
	
	$errors[] = "Vul de inhoudt van de taak in.";
}


$department_task = $_POST['department_task'];
if (empty($department_task))
{
	
	$errors[] = "Vul de afdeling van de taak in.";
}

$status_task = $_POST['status_task'];
if (empty($status_task))
{
	
	$errors[] = "Vul de status van de taak in.";
}

if(isset($errors))
{
	var_dump($errors);
	die();
}

require_once 'conn.php';



$query = "INSERT INTO taken (titel, beschrijving, afdeling, status, deadline, user)
VALUES(:title_task, :content_task, :department_task, :status_task, :event_dt, :user)";


$statement = $conn->prepare($query);

$statement->execute([
":title_task" => $title_task,

":content_task" => $content_task,

":department_task" => $department_task,

":status_task" => $status_task,

"event_dt" => $event_dt,

"user" => $_SESSION['user_id']

]);

$taken = $statement->fetchAll(PDO::FETCH_ASSOC);


header("Location:../takenlijst.php");
}
?>

