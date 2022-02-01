<?php

namespace Models;

class Comment extends Model
{
    protected $table = "comment";

    /**
     * Retourne la liste des commentaires d'un article
     * 
     * @param integer $id_article
     * @param integer $state
     * @return array
     */

    public function findAllWithArticle(int $id_article, int $state): array
    {
        $query = $this->pdo->prepare('SELECT *, c.id as id_comment, DATE_FORMAT(created_at, "%d/%m/%Y") as formated_created_at FROM comment c, user u WHERE c.id_article = :id_article AND c.id_user = u.id AND state = :state ORDER BY c.id DESC');
        $query->execute(compact('id_article', 'state'));
        $commentaires = $query->fetchAll();

        return $commentaires;
    }

    /**
     * Retourne la liste des commentaires d'un article
     * 
     * @param integer $id_article
     * @return void
     */

    public function deleteAllWithArticle(int $id_article): void
    {
        $query = $this->pdo->prepare('DELETE FROM comment WHERE id_article = :id_article');
        $query->execute(compact('id_article'));
    }

    public function findAllComment(int $state): array
    {
        $query = $this->pdo->prepare('SELECT *, c.id as id_comment, DATE_FORMAT(created_at, "%d/%m/%Y") as formated_created_at FROM comment c, user u WHERE c.id_user = u.id AND state = :state');
        $query->execute(compact('state'));
        $commentaires = $query->fetchAll();

        return $commentaires;
    }

    /**
     * Insére un article dans la base de donnée
     * 
     * @param integer $id_article
     * @param string $content
     * @param integer $id_user
     * @return void
     */

    public function insert(int $id_article, string $content, int $id_user): void
    {
        $query = $this->pdo->prepare('INSERT INTO comment SET content = :content, created_at = NOW(), id_user = :id_user, id_article = :id_article');
        $query->execute(compact('content', 'id_user', 'id_article'));    
    }

    public function state(int $id, int $state): void
    {
        $query = $this->pdo->prepare('UPDATE comment SET state = :state WHERE id = :id');
        $query->execute(compact('id', 'state'));    
    }

}