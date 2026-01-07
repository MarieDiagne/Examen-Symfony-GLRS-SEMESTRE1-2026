<?php
namespace App\Service;

use App\Entity\DemandeRendezVous;
use App\Enum\StatutDemande; 
use Doctrine\ORM\EntityManagerInterface;

class RendezVousService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function enregistrerDemande(DemandeRendezVous $demande): void
    {
        $demande->setStatut(StatutDemande::EN_ATTENTE); 
        $this->em->persist($demande);
        $this->em->flush();
    }

    public function mettreAJour(): void
    {
        $this->em->flush();
    }
}