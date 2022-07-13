<?php

namespace App\Enum;

enum Role: string
{
    case admin = 'Administrateur';
    case employee = 'Employé';
    case user = 'Utilisateur';
}