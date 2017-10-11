<?php

namespace JP\FinanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture_item
 *
 * @ORM\Table(name="facture_item")
 * @ORM\Entity(repositoryClass="JP\FinanceBundle\Repository\Facture_itemRepository")
 */
class Facture_item
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
     * @ORM\Column(name="honoraire", type="string", length=255)
     */
    private $honoraire;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="string", length=255)
     */
    private $montant;


     /**
    * @ORM\ManyToOne(targetEntity="JP\FinanceBundle\Entity\Facture",cascade={"persist"},inversedBy="facture_item")
    * @ORM\JoinColumn(nullable=false)
    */
    private $facture;





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
     * Set honoraire
     *
     * @param string $honoraire
     *
     * @return Facture_item
     */
    public function setHonoraire($honoraire)
    {
        $this->honoraire = $honoraire;

        return $this;
    }

    /**
     * Get honoraire
     *
     * @return string
     */
    public function getHonoraire()
    {
        return $this->honoraire;
    }

    /**
     * Set montant
     *
     * @param string $montant
     *
     * @return Facture_item
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set facture
     *
     * @param \JP\FinanceBundle\Entity\Facture $facture
     *
     * @return Facture_item
     */
    public function setFacture(\JP\FinanceBundle\Entity\Facture $facture)
    {
        $this->facture = $facture;

        return $this;
    }

    /**
     * Get facture
     *
     * @return \JP\FinanceBundle\Entity\Facture
     */
    public function getFacture()
    {
        return $this->facture;
    }
}
