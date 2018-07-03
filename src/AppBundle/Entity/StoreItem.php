<?php

namespace AppBundle\Entity;

use AdminBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * StoreItem
 *
 * @ORM\Table(name="store_item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DefaultRepository")
 */
class StoreItem extends AbstractEntity
{
    public static $defaultFieldOrder = "id";
    public static $defaultDirOrder = "asc";
    public static $fieldsOrder = [
        'id',
        'title',
        'value',
        'fc5Buyable'
    ];
    public static $fieldsApi = [
        'id',
        'title',
        'value',
        'fc5Buyable',
        'description',
        'image'
    ];

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=125)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float", length=10)
     */
    private $value;

    /**
     * @var bool
     *
     * @ORM\Column(name="fc5_buyable", type="boolean")
     */
    private $fc5Buyable;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return StoreItem
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set float.
     *
     * @param string $float
     *
     * @return StoreItem
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set fc5Buyable.
     *
     * @param bool $fc5Buyable
     *
     * @return StoreItem
     */
    public function setFc5Buyable($fc5Buyable)
    {
        $this->fc5Buyable = $fc5Buyable;

        return $this;
    }

    /**
     * Get fc5Buyable.
     *
     * @return bool
     */
    public function getFc5Buyable()
    {
        return $this->fc5Buyable;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return StoreItem
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image.
     *
     * @param string $image
     *
     * @return StoreItem
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
