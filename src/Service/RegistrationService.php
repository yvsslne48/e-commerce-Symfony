<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * RegistrationService
 * Service dédié à l'inscription des utilisateurs.
 * Respecte le principe SOLID Single Responsibility :
 * toute la logique d'inscription est dans ce service,
 * pas dans le controller.
 */
class RegistrationService
{
    public function __construct(
        private readonly EntityManagerInterface      $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}

    /**
     * Enregistre un nouvel utilisateur en base de données.
     * Hache le mot de passe avant la sauvegarde.
     */
    public function register(User $user, string $plainPassword): void
    {
        // Hacher le mot de passe
        $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);

        // Attribuer le rôle par défaut
        $user->setRoles(['ROLE_USER']);

        // Sauvegarder en base de données
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
