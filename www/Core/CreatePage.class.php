<?php

namespace App\Core;

class CreatePage
{

    public function createBasicPageIndex($fp){

        $basicIndex = '
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <meta name="description" content="ceci est une super page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/dist/main.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="../../public/dist/main.js"></script>
</head>

<body>

    <h1 class="flex justify-center">Index<h1>

</body>

</html>
';
        fwrite($fp, $basicIndex);
        fclose($fp);
    }
}