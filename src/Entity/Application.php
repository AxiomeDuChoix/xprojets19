<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 * @Vich\Uploadable
 */
class Application
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=1023)
     */
    private $coverletter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cv;

    /**
     * @Vich\UploadableField(mapping="application_cvs", fileNameProperty="cv")
     * @var File
     */
    private $cvFile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mission", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;

    /**
     * @ORM\Column(type="string", length=512)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cursus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getCoverletter(): ?string
    {
        return $this->coverletter;
    }

    public function setCoverletter(?string $coverletter): self
    {
        $this->coverletter = $coverletter;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function __toString(){
        return ($this->surname).' '.($this->name);
    }

    public function setCvFile(File $cv = null)
    {
        $this->cvFile = $cv;

        if ($cv){
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getCvFile(){
        return $this->cvFile;
    }

    public function getCursus(): ?string
    {
        return $this->cursus;
    }

    public function setCursus(string $cursus): self
    {
        $this->cursus = $cursus;

        return $this;
    }
}
