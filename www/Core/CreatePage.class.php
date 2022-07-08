<?php

namespace App\Core;

class CreatePage
{

    public function createBasicPageIndex($fp, $inputs, $array_body){

        $page = '
        <div class="index-header">
    <h1 >' . $inputs['title'] . '<h1></div>';

        foreach ($array_body as $body){
            $page .= '<section class="page-container">' . $body . '</section>';
        }



        fwrite($fp, $page);
        // fclose($fp);
    }
}