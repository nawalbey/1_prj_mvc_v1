<?php

namespace Form;

use Service\Session;
use Model\Entity\User;
use Model\Repository\UserRepository;

class UserHandleRequest extends BaseHandleRequest
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository  = new UserRepository;
    }

    public function handleForm(User $user)
    {
        if (isset($_POST['submit'])) {

            extract($_POST);
            $errors = [];

            // Vérification de la validité du formulaire
            if (empty($pseudo)) {
                $errors[] = "Le pseudo ne peut pas être vide";
            }
            if (strlen($pseudo) < 4) {
                $errors[] = "Le pseudo doit avoir au moins 4 caractères";
            }
            if (strlen($pseudo) > 20) {
                $errors[] = "Le pseudo ne peut avoir plus de 20 caractères";
            }

            if (!strpos($pseudo, " ") === false) {
                $errors[] = "Les espaces ne sont pas autorisés pour le pseudo";
            }

            // Est-ce que le pseudo existe déjà dans la bdd ?

            // $requete = $this->userRepository->findByPseudo($pseudo);
            $requete = $this->userRepository->findByAttributes($user, ["pseudo" => $pseudo]);
            if ($requete) {
                $errors[] = "Le pseudo existe déjà, veuillez en choisir un nouveau";
            }

            if (!empty($nom)) {
                if (strlen($nom) < 2) {
                    $errors[] = "Le nom doit avoir au moins 2 caractères";
                }
                if (strlen($nom) > 30) {
                    $errors[] = "Le nom ne peut avoir plus de 30 caractères";
                }
            }
            if (!empty($prenom)) {
                if (strlen($prenom) < 2) {
                    $errors[] = "Le prénom doit avoir au moins 2 caractères";
                }
                if (strlen($prenom) > 30) {
                    $errors[] = "Le prénom ne peut avoir plus de 30 caractères";
                }
            }
            if (empty($mdp)) {
                $errors[] = "Le mot de passe ne peut pas être vide";
            }

            if (empty($errors)) {
                $user->setMdp(password_hash($mdp, PASSWORD_DEFAULT));
                $user->setPseudo($pseudo);
                $user->setNom($nom);
                $user->setPrenom($prenom);
                return true;
            }

            $this->setEerrorsForm($errors);
        }
    }

    public function handleUpdate($id)
    {
    }
}