<?php

namespace JP\MaritimeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Folder
 *
 * @ORM\Table(name="folder")
 * @ORM\Entity(repositoryClass="JP\MaritimeBundle\Repository\FolderRepository")
 */
class Folder
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
     * @ORM\Column(name="folder_number", type="string", length=255)
     */
    private $folderNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="requerant", type="string", length=255)
     */
    private $requerant;

    /**
     * @var string
     *
     * @ORM\Column(name="moyentp", type="string", length=255)
     */
    private $moyentp;

     /**
     * @var string
     *
     * @ORM\Column(name="ftype", type="string", length=255)
     */
    private $ftype;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_arrive", type="datetime")
     */
    private $dateArrive;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_intervention", type="datetime")
     */
    private $dateIntervention;

    /**
     * @var string
     *
     * @ORM\Column(name="marking", type="string", nullable=true)
     */
   
    private $marking;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

      /**
    * @ORM\ManyToOne(targetEntity="JP\UserBundle\Entity\Users", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $createBy ;


      /**
    * @ORM\ManyToOne(targetEntity="JP\UserBundle\Entity\Users", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $owner ;

    /**
     * @ORM\OneToMany(targetEntity="JP\MaritimeBundle\Entity\Affectation", mappedBy="folder")
     */
    private $affectation;



    public function __construct()  {   
     $this->createdAt = new \Datetime();
     $this->marking = 'wait_expertise';
      $this->affectation = new ArrayCollection();
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
     * Set folderNumber
     *
     * @param string $folderNumber
     *
     * @return Folder
     */
    public function setFolderNumber($folderNumber)
    {
        $this->folderNumber = $folderNumber;

        return $this;
    }

    /**
     * Get folderNumber
     *
     * @return string
     */
    public function getFolderNumber()
    {
        return $this->folderNumber;
    }

    /**
     * Set requerant
     *
     * @param string $requerant
     *
     * @return Folder
     */
    public function setRequerant($requerant)
    {
        $this->requerant = $requerant;

        return $this;
    }

    /**
     * Get requerant
     *
     * @return string
     */
    public function getRequerant()
    {
        return $this->requerant;
    }

   
    /**
     * Set dateArrive
     *
     * @param \DateTime $dateArrive
     *
     * @return Folder
     */
    public function setDateArrive($dateArrive)
    {
        $this->dateArrive = $dateArrive;

        return $this;
    }

    /**
     * Get dateArrive
     *
     * @return \DateTime
     */
    public function getDateArrive()
    {
        return $this->dateArrive;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Folder
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateIntervention
     *
     * @param \DateTime $dateIntervention
     *
     * @return Folder
     */
    public function setDateIntervention($dateIntervention)
    {
        $this->dateIntervention = $dateIntervention;

        return $this;
    }

    /**
     * Get dateIntervention
     *
     * @return \DateTime
     */
    public function getDateIntervention()
    {
        return $this->dateIntervention;
    }

    
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Folder
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set marking
     *
     * @param string $marking
     *
     * @return Folder
     */
    public function setMarking($marking)
    {
        $this->marking = $marking;

        return $this;
    }

    /**
     * Get marking
     *
     * @return string
     */
    public function getMarking()
    {
        return $this->marking;
    }

    /**
     * Set createBy
     *
     * @param \JP\UserBundle\Entity\Users $createBy
     *
     * @return Folder
     */
    public function setCreateBy(\JP\UserBundle\Entity\Users $createBy)
    {
        $this->createBy = $createBy;

        return $this;
    }

    /**
     * Get createBy
     *
     * @return \JP\UserBundle\Entity\Users
     */
    public function getCreateBy()
    {
        return $this->createBy;
    }

    /**
     * Set owner
     *
     * @param \JP\UserBundle\Entity\Users $owner
     *
     * @return Folder
     */
    public function setOwner(\JP\UserBundle\Entity\Users $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \JP\UserBundle\Entity\Users
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set moyentp
     *
     * @param string $moyentp
     *
     * @return Folder
     */
    public function setMoyentp($moyentp)
    {
        $this->moyentp = $moyentp;

        return $this;
    }

    /**
     * Get moyentp
     *
     * @return string
     */
    public function getMoyentp()
    {
        return $this->moyentp;
    }

    /**
     * Set ftype
     *
     * @param string $ftype
     *
     * @return Folder
     */
    public function setFtype($ftype)
    {
        $this->ftype = $ftype;

        return $this;
    }

    /**
     * Get ftype
     *
     * @return string
     */
    public function getFtype()
    {
        return $this->ftype;
    }

    /**
     * Add affectation
     *
     * @param \JP\MaritimeBundle\Entity\Affectation $affectation
     *
     * @return Folder
     */
    public function addAffectation(\JP\MaritimeBundle\Entity\Affectation $affectation)
    {
        $this->affectation[] = $affectation;

        return $this;
    }

    /**
     * Remove affectation
     *
     * @param \JP\MaritimeBundle\Entity\Affectation $affectation
     */
    public function removeAffectation(\JP\MaritimeBundle\Entity\Affectation $affectation)
    {
        $this->affectation->removeElement($affectation);
    }

    /**
     * Get affectation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAffectation()
    {
        return $this->affectation;
    }
}
