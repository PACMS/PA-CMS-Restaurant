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
    <title>Template du back</title>
    <meta name="description" content="ceci est une super page">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/public/dist/main.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <script src="/public/dist/main.js"></script>
</head>

<body>


    <?php require $this->_view . ".view.php"; ?>


</body>

</html>

