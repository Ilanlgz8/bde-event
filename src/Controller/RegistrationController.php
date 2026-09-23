<?php

namespace App\Controller;

use App\Entity\Etudiant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController
{
    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!$data || empty($data['email']) || empty($data['password'])) {
            return new JsonResponse(['error' => 'Email et mot de passe requis'], 400);
        }

        $etudiant = new Etudiant();
        $etudiant->setEmail($data['email']);
        $etudiant->setNom($data['nom'] ?? '');
        $etudiant->setPrenom($data['prenom'] ?? '');
        $etudiant->setUsername($data['username'] ?? $data['email']);
        $etudiant->setRoles(['ROLE_ETUDIANT']);
        $etudiant->setPassword($userPasswordHasher->hashPassword($etudiant, $data['password']));

        // validation (respecte les contraintes définies sur l'entité, ex: email unique)
        $errors = $validator->validate($etudiant);
        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $messages], 400);
        }

        $entityManager->persist($etudiant);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Compte créé avec succès'], 201);
    }
}