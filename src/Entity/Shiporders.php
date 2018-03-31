<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shiporders
 *
 * @ORM\Table(name="shiporders")
 * @ORM\Entity(repositoryClass="App\Repository\ShipordersRepository")
 */
class Shiporders
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
     * @ORM\Column(name="uploadId", type="integer", nullable=true)
     */
    private $uploadId;

    /**
     * @var int
     *
     * @ORM\Column(name="orderId", type="integer", nullable=true)
     */
    private $orderId;


    /**
     * @var int
     *
     * @ORM\Column(name="personId", type="integer", nullable=true)
     */
    private $personId;

    /**
     * @var string
     *
     * @ORM\Column(name="shipTo", type="string", length=255, nullable=true)
     */
    private $shipTo;

    /**
     * @var string
     *
     * @ORM\Column(name="shipAddress", type="string", length=255, nullable=true)
     */
    private $shipAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="shipCity", type="string", length=255, nullable=true)
     */
    private $shipCity;

    /**
     * @var string
     *
     * @ORM\Column(name="shipCountry", type="string", length=255, nullable=true)
     */
    private $shipCountry;

    /**
     * @return int
     */
    public function getUploadId(): int
    {
        return $this->uploadId;
    }

    /**
     * @param int $uploadId
     */
    public function setUploadId(int $uploadId)
    {
        $this->uploadId = $uploadId;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     */
    public function setOrderId(int $orderId)
    {
        $this->orderId = $orderId;
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
     * Set personId
     *
     * @param integer $personId
     *
     * @return Shiporders
     */
    public function setPersonId($personId)
    {
        $this->personId = $personId;

        return $this;
    }

    /**
     * Get personId
     *
     * @return int
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * Set shipTo
     *
     * @param string $shipTo
     *
     * @return Shiporders
     */
    public function setShipTo($shipTo)
    {
        $this->shipTo = $shipTo;

        return $this;
    }

    /**
     * Get shipTo
     *
     * @return string
     */
    public function getShipTo()
    {
        return $this->shipTo;
    }

    /**
     * Set shipAddress
     *
     * @param string $shipAddress
     *
     * @return Shiporders
     */
    public function setShipAddress($shipAddress)
    {
        $this->shipAddress = $shipAddress;

        return $this;
    }

    /**
     * Get shipAddress
     *
     * @return string
     */
    public function getShipAddress()
    {
        return $this->shipAddress;
    }

    /**
     * Set shipCity
     *
     * @param string $shipCity
     *
     * @return Shiporders
     */
    public function setShipCity($shipCity)
    {
        $this->shipCity = $shipCity;

        return $this;
    }

    /**
     * Get shipCity
     *
     * @return string
     */
    public function getShipCity()
    {
        return $this->shipCity;
    }

    /**
     * Set shipCountry
     *
     * @param string $shipCountry
     *
     * @return Shiporders
     */
    public function setShipCountry($shipCountry)
    {
        $this->shipCountry = $shipCountry;

        return $this;
    }

    /**
     * Get shipCountry
     *
     * @return string
     */
    public function getShipCountry()
    {
        return $this->shipCountry;
    }
}

