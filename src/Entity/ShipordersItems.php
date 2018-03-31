<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShipordersItems
 *
 * @ORM\Table(name="shiporders_items")
 * @ORM\Entity(repositoryClass="App\Repository\ShipordersItemsRepository")
 */
class ShipordersItems
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
     * @var int
     *
     * @ORM\Column(name="shiporderId", type="integer", nullable=true)
     */
    private $shiporderId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;


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
     * Set shiporderId
     *
     * @param integer $shiporderId
     *
     * @return ShipordersItems
     */
    public function setShiporderId($shiporderId)
    {
        $this->shiporderId = $shiporderId;

        return $this;
    }

    /**
     * Get shiporderId
     *
     * @return int
     */
    public function getShiporderId()
    {
        return $this->shiporderId;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ShipordersItems
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return ShipordersItems
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return ShipordersItems
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return ShipordersItems
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}

