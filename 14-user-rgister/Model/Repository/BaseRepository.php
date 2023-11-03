<?php

namespace Model\Repository;

use Model\Database;
use Model\Entity\BaseEntity;

class BaseRepository
{
    protected $dbConnection;

    public function __construct()
    {
        $db = new Database;
        $this->dbConnection = $db->bddConnect();
    }
    public function findAll(BaseEntity $table): ?array
    {
        $requete = $this->dbConnection->query("SELECT * FROM $table");
        if ($requete) {
            $class = "Model\Entity\\" . ucfirst($table);  // ucfirst : majuscule au début de la chaine de caractères
            return $requete->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return null;
    }

    public function findByAttributes($tableName, $attributes = [])
    {
        if (!is_array($attributes)) {
            return false; // Retourne false si le tableau d'attributs est vide ou incorrect.
        }
        // Construction de la requête SELECT
        $query = "SELECT * FROM $tableName WHERE ";

        $conditions = [];
        $values = [];

        foreach ($attributes as $column => $value) {
            $conditions[] = "$column = :$column";
            $values[":$column"] = $value;
        }

        $query .= implode(' AND ', $conditions);
        $request = $this->dbConnection->prepare($query);

        foreach ($values as $key => $val) {
            $request->bindValue($key, $val);
        }

        try {
            $request->execute();
            $class = "Model\Entity\\" . ucfirst($tableName);

            if ($request->rowCount() == 1) {
                $request->setFetchMode(\PDO::FETCH_CLASS, $class);
                return $request->fetch();
            } else if ($request->rowCount() > 1) {
                // ucfirst : majuscule au début de la chaine de caractères
                $result = $request->fetchAll(\PDO::FETCH_CLASS, $class);
                return $result;
            }
        } catch (\PDOException $exception) {
            echo "Erreur de connetion : " . $exception->getMessage();
        }
    }

    // public function insert()
    // {
    // }

    // public function update($id)
    // {
    // }

    // public function delete($id)
    // {
    // }
}