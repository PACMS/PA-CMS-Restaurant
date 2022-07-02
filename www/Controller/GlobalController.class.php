<?php

namespace App\Controller;

use App\Core\View;
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
                }
            }
            $config_text = '';
            foreach ( $config_file as $line ) {
                $config_text .= htmlentities( $line, ENT_COMPAT, 'UTF-8' );
            }
            $file = fopen('conf.inc-test.php', 'w');
            foreach ( $config_file as $line ) {
                fwrite( $file, $line );
            }
            fclose($file);

            // Créer les tables de la base de données
            $requetes="";
 
            $sqlFile = file('Dump/mvcdocker22.sql'); // on charge le fichier SQL
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

            header('Location: /setup?step=3');
        }
    }

    /**
     * Setup action
     *
     * @return void
     */
    function setupAction()
    {
        dd($_POST);
        try {
            new \PDO(
                $_POST['driver'] .
                ":host=" . $_POST['address'] .
                ";port=" . $_POST['port'] .
                ";dbname=" . $_POST['name'],
                $_POST['user'],
                $_POST['password'],
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]
            );
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    /**
     * Sitemap
     *
     * @return void
     */
    function sitemap()
    {
        header('Content-Type: text/xml; charset=UTF-8');
        $xmlstr = <<<XML
        <?xml version="1.0" encoding="UTF-8"?>

        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

        <url>

            <loc>http://www.example.com/</loc>

            <lastmod>2005-01-01</lastmod>

            <changefreq>monthly</changefreq>

            <priority>0.8</priority>

        </url>

        <url>

            <loc>http://www.example.com/catalog?item=12&amp;desc=vacation_hawaii</loc>

            <changefreq>weekly</changefreq>

        </url>

        <url>

            <loc>http://www.example.com/catalog?item=73&amp;desc=vacation_new_zealand</loc>

            <lastmod>2004-12-23</lastmod>

            <changefreq>weekly</changefreq>

        </url>

        <url>

            <loc>http://www.example.com/catalog?item=74&amp;desc=vacation_newfoundland</loc>

            <lastmod>2004-12-23T18:00:15+00:00</lastmod>

            <priority>0.3</priority>

        </url>

        <url>

            <loc>http://www.example.com/catalog?item=83&amp;desc=vacation_usa</loc>

            <lastmod>2004-11-23</lastmod>

        </url>

        </urlset>
        XML;
        $sitemapXML = new SimpleXMLElement($xmlstr);
        echo($sitemapXML->asXML());
    }
}