<?php

namespace App; // Définit l’espace de noms pour organiser le code de l’application.

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait; // Permet d'activer des fonctionnalités spécifiques pour une application plus légère (microservice).
use Symfony\Component\HttpKernel\Kernel as BaseKernel; // Classe de base du noyau de Symfony, responsable de la gestion de l'application.

class Kernel extends BaseKernel // Classe `Kernel` qui étend le noyau principal de Symfony.
{
    use MicroKernelTrait; // Utilise le trait `MicroKernelTrait` pour configurer une application Symfony plus légère.
}

