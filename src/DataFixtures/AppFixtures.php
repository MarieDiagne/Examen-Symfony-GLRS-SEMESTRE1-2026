<?php

namespace App\DataFixtures;

use App\Entity\Patient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $patientsData = [
            ['nom' => 'Diallo', 'prenom' => 'Moussa', 'login' => 'diallo', 'tel' => '771002030'],
            ['nom' => 'Ndiaye', 'prenom' => 'Fatou', 'login' => 'ndiaye', 'tel' => '772003040'],
            ['nom' => 'Sow', 'prenom' => 'Amadou', 'login' => 'sow', 'tel' => '773004050'],
            ['nom' => 'Ba', 'prenom' => 'Awa', 'login' => 'ba', 'tel' => '774005060'],
        ];

        foreach ($patientsData as $data) {
            $patient = new Patient();
            $patient->setNom($data['nom'])
                    ->setPrenom($data['prenom'])
                    ->setAdresse("Dakar, Sénégal")
                    ->setTelephone($data['tel'])
                    ->setLogin($data['login'])
                    ->setPassword("pass123"); 

            $manager->persist($patient);
        }

        $manager->flush();
    }
}