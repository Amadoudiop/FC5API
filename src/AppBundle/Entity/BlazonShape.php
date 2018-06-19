<?php

namespace AppBundle\Entity;

use AdminBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * BlazonShape
 *
 * @ORM\Table(name="blazon_shape")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DefaultRepository")
 */
class BlazonShape extends AbstractEntity
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
     * @return BlazonShape
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
     * @return BlazonShape
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
