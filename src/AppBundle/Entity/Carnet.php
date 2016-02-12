<?php
/**
 * Created by PhpStorm.
 * User: Lily
 * Date: 12/02/2016
 * Time: 15:50
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="carnet")
 */
class Carnet
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="User", inversedBy="carnets")
     */
    private $author;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $member;

    /**
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return Carnet
     */
    public function setAuthor(\AppBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set member
     *
     * @param \AppBundle\Entity\User $member
     *
     * @return Carnet
     */
    public function setMember(\AppBundle\Entity\User $member = null)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \AppBundle\Entity\User
     */
    public function getMember()
    {
        return $this->member;
    }
}
