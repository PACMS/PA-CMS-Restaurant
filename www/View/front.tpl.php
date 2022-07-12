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
    <title><?php echo $title ?? "Titre par défaut" ?></title>
    <meta name="description" content="<?php echo $description ?? 'Page du restaurant' ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/www/../public/dist/main.css">
    <link rel="stylesheet" href="/www/..<?php echo $_SESSION['theme']['path']; ?>dist/main.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="/www/../public/dist/main.js"></script>
    <script src="<?php echo $_SESSION['theme']['path']; ?>dist/main.js"></script>
</head>

<body>
    <style>
        h1 {
            color: <?php echo $_SESSION['theme']['h1']; ?>
        }
        h2 {
            color: <?php echo $_SESSION['theme']['h2']; ?>
        }
        h3 {
            color: <?php echo $_SESSION['theme']['h3']; ?>
        }
        p {
            color: <?php echo $_SESSION['theme']['p']; ?>
        }
    </style>
    
    <?php 

        empty($this->_flashType) ?: include "View/flash.tpl.php";
        require $this->_view . ".view.php"; 
    ?>

</body>

</html>