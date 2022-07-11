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
    <title><?php echo $title ?? "Back Office" ?></title>
    <meta name="description" content="<?php echo $description ?? 'Page du Back Office' ?>">
    <link rel="icon" type="image/png" href="public/assets/img/default.jpg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/public/dist/main.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <script src="/public/dist/main.js"></script>
    <script src="https://cdn.tiny.cloud/1/x097ae8kmj8kmt3uq09nu1ackibcgjm2cep2a2d8t09uxz4c/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body>


    <?php 
        empty($this->_flashType) ?: include "View/flash.tpl.php";
        require $this->_view . ".view.php"; 
    ?>


</body>

</html>

