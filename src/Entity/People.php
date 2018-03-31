<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * People
 *
 * @ORM\Table(name="people")
 * @ORM\Entity(repositoryClass="App\Repository\PeopleRepository")
 */
class People
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
     * @var integer
     *
     * @ORM\Column(name="uploadId", type="integer", length=255, nullable=true)
     */
    private $uploadId;

    /**
     * @var integer
     *
     * @ORM\Column(name="personId", type="integer", length=255, nullable=true)
     */
    private $personId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPersonId(): int
    {
        return $this->personId;
    }

    /**
     * @param int $personId
     */
    public function setPersonId(int $personId)
    {
        $this->personId = $personId;
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return People
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

