<?php
/**
 * PHP version 8.1
 */
namespace App\Controller;

use App\Model\Theme as ThemeModel;
use App\Model\Option as OptionModel;
use App\Core\View;
use App\Core\Theme as Template;

/**
 * Class Theme
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

    public function render()
    {
        new View('theme');
    }

    public function home(int $id)
    {
        new Template('home');
    }

    public function story(int $id)
    {
        new Template('story');
    }

    public function menu(int $id)
    {
        new Template('menu');
    }

    public function reservation(int $id)
    {
        new Template('reservation');
    }

    public function contact(int $id)
    {
        new Template('contact');
    }
}

