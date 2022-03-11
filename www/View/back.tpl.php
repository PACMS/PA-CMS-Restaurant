<?php 
session_start(
    [
        'cookie_lifetime' => 86400,
        'read_and_close' => true
    ]
); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Template du back</title>
    <meta name="description" content="ceci est une super page">
</head>
<body>

    <?php include $this->view.".view.php";?>


</body>
</html>