<?php

namespace AppBundle\Entity;

use AdminBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * JerseyShape
 *
 * @ORM\Table(name="jersey_shape")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DefaultRepository")
 */
class JerseyShape extends AbstractEntity
{
    public static $defaultFieldOrder = "id";
    public static $defaultDirOrder = "asc";
    public static $fieldsOrder = [
        'id',
        'premium',
    ];
    public static $fieldsApi = [
        'id',
        'svg',
        'premium',
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
     * @ORM\Column(name="svg", type="string", length=255)
     */
    private $svg;

    /**
     * @var bool
     *
     * @ORM\Column(name="premium", type="boolean")
     */
    private $premium;


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
     * Set svg.
     *
     * @param string $svg
     *
     * @return JerseyShape
     */
    public function setSvg($svg)
    {
        $this->svg = $svg;

        return $this;
    }

    /**
     * Get svg.
     *
     * @return string
     */
    public function getSvg()
    {
        return $this->svg;
    }

    /**
     * Set premium.
     *
     * @param bool $premium
     *
     * @return JerseyShape
     */
    public function setPremium($premium)
    {
        $this->premium = $premium;

        return $this;
    }

    /**
     * Get premium.
     *
     * @return bool
     */
    public function getPremium()
    {
        return $this->premium;
    }
}
