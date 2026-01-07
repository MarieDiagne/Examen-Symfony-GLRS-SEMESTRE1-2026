<?php

namespace App\Enum;

enum Specialite: string {
    case GENERALISTE = 'Généraliste';
    case CARDIOLOGIE = 'Cardiologie';
    case RADIOLOGIE = 'Radiologie';
    case GYNECOLOGIE = 'Gynécologie';
}