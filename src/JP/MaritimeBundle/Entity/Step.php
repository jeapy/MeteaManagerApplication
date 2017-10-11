<?php

namespace JP\MaritimeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Step
 *
 * @ORM\Table(name="step")
 * @ORM\Entity(repositoryClass="JP\MaritimeBundle\Repository\StepRepository")
 */
class Step
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
     * @ORM\Column(name="step", type="string", length=255)
     */
    private $step;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createAt", type="datetime")
     */
    private $createAt;

    /**
    * @ORM\ManyToOne(targetEntity="JP\UserBundle\Entity\Users", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $user ;

    /**
    * @ORM\ManyToOne(targetEntity="JP\MaritimeBundle\Entity\Folder", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $folder ;

public function __construct()  {   
     $this->createAt = new \Datetime();
   
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
     * Set step
     *
     * @param string $step
     *
     * @return Step
     */
    public function setStep($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return string
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Step
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set user
     *
     * @param \JP\UserBundle\Entity\Users $user
     *
     * @return Step
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
     * @return Step
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
