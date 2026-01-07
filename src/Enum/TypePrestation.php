<?php
namespace App\Enum;

enum TypePrestation: string {
    case ANALYSE = 'Analyse';
    case ECHOGRAPHIE = 'Échographie';
    case CONSULTATION = 'Consultation';
}