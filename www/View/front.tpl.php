<?php 
if (!isset($_SESSION)) {
    session_start(
        [
            'cookie_lifetime' => 86400,
            'read_and_close' => true
        ]
    ); 
} 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title??"Titre par défaut" ?></title>
    <meta name="description" content="ceci est une super page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/dist/main.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="../public/dist/main.js"></script>
</head>
<body>

    <?php require $this->view.".view.php";?>

</body>
</html>
