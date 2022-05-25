<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../../public/dist/main.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Thème 1</title>

    <script src="https://cdn.tiny.cloud/1/wyaqyv69y0k7lr8e2xnnyczc6vx8v1l5z7fequo0zus0a2p7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>

<?php include 'components/header.view.php' ?>

    <main>
        <?php include 'page/'.$this->view.".view.php" ?>
    </main>

<?php include 'components/footer.view.php' ?>

</body>
</html>