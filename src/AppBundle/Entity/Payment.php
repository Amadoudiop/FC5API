<?php

namespace AppBundle\Entity;

use AdminBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Friend
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DefaultRepository")
 */
class Payment extends AbstractEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\StoreItem")
     * @ORM\JoinColumn(nullable=false)
     */
    private $StoreItem;

    /**
     * @var date
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;


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
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Payment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user.
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Payment
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set storeItem.
     *
     * @param \AppBundle\Entity\StoreItem $storeItem
     *
     * @return Payment
     */
    public function setStoreItem(\AppBundle\Entity\StoreItem $storeItem)
    {
        $this->StoreItem = $storeItem;

        return $this;
    }

    /**
     * Get storeItem.
     *
     * @return \AppBundle\Entity\StoreItem
     */
    public function getStoreItem()
    {
        return $this->StoreItem;
    }
}
