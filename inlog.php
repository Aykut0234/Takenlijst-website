<?php  require_once 'backend/config.php';?> 
<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once 'head.php'; ?>
</head>
 <?php require_once 'header.php'; ?>


<body>
    



         <div class="inlogcontainer">
        <h2>welkom op de inlogpagina van DeveloperLand vul uw wachtwoord en gebruikersnaam in om verder te gaan naar het online takenbord</h2>
         <form action="backend/loginController.php" method="POST">

            <label>Gebruikersnaam</label>

            <input type="text" name="username" id="username">
            <br>
            <label>Wachtwoord</label>
            <input type="password" name="password" id="password">

            <input type="submit" name="versturen">
    
          



        </form>


    </div>

</body>

<?php require_once 'footer.php'; ?>
</html>
