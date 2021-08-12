<?php

require_once("libraries/database.php");

class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = getPdo();
    }


    /**
     * Retourne la liste des articles classés par ordre decroissant de date de creation
     * 
     * @return array
     */
    public function findAll(?string $order = ""): array
    {
        $sql = "SELECT * FROM {$this->table}";

        if ($order) {
            $sql .= " ORDER BY " . $order;
        }
        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles
        $items = $resultats->fetchAll();

        return $items;
    }

    /**
     * Retourne un article en fonction de son identifiant
     * 
     * @param int $id
     * 
     * @return array
     */
    public function  find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['id' => $id]);
        // On fouille le résultat pour en extraire les données réelles de l'article
        $item = $query->fetch();

        return $item;
    }


    /**
     * Supprime un commentaire donné
     * 
     * @param int $id
     * 
     * @return void
     */
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}
