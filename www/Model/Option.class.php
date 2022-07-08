<?php

namespace App\Model;

use App\Core\Cleaner;
use App\Core\Sql;

/**
 * Class Option
 *
 * @category Model
 *
 * @package App\Model
 *
 * @since 2.0
 */
class Option extends Sql
{

    /**
     * The id of the option
     *
     * @var null|int
     */
    protected $id = null;

    /**
     * The name of the option
     *
     * @var string
     */
    protected $name;

    /**
     * The value of the option
     *
     * @var string
     */
    protected $value;

    /**
     * Option constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the id of the option
     *
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the name of the option
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of the option
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Set the id of the option
     *
     * @param int $id The id of the option
     * 
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Set the name of the option
     *
     * @param string $name The name of the option
     * 
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = (new Cleaner($name))->e()->value;
    }

    /**
     * Set the value of the option
     *
     * @param int $value The value of the option
     * 
     * @return void
     */
    public function setOptionId(string $value): void
    {
        $this->value = $value;
    }

    /**
     * Retrieve id by name
     * 
     * @param string $name The name of the option
     * 
     * @return null|array
     */
    public function getOptionByName(string $name): array
    {
        return parent::findOneBy(['name' => $name]);
    }
}
