<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MissionRepository")
 */
class Mission
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=256)
     */
    private $title;
    // titre

    /**
     * @ORM\Column(type="text", length=50)
     */
    private $status;
    // statut de la mission

    /**
     * @@ORM\Column(type="text", length=256)
     */
    private $cdp;
    // chef de projet

    /**
     * @ORM\Column(type="text", length=256)
     */
    private $domain;
    // domaine académique: physique, si, informatique

    /**
     * @ORM\Column(type="date")
     */
    private $date;
    // date d'ajout (éventuellement date de dernière modification)

    /**
     * @ORM\Column(type="text", length=2048)
     */
    private $body;
    // le descriptif

    // Getters and setters

    public function getBody(){
        return $this->body;
    }

    public function setBody($body){
        $this->body = $body;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function getDomain(){
        return $this->domain;
    }

    public function setDomain($domain){
        $this->domain = $domain;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getCdp(){
        return $this->cdp;
    }

    public function setCdp($cdp){
        $this->cdp = $cdp;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
