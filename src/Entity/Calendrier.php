<?php

namespace App\Entity;

use App\Repository\CalendrierRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendrierRepository::class)]
class Calendrier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

	#[ORM\ManyToOne(inversedBy: 'calendriers')]
	#[ORM\JoinColumn(nullable: false)]
	private ?User $calendrier_user_id = null;


	#[ORM\Column(length: 50)]
    private ?string $token = null;

    #[ORM\Column(length: 100)]
    private ?string $nom_calendrier = null;

    #[ORM\Column(length: 255)]
    private ?string $message = null;

    #[ORM\Column(length: 50)]
    private ?string $arriere_plan = null;

    #[ORM\Column(length: 6)]
    private ?string $case_couleur_fond = null;

    #[ORM\Column]
    private ?float $case_opacite = null;

    #[ORM\Column(length: 6)]
    private ?string $case_bordure_couleur = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $case_bordure_epaisseur = null;

    #[ORM\Column]
    private ?float $case_bordure_opacite = null;

    #[ORM\Column(length: 6)]
    private ?string $texte_couleur = null;

    #[ORM\Column]
    private ?float $texte_opacite = null;

    #[ORM\Column(length: 6)]
    private ?string $texte_bordure_couleur = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $texte_bordure_epaisseur = null;

    #[ORM\Column]
    private ?float $texte_bordure_opacite = null;

    #[ORM\Column(length: 50)]
    private ?string $texte_police = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_modification = null;

    public function getId(): ?int
    {
        return $this->id;
    }

	public function getCalendrierUserId(): ?User
	{
		return $this->calendrier_user_id;
	}

	public function setCalendrierUserId(?User $calendrier_user_id): static
	{
		$this->calendrier_user_id = $calendrier_user_id;

		return $this;
	}

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function getNomCalendrier(): ?string
    {
        return $this->nom_calendrier;
    }

    public function setNomCalendrier(string $nom_calendrier): static
    {
        $this->nom_calendrier = $nom_calendrier;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getArrierePlan(): ?string
    {
        return $this->arriere_plan;
    }

    public function setArrierePlan(string $arriere_plan): static
    {
        $this->arriere_plan = $arriere_plan;

        return $this;
    }

    public function getCaseCouleurFond(): ?string
    {
        return $this->case_couleur_fond;
    }

    public function setCaseCouleurFond(string $case_couleur_fond): static
    {
        $this->case_couleur_fond = $case_couleur_fond;

        return $this;
    }

    public function getCaseOpacite(): ?float
    {
        return $this->case_opacite;
    }

    public function setCaseOpacite(float $case_opacite): static
    {
        $this->case_opacite = $case_opacite;

        return $this;
    }

    public function getCaseBordureCouleur(): ?string
    {
        return $this->case_bordure_couleur;
    }

    public function setCaseBordureCouleur(string $case_bordure_couleur): static
    {
        $this->case_bordure_couleur = $case_bordure_couleur;

        return $this;
    }

    public function getCaseBordureEpaisseur(): ?int
    {
        return $this->case_bordure_epaisseur;
    }

    public function setCaseBordureEpaisseur(int $case_bordure_epaisseur): static
    {
        $this->case_bordure_epaisseur = $case_bordure_epaisseur;

        return $this;
    }

    public function getCaseBordureOpacite(): ?float
    {
        return $this->case_bordure_opacite;
    }

    public function setCaseBordureOpacite(float $case_bordure_opacite): static
    {
        $this->case_bordure_opacite = $case_bordure_opacite;

        return $this;
    }

    public function getTexteCouleur(): ?string
    {
        return $this->texte_couleur;
    }

    public function setTexteCouleur(string $texte_couleur): static
    {
        $this->texte_couleur = $texte_couleur;

        return $this;
    }

    public function getTexteOpacite(): ?float
    {
        return $this->texte_opacite;
    }

    public function setTexteOpacite(float $texte_opacite): static
    {
        $this->texte_opacite = $texte_opacite;

        return $this;
    }

    public function getTexteBordureCouleur(): ?string
    {
        return $this->texte_bordure_couleur;
    }

    public function setTexteBordureCouleur(string $texte_bordure_couleur): static
    {
        $this->texte_bordure_couleur = $texte_bordure_couleur;

        return $this;
    }

    public function getTexteBordureEpaisseur(): ?int
    {
        return $this->texte_bordure_epaisseur;
    }

    public function setTexteBordureEpaisseur(int $texte_bordure_epaisseur): static
    {
        $this->texte_bordure_epaisseur = $texte_bordure_epaisseur;

        return $this;
    }

    public function getTexteBordureOpacite(): ?float
    {
        return $this->texte_bordure_opacite;
    }

    public function setTexteBordureOpacite(float $texte_bordure_opacite): static
    {
        $this->texte_bordure_opacite = $texte_bordure_opacite;

        return $this;
    }

    public function getTextePolice(): ?string
    {
        return $this->texte_police;
    }

    public function setTextePolice(string $texte_police): static
    {
        $this->texte_police = $texte_police;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->date_modification;
    }

    public function setDateModification(\DateTimeInterface $date_modification): static
    {
        $this->date_modification = $date_modification;

        return $this;
    }

}
