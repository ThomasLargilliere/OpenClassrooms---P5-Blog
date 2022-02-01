<?php
namespace Models;

class Article extends Model
{
    protected $table = "article";

    /**
     * Retourne l'auteur d'un article grâce à son identifiant
     * 
     * @param integer $id_article
     * @return void
     */
    public function author(int $id_article)
    {
        $query = $this->pdo->prepare("SELECT pseudo FROM user u, article a WHERE a.id = :id AND a.id_user = u.id");
        $query->execute(['id' => $id_article]);
        $author = $query->fetch();
        $author = $author['pseudo'];
        return $author;
    }


    /**
     * Insère un article dans la base de données
     * 
     * @param string $title
     * @param string $chapo
     * @param string $content
     * @return void
     */
    public function insert(string $title, string $chapo, string $content): void
    {
        $id_user = $_SESSION['user'];
        $query = $this->pdo->prepare("INSERT INTO article SET title = :title, chapo = :chapo, content = :content, created_at = NOW(), id_user = :id_user");
        $query->execute(compact('title', 'chapo', 'content', 'id_user'));
    }

    /**
     * Modifier un article dans la base de données
     * 
     * @param string $title
     * @param string $chapo
     * @param string $content
     * @param integer $id_article
     * @return void
     */
    public function update(string $title, string $chapo, string $content, int $id_article): void
    {
        $id_user = $_SESSION['user'];
        $query = $this->pdo->prepare("UPDATE article SET title = :title, chapo = :chapo, content = :content, updated_at = NOW(), id_user = :id_user WHERE id = :id_article");
        $query->execute(compact('title', 'chapo', 'content', 'id_user', 'id_article'));
    }

}