<?php
namespace App\Enum;

enum StatutDemande: string {
    case EN_ATTENTE = 'En attente';
    case VALIDEE = 'Validée';
    case ANNULLEE = 'Annulée';
}