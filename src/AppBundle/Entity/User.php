<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name= "telephone" ,type="string", length=10)
     */
    private $telephone;

    /**
     * @ORM\Column(name="siteWeb", type="string", length=255)
     */
    private $siteWeb;

    /**
     * @ORM\OneToMany(targetEntity="Carnet", mappedBy="author")
     */
    private $carnets;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->telephone = "09090838302";
        $this->setSiteWeb("example.com");
        // your own logic
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     *
     * @return User
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }


    /**
     * Add carnet
     *
     * @param \AppBundle\Entity\Carnet $carnet
     *
     * @return User
     */
    public function addCarnet(\AppBundle\Entity\Carnet $carnet)
    {
        $this->carnets[] = $carnet;

        return $this;
    }

    /**
     * Remove carnet
     *
     * @param \AppBundle\Entity\Carnet $carnet
     */
    public function removeCarnet(\AppBundle\Entity\Carnet $carnet)
    {
        $this->carnets->removeElement($carnet);
    }

    /**
     * Get carnets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarnets()
    {
        return $this->carnets;
    }
}
