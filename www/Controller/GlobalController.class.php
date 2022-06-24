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