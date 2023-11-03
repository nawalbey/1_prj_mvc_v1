<?php

namespace Model\Repository;

use Model\Entity\User;
use Service\Session;

class UserRepository extends BaseRepository
{
    public function findByPseudo($pseudo)
    {
        $requete = $this->dbConnection->prepare("SELECT * FROM user WHERE pseudo = :pseudo");
        $requete->bindParam(":pseudo", $pseudo);

        if ($requete->execute()) {
            if ($requete->rowCount() == 1) {
                $requete->setFetchMode(\PDO::FETCH_CLASS, "Model\Entity\User");
                return $requete->fetch();
            } else {
                return false;
            }
        } else {
            return null;
        }
    }

    public function insertUser(User $user)
    {
        $sql = "INSERT INTO user (pseudo, mdp, nom, prenom) VALUES (:pseudo, :mdp, :nom, :prenom)";
        $requete = $this->dbConnection->prepare($sql);
        $requete->bindValue(":pseudo", $user->getPseudo());
        $requete->bindValue(":mdp", $user->getMdp());
        $requete->bindValue(":prenom", $user->getPrenom());
        $requete->bindValue(":nom", $user->getNom());
        $requete = $requete->execute();
        if ($requete) {
            if ($requete == 1) {
                Session::addMessage("success",  "Le nouvel utilisateur a bien été enregistré");
                return true;
            }
            Session::addMessage("danger",  "Erreur : l'utilisateur n'a pas été enregisté");
            return false;
        }
        Session::addMessage("danger",  "Erreur SQL");
        return null;
    }


    public function updateAbonne(User $user)
    {
        $sql = "UPDATE user 
                         SET pseudo = :pseudo, mdp = :mdp, prenom = :prenom, nom = :nom
                         WHERE id = :id";
        $requete = $this->dbConnection->prepare($sql);
        $requete->bindValue(":pseudo", $user->getPseudo());
        $requete->bindValue(":mdp", $user->getMdp());
        $requete->bindValue(":prenom", $user->getPrenom());
        $requete->bindValue(":nom", $user->getNom());
        $requete->bindValue(":id", $user->getId());
        $requete = $requete->execute();
        if ($requete) {
            if ($requete == 1) {
                Session::addMessage("success",  "La mise à jour de l'utilisateur a bien été éffectuée");
                return true;
            }
            Session::addMessage("danger",  "Erreur : l'utilisateur n'a pas été mise à jour");
            return false;
        }
        Session::addMessage("danger",  "Erreur SQL");
        return null;
    }
}