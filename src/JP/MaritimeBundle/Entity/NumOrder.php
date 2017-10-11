<?php

namespace JP\MaritimeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NumOrder
 *
 * @ORM\Table(name="num_order")
 * @ORM\Entity(repositoryClass="JP\MaritimeBundle\Repository\NumOrderRepository")
 */
class NumOrder
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
     * @ORM\Column(name="month", type="string", length=255)
     */
    private $month;

    /**
     * @var integer
     *
     * @ORM\Column(name="numordre", type="integer", length=3)
     */
    private $order;

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
     * Set month
     *
     * @param string $month
     *
     * @return NumOrder
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

   

    /**
     * Set order
     *
     * @param integer $order
     *
     * @return NumOrder
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }
}
