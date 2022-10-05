<?php

namespace App\Entity;

use App\Repository\QuestionnaireRepository;
use Symfony\Component\Form\FormTypeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionnaireRepository::class)]
class Questionnaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $screens = null;

    #[ORM\Column(length: 255)]
    private ?string $xliff = null;

    #[ORM\Column(length: 255)]
    private ?string $json = null;

    #[ORM\Column(length: 255)]
    private ?string $spec = null;

    #[ORM\Column(type: 'string')]
    private $brochureFilename;

    #[ORM\Column]
    private ?bool $reviewed = null;

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

    public function getScreens(): ?string
    {
        return $this->screens;
    }

    public function setScreens(string $screens): self
    {
        $this->screens = $screens;

        return $this;
    }

    public function getXliff(): ?string
    {
        return $this->xliff;
    }

    public function setXliff(string $xliff): self
    {
        $this->xliff = $xliff;

        return $this;
    }

    public function getJson(): ?string
    {
        return $this->json;
    }

    public function setJson(string $json): self
    {
        $this->json = $json;

        return $this;
    }

    public function getSpec(): ?string
    {
        return $this->spec;
    }

    public function setSpec(string $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function isReviewed(): ?bool
    {
        return $this->reviewed;
    }

    public function setReviewed(bool $reviewed): self
    {
        $this->reviewed = $reviewed;

        return $this;
    }

    public function getBrochureFilename()
    {
        return $this->brochureFilename;
    }

    public function setBrochureFilename($brochureFilename)
    {
        $this->brochureFilename = $brochureFilename;

        return $this;
    }
}
