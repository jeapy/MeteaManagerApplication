<?php

namespace JP\FinanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity(repositoryClass="JP\FinanceBundle\Repository\FactureRepository")
 */
class Facture
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
     * @ORM\Column(name="numfacture", type="string", length=255,unique=true)
     */
    private $numfacture;

    /**
     * @var string
     *
     * @ORM\Column(name="boncommande", type="string", length=255)
     */
    private $boncommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dhcreation", type="datetime")
     */
    private $dhcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dhmodif",  type="datetime", nullable=true)
     */
    private $dhmodif;

    /**
     * @var int
     *
     * @ORM\Column(name="tva", type="integer")
     */
    private $tva;

      /**
    * @ORM\ManyToOne(targetEntity="JP\UserBundle\Entity\Users", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $createBy ;

      /**
    * @ORM\ManyToOne(targetEntity="JP\UserBundle\Entity\Users", cascade={"persist"})
    * 
    */
    private $modifyBy ;

    /**
     * @var string
     *
     * @ORM\Column(name="totalfacture", type="string", length=255)
     */
    private $totalfacture;

     /**
     *  @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="JP\FinanceBundle\Entity\Facture_item",cascade={"persist"}, mappedBy="facture")
     */
    private $facture_item;

     /**
    * @ORM\ManyToOne(targetEntity="JP\MaritimeBundle\Entity\Folder", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $folder ;


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
     * Set numfacture
     *
     * @param string $numfacture
     *
     * @return Facture
     */
    public function setNumfacture($numfacture)
    {
        $this->numfacture = $numfacture;

        return $this;
    }

    /**
     * Get numfacture
     *
     * @return string
     */
    public function getNumfacture()
    {
        return $this->numfacture;
    }

    /**
     * Set boncommande
     *
     * @param string $boncommande
     *
     * @return Facture
     */
    public function setBoncommande($boncommande)
    {
        $this->boncommande = $boncommande;

        return $this;
    }

    /**
     * Get boncommande
     *
     * @return string
     */
    public function getBoncommande()
    {
        return $this->boncommande;
    }

    /**
     * Set dhcreation
     *
     * @param \DateTime $dhcreation
     *
     * @return Facture
     */
    public function setDhcreation($dhcreation)
    {
        $this->dhcreation = $dhcreation;

        return $this;
    }

    /**
     * Get dhcreation
     *
     * @return \DateTime
     */
    public function getDhcreation()
    {
        return $this->dhcreation;
    }

   


    /**
     * Set tva
     *
     * @param integer $tva
     *
     * @return Facture
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return int
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set totalfacture
     *
     * @param string $totalfacture
     *
     * @return Facture
     */
    public function setTotalfacture($totalfacture)
    {
        $this->totalfacture = $totalfacture;

        return $this;
    }

    /**
     * Get totalfacture
     *
     * @return string
     */
    public function getTotalfacture()
    {
        return $this->totalfacture;
    }

    /**
     * Set dhmodif
     *
     * @param \DateTime $dhmodif
     *
     * @return Facture
     */
    public function setDhmodif($dhmodif)
    {
        $this->dhmodif = $dhmodif;

        return $this;
    }

    /**
     * Get dhmodif
     *
     * @return \DateTime
     */
    public function getDhmodif()
    {
        return $this->dhmodif;
    }

    /**
     * Set createBy
     *
     * @param \JP\UserBundle\Entity\Users $createBy
     *
     * @return Facture
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
     * Set modifyBy
     *
     * @param \JP\UserBundle\Entity\Users $modifyBy
     *
     * @return Facture
     */
    public function setModifyBy(\JP\UserBundle\Entity\Users $modifyBy = null)
    {
        $this->modifyBy = $modifyBy;

        return $this;
    }

    /**
     * Get modifyBy
     *
     * @return \JP\UserBundle\Entity\Users
     */
    public function getModifyBy()
    {
        return $this->modifyBy;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->facture_item = new ArrayCollection();

         $this->dhcreation = new \Datetime(); 
 
 
    }

    /**
     * Add factureItem
     *
     * @param \JP\FinanceBundle\Entity\Facture_item $factureItem
     *
     * @return Facture
     */
    public function addFactureItem(\JP\FinanceBundle\Entity\Facture_item $factureItem)
    {
        $this->facture_item[] = $factureItem;

        $factureItem->setFacture($this);

        return $this;
    }

    /**
     * Remove factureItem
     *
     * @param \JP\FinanceBundle\Entity\Facture_item $factureItem
     */
    public function removeFactureItem(\JP\FinanceBundle\Entity\Facture_item $factureItem)
    {
        $this->facture_item->removeElement($factureItem);
    }

    /**
     * Get factureItem
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFactureItem()
    {
        return $this->facture_item;
    }

    /**
     * Set folder
     *
     * @param \JP\MaritimeBundle\Entity\Folder $folder
     *
     * @return Facture
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
