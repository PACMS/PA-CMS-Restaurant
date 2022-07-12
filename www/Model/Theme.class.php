<?php

namespace App\Model;

use App\Core\Cleaner;
use App\Core\Sql;

/**
 * Class Themes
 * 
 * @category Model
 * 
 * @package App\Model
 *
 * @since 2.0
 */
class Theme extends Sql
{

    /**
     * The id of the theme
     * 
     * @var null|int
     */
    protected $id = null;

    /**
     * The name of the theme
     * 
     * @var string
     */
    protected $name;

    /**
     * The slug of the theme
     * 
     * @var string
     */
    protected $slug;

    /**
     * The path of the theme
     * 
     * @var null|string
     */
    protected $path = null;

    /**
     * The font of the theme
     *
     * @var string
     */
    protected $font;

    /**
     * The color of the h1
     *
     * @var string
     */
    protected $h1;

    /**
     * The color of the h2
     *
     * @var string
     */
    protected $h2;

    /**
     * The color of the h3
     *
     * @var string
     */
    protected $h3;

    /**
     * The color of the p
     *
     * @var string
     */
    protected $p;

    /**
     * Themes constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the id of the theme
     * 
     * @return null|int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the name of the theme
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the slug of the theme
     * 
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the path of the theme
     * 
     * @return null|string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get the font of the theme
     * 
     * @return string
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Get the color of the h1 of the theme
     * 
     * @return string
     */
    public function getH1()
    {
        return $this->h1;
    }

    /**
     * Get the color of the h2 of the theme
     * 
     * @return string
     */
    public function geth2()
    {
        return $this->h2;
    }

    /**
     * Get the color of the h3 of the theme
     * 
     * @return string
     */
    public function getH3()
    {
        return $this->h3;
    }

    /**
     * Get the color of the p of the theme
     * 
     * @return string
     */
    public function getP()
    {
        return $this->p;
    }

    /**
     * Set the id of the theme
     * 
     * @param int $id The id of the theme
     * 
     * @return void
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * Set the name of the theme
     * 
     * @param string $name The name of the theme
     * 
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = (new Cleaner($name))->e()->value;
    }

    /**
     * Set the slug of the theme
     * 
     * @param string $slug The slug of the theme
     * 
     * @return void
     */
    public function setSlug(string $slug): void
    {
        $this->slug = (new Cleaner($slug))->lower()->value;
    }

    /**
     * Set the path of the theme
     * 
     * @param null|string $path The path of the theme
     * 
     * @return void
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * Set the font of the theme
     *
     * @param string $font
     * @return void
     */
    public function setFont(string $font): void
    {
        $this->font = $font;
    }

    /**
     * Set the color of the h1
     * 
     * @param string $slug The color of the h1
     * 
     * @return void
     */
    public function setH1(string $h1): void
    {
        $this->h1 = $h1;
    }

    /**
     * Set the color of the h1
     * 
     * @param string $slug The color of the h1
     * 
     * @return void
     */
    public function setH2(string $h2): void
    {
        $this->h2 = $h2;
    }

    /**
     * Set the color of the h1
     * 
     * @param string $slug The color of the h1
     * 
     * @return void
     */
    public function setH3(string $h3): void
    {
        $this->h3 = $h3;
    }

    /**
     * Set the color of the h1
     * 
     * @param string $slug The color of the h1
     * 
     * @return void
     */
    public function setP(string $p): void
    {
        $this->p = $p;
    }

    /**
     * Get all themes
     * 
     * @return array
     */
    public function getAllThemes(): array
    {
        return parent::getAll();
    }

    /**
     * Get a theme by its id
     * 
     * @param int $id The id of the theme
     * 
     * @return array
     */
    public function getThemeById(int $id)
    {
        return parent::findOneBy(['id' => $id]);
    }
}
