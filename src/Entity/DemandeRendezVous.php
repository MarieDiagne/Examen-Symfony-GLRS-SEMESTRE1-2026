<?php
namespace App\Entity;

use App\Repository\DemandeRendezVousRepository;
use App\Enum\Specialite;
use App\Enum\StatutDemande;
use App\Enum\TypePrestation;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeRendezVousRepository::class)]
class DemandeRendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateSouhaitee = null;

    #[ORM\Column(length: 255, enumType: TypePrestation::class)]
    private ?TypePrestation $typePrestation = null;

    #[ORM\Column(length: 255, enumType: Specialite::class)]
    private ?Specialite $specialite = null;

    #[ORM\Column(length: 255, enumType: StatutDemande::class)]
    private ?StatutDemande $statut = StatutDemande::EN_ATTENTE;

    #[ORM\ManyToOne(inversedBy: 'demandeRendezVouses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $patient = null;

    // Getters et Setters
    public function getId(): ?int { return $this->id; }
    public function getDateSouhaitee(): ?\DateTimeInterface { return $this->dateSouhaitee; }
    public function setDateSouhaitee(\DateTimeInterface $dateSouhaitee): static { $this->dateSouhaitee = $dateSouhaitee; return $this; }
    public function getTypePrestation(): ?TypePrestation { return $this->typePrestation; }
    public function setTypePrestation(TypePrestation $typePrestation): static { $this->typePrestation = $typePrestation; return $this; }
    public function getSpecialite(): ?Specialite { return $this->specialite; }
    public function setSpecialite(Specialite $specialite): static { $this->specialite = $specialite; return $this; }
    public function getStatut(): ?StatutDemande { return $this->statut; }
    public function setStatut(StatutDemande $statut): static { $this->statut = $statut; return $this; }
    public function getPatient(): ?Patient { return $this->patient; }
    public function setPatient(?Patient $patient): static { $this->patient = $patient; return $this; }
}