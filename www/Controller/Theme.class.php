<?php

namespace App\Controller;

use App\Model\Theme as ThemeModel;
use App\Model\Option as OptionModel;

/**
 * Class Themes
 * 
 * @category Controller
 * 
 * @package App\Controller
 *
 * @since 2.0
 */
class Theme
{
    /**
     * Function to switch theme
     * 
     * @return void
     */
    public function switchTheme()
    {
        if (!$_GET['id']) {
            header('Location: /themes');
            exit;
        }
        $idTheme = $_GET['id'];

        $option = new OptionModel();
        $idOption = $option->getOptionByName('theme')['id'];

        $theme = new ThemeModel();
        $currentTheme = $theme->getThemeById($idTheme);
        if (!$currentTheme) {
            header('Location: /dashboard');
            exit;
        }

        $option->setOptionId($idTheme);
        $option->setId($idOption);
        $option->save();

        $_SESSION['theme'] = $currentTheme;
        
        header('Location: /themes'); 
    }
}
