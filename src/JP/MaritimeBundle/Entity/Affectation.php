<?php

namespace JP\MaritimeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectation
 *
 * @ORM\Table(name="affectation")
 * @ORM\Entity(repositoryClass="JP\MaritimeBundle\Repository\AffectationRepository")
 */
class Affectation
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
     * @var string
     *
     * @ORM\Column(name="etape", type="string", length=255)
     */
    private $etape;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateheure", type="datetime")
     */
    private $dateheure;

     /**
    * @ORM\ManyToOne(targetEntity="JP\UserBundle\Entity\Users", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $user ;

    /**
    * @ORM\ManyToOne(targetEntity="JP\MaritimeBundle\Entity\Folder", cascade={"persist"},inversedBy="affectation")
    * @ORM\JoinColumn(nullable=false)
    */
    private $folder ;



    public function __construct()  {   
     $this->dateheure = new \Datetime();
    
 }
 


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set etape
     *
     * @param string $etape
     *
     * @return Affectation
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * Get etape
     *
     * @return string
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set dateheure
     *
     * @param \DateTime $dateheure
     *
     * @return Affectation
     */
    public function setDateheure($dateheure)
    {
        $this->dateheure = $dateheure;

        return $this;
    }

    /**
     * Get dateheure
     *
     * @return \DateTime
     */
    public function getDateheure()
    {
        return $this->dateheure;
    }

    /**
     * Set user
     *
     * @param \JP\UserBundle\Entity\Users $user
     *
     * @return Affectation
     */
    public function setUser(\JP\UserBundle\Entity\Users $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \JP\UserBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set folder
     *
     * @param \JP\MaritimeBundle\Entity\Folder $folder
     *
     * @return Affectation
     */
    public function setFolder(\JP\MaritimeBundle\Entity\Folder $folder)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Get folder
     *
     * @return \JP\MaritimeBundle\Entity\Folder
     */
    public function getFolder()
    {
        return $this->folder;
    }
}
