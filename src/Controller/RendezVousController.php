<?php
namespace App\Controller;

use App\Entity\DemandeRendezVous;
use App\Form\DemandeType;
use App\Repository\DemandeRendezVousRepository;
use App\Repository\PatientRepository;
use App\Service\RendezVousService;
use App\Enum\StatutDemande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RendezVousController extends AbstractController
{
    #[Route('/', name: 'app_rdv_new')]
    public function new(Request $request, RendezVousService $service, PatientRepository $patientRepo): Response 
    {
        $demande = new DemandeRendezVous();
        $patient = $patientRepo->findOneBy([]); 

        if (!$patient) {
            return new Response("Erreur : Aucun patient en base.");
        }

        $demande->setPatient($patient);
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->enregistrerDemande($demande);
            return $this->redirectToRoute('app_rdv_liste');
        }

        return $this->render('rendez_vous/new.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient
        ]);
    }

    #[Route('/secretaire/demandes', name: 'app_rdv_liste')]
    public function liste(Request $request, DemandeRendezVousRepository $repo): Response
    {
        $etat = $request->query->get('etat');
        $demandes = $etat ? $repo->findBy(['statut' => StatutDemande::tryFrom($etat)]) : $repo->findAll();

        return $this->render('rendez_vous/liste.html.twig', [
            'demandes' => $demandes,
            'etat_actuel' => $etat
        ]);
    }

    #[Route('/secretaire/valider/{id}', name: 'app_rdv_valider')]
    public function valider(DemandeRendezVous $demande, RendezVousService $service): Response
    {
        $demande->setStatut(StatutDemande::VALIDEE);
        $service->mettreAJour();
        return $this->redirectToRoute('app_rdv_liste');
    }
}