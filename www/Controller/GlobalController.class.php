<?php

namespace App\Controller;

use App\Core\View;
use App\Model\User as UserModel;
use App\Model\Page as PageModel;
use App\Core\Verificator;
use SimpleXMLElement;

/**
 * Global controller
 * 
 * @category Controller
 * 
 * @package App\Controller
 *
 * @access public
 * 
 * @author PACMS <pa.cms.test@gmail.com>
 * 
 */
class GlobalController
{
    /**
     * Setup
     *
     * @return void
     */
    function setup()
    {
        if (file_exists('conf.inc.php')) {
            http_response_code(404);
            new View('error404', 'back');
            die();
        }

        new View('setup-config','back');

        if(!empty($_POST)) {

            // Test connexion à la base de données
            try {
                $pdo = new \PDO(
                    $_POST['driver'] .
                    ":host=" . $_POST['host'] .
                    ";port=" . $_POST['port'] .
                    ";dbname=" . $_POST['name'],
                    $_POST['user'],
                    $_POST['password'],
                    [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]
                );
            } catch (\Exception $e) {
                header('Location: /setup?step=1&error=Les identifiants ne sont pas bons');
                die("Erreur SQL : " . $e->getMessage());
            }

            // Créer le fichier de conf
            $config_file = file('conf.inc-sample.php');
            foreach ( $config_file as $line_num => $line ) {
                preg_match( '/^define\(\s*\'([A-Z_]+)\',([ ]+)/', $line, $match );
                switch($match[1]) {
                    case 'DBDRIVER':
                        $config_file[ $line_num ] = "define('" . $match[1] . "', '" . $_POST['driver'] . "');\r\n";
                        break;
                    case 'DBUSER':
                        $config_file[ $line_num ] = "define('" . $match[1] . "', '" . $_POST['user'] . "');\r\n";
                        break;
                    case 'DBPWD':
                        $config_file[ $line_num ] = "define('" . $match[1] . "', '" . $_POST['password'] . "');\r\n";
                        break;
                    case 'DBHOST':
                        $config_file[ $line_num ] = "define('" . $match[1] . "', '" . $_POST['host'] . "');\r\n";
                        break;
                    case 'DBPORT':
                        $config_file[ $line_num ] = "define('" . $match[1] . "', '" . $_POST['port'] . "');\r\n";
                        break;
                    case 'DBNAME':
                        $config_file[ $line_num ] = "define('" . $match[1] . "', '" . $_POST['name'] . "');\r\n";
                        break;
                    case 'DBPREFIXE':
                        $config_file[ $line_num ] = "define('" . $match[1] . "', '" . $_POST['prefixe'] . "');\r\n";
                        break;
                    case 'REDIRECT_URI_GOOGLE':
                        $config_file[ $line_num ] = "define('" . $match[1] . "', '" . $_POST['domain_name'] . "/googleConnect');\r\n";
                        break;
                    case 'REDIRECT_URI_FACEBOOK':
                        $config_file[ $line_num ] = "define('" . $match[1] . "', '" . $_POST['domain_name'] . "/facebookConnect');\r\n";
                        break;
                }
            }
            $config_text = '';
            foreach ( $config_file as $line ) {
                $config_text .= htmlentities( $line, ENT_COMPAT, 'UTF-8' );
            }
            $file = fopen('conf.inc.php', 'w');
            foreach ( $config_file as $line ) {
                fwrite( $file, $line );
            }
            fclose($file);

            // Créer les tables de la base de données
            $requetes="";
 
            $sqlFile = file('Dump/pacms_restaurant_setup.sql'); // on charge le fichier SQL
            foreach($sqlFile as $l){ // on le lit
                if (substr(trim($l),0,2)!="--") { // suppression des commentaires
                    $requetes .= $l;
                }
            }
            $reqs = explode(";",$requetes);// on sépare les requêtes
            foreach($reqs as $req){	// et on les éxécute
                if (trim($req)!="") {
                    if(!$pdo->query($req)) {
                        die("ERROR : ".$req); // stop si erreur 
                    };
                }
            }

            header('Location: /setupAdmin');
        }
    }

    function setupAdmin()
    {
        $view = new View('setup-admin', 'back');
        $user = new UserModel;
        if (!empty($user->getAll())) {
            http_response_code(404);
            new View('error404', 'back');
            die();
        }
        $view->assign('user', $user);
    }

    /**
     * Setup action
     *
     * @return void
     */
    function setupAction()
    {
        $user = new UserModel;
        $errors = null;

        $errors = Verificator::checkForm($user->getAdminRegisterForm(), $_POST + $_FILES);
        if(!$errors) {
            $user->hydrate($_POST);
            $user->setRole('admin');
            $user->setStatus(1);
            $user->save();
            
            header('Location: /login');
        }
    }

    /**
     * Sitemap human readable
     *
     * @return void
     */
    function sitemap()
    {
        $protocol = $_SERVER['SERVER_PORT'] == '443' ? 'https' : 'http';
        $domain = $_SERVER['HTTP_HOST'];

        $page = new PageModel();
        $pages = $page->getAllPages();

        $view = new View('sitemap', 'back');
        $view->assign('protocol', $protocol);
        $view->assign('domain',$domain);
        $view->assign('pages',$pages);
    }

    /**
     * Sitemap XML
     *
     * @return void
     */
    function sitemapXML()
    {
        $protocol = $_SERVER['SERVER_PORT'] == '443' ? 'https' : 'http';
        $domain = $_SERVER['HTTP_HOST'];

        $page = new PageModel();
        $pages = $page->getAllPages();

        header('Content-Type: text/xml; charset=UTF-8');
        $xmlstr = <<<XML
        <?xml version="1.0" encoding="UTF-8"?>

        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        <url>
            <loc>$protocol://$domain/login</loc>
            <lastmod>2022-07-01 00:00:00</lastmod>
        </url>
        <url>
            <loc>$protocol://$domain/register</loc>
            <lastmod>2022-07-01 00:00:00</lastmod>
        </url>
        <url>
            <loc>$protocol://$domain/lostPassword</loc>
            <lastmod>2022-07-01 00:00:00</lastmod>
        </url>
        XML;

        foreach ($pages as $page) {
            $xmlstr .= <<<XML
            <url>
                <loc>$protocol://$domain/$page->url</loc>
                <lastmod>$page->updated_at</lastmod>
            </url>
            XML;
        }

        $xmlstr .= <<<XML
        </urlset> 
        XML;

        $sitemapXML = new SimpleXMLElement($xmlstr);
        echo($sitemapXML->asXML());
    }
}