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
    public function getThemeById(int $id): null|array
    {
        return parent::findOneBy(['id' => $id]);
    }
}
