<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BreweriesRepository")
 * @ORM\Table(name="breweries")
 */
class Breweries
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    /**
     * @ORM\Column(type="text")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $open;

    /**
     * @ORM\Column(type="text")
     */
    private $zipcode;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOpen;


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
     * Set address
     *
     * @param string $address
     *
     * @return Breweries
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Breweries
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Breweries
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

    /**
     * Set open
     *
     * @param string $open
     *
     * @return Breweries
     */
    public function setOpen($open)
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Get open
     *
     * @return string
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return Breweries
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function _toString()
    {
        return $this->getName();
    }

    public function setIsOpen($isOpen)
    {
        $this->isOpen = $isOpen;
    }

}
