<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="boolean")
     */
    private $available;
    // statut de la mission

    /**
     * @ORM\Column(type="text", length=256)
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Application", mappedBy="mission", orphanRemoval=true)
     */
    private $applications;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->available = true;
        $this->applications = new ArrayCollection();
    }
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

    public function getAvailable(){
        return $this->available;
    }

    public function setAvailable($available){
        $this->available = $available;
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

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setMission($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->contains($application)) {
            $this->applications->removeElement($application);
            // set the owning side to null (unless already changed)
            if ($application->getMission() === $this) {
                $application->setMission(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->title;
    }
}
