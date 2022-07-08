<?php

namespace App\Core;

class CreatePage
{

    public function createBasicPageIndex($fp, $inputs, $array_body){

        $page = '
    <h1 class="flex justify-center">' . $inputs['title'] . '<h1>';

        foreach ($array_body as $body){
            $page .= '<section>' . $body . '</section>';
        }



        fwrite($fp, $page);
        // fclose($fp);
    }
}