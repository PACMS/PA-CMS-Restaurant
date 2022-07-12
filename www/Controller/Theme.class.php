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

    /**
     * The view to configure the theme
     *
     * @param integer $id
     * @return void
     */
    public function configureThemes(int $id)
    {
        $themeModel = new ThemeModel();
        $theme = $themeModel->getThemeById($id);

        $view = new View('configure-theme', 'back');
        $view->assign('theme', $theme);
        $view->assign('title', $theme['name'] . ' - Configuration');
        $view->assign('description', 'Configuration du thème');
    }

    /**
     * The action to update the theme
     *
     * @param integer $id
     * @return void
     */
    public function updateTheme(int $id)
    {
        $themeModel = new ThemeModel();
        $themeModel->setId($id);
        $themeModel->hydrate($_POST);
        $themeModel->save();
        header('Location: /themes/configure/' . $id);
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

