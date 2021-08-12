<?php

/**
 * Retourne une connexion à la base de données
 * 
 * @return PDO
 */
function getPdo(): PDO
{
    return new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', 'root', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}



/* Articles */


/**
 * Retourne la liste des articles classés par ordre decroissant de date de creation
 * 
 * @return array
 */
function findAllArticles(): array
{
    $pdo = getPdo();
    $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
    // On fouille le résultat pour en extraire les données réelles
    $articles = $resultats->fetchAll();

    return $articles;
}

/**
 * Retourne un article en fonction de son identifiant
 * 
 * @param int $id
 * 
 * @return array
 */
function  findArticle(int $id)
{
    $pdo = getPdo();
    $query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
    // On exécute la requête en précisant le paramètre :article_id 
    $query->execute(['article_id' => $id]);
    // On fouille le résultat pour en extraire les données réelles de l'article
    $article = $query->fetch();

    return $article;
}

function deleteArticle(int $id): void
{
    $pdo = getPdo();
    $query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
    $query->execute(['id' => $id]);
}



/* Commentaires */

/**
 * Retourne la liste des commentaires d'un article
 * 
 * @param int $id L'id de l'article
 * 
 * @return array
 */
function findAllComments(int $id): array
{
    $pdo = getPdo();
    $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
    $query->execute(['article_id' => $id]);
    $commentaires = $query->fetchAll();

    return $commentaires;
}

/**
 * Retourne un commentaire avec son identifiant
 * 
 * @param int $id
 * 
 * @return array
 */
function findComment(int $id)
{
    $pdo = getPdo();
    $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);
    $comment = $query->fetch();

    return $comment;
}

/**
 * Supprime un commentaire donné
 * 
 * @param int $id
 * 
 * @return void
 */
function deleteComment(int $id): void
{
    $pdo = getPdo();
    $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);
}


/**
 * Insere un commentaire dans la base de données
 * 
 * @param string $author
 * @param string $content
 * @param int $article_id
 * 
 * @return void
 */
function insertComment(string $author, string $content, int $article_id): void
{
    $pdo = getPdo();
    $query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
    $query->execute(compact('author', 'content', 'article_id'));
}
