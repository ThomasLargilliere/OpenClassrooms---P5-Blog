<?php

namespace Controllers;

require_once('libraries/autoload.php');

class Article extends Controller
{

    protected $modelName = \Models\Article::class;

    public function index()
    {
        $articles = $this->model->findAll('created_at DESC');
        $pageTitle = "Liste des articles";
        \Renderer::render('listArticles', compact('pageTitle', 'articles'));
    }

    public function read()
    {
        $commentModel = new \Models\Comment();
        
        $article_id = null;
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }
        if (!$article_id) {
            throw \Controllers\Router::error('Aucun ID d\'article trouvé', "<a href='index.php?action=article&task=index'>Liste des articles</a>");
        }


        $is_admin = 0;
        if (isset($_SESSION['user'])){
            $userModel = new \Models\User();
            $is_admin = $userModel->isAdmin();
        }
        $article = $this->model->find($article_id);
        $commentaires = $commentModel->findAllWithArticle($article_id, 1);
        $author = $this->model->author($article_id);

        $pageTitle = $article['title'];
        \Renderer::render('readArticle', compact('pageTitle', 'article', 'commentaires', 'article_id', 'author', 'is_admin'));
    }

    public function write()
    {
        $title = null;
        $chapo = null;
        $content = null;

        if (!empty($_POST['title'])){
            $title = htmlspecialchars($_POST['title']);
        }

        if (!empty($_POST['chapo'])){
            $chapo = htmlspecialchars($_POST['chapo']);
        }

        if (!empty($_POST['content'])){
            $content = htmlspecialchars($_POST['content']);
        }

        if (!$title || !$chapo || !$content){
            throw \Controllers\Router::error('danger', "Veuillez remplir le formulaire correctement");
        }

        $id_user = null;

        if (isset($_SESSION['user'])){
            $id_user = $_SESSION['user'];
        }

        if (!$id_user){
            throw \Controllers\Router::error('danger', "Vous n'êtes pas connecté");
        }

        $modelUser = new \Models\User();
        $is_admin = $modelUser->isAdmin();

        if (!$is_admin == 1){
            throw \Controllers\Router::error('danger', "Vous n'avez pas le droit d'écrire un article");
        }

        $this->model->insert($title, $chapo, $content);
        \Controllers\Router::message('success', "L'article a bien été ajouté");
        \Http::redirect('index.php?action=administration&task=article');
    }

    public function delete()
    {
        $id_article = null;
        $id_user = null;
        
        if (!empty($_GET['id'])){
            $id_article = $_GET['id'];
        }

        if (isset($_SESSION['user'])){
            $id_user = $_SESSION['user'];
        }

        if (!$id_article || !$id_user){
            throw \Controllers\Router::error('danger', "Impossible de supprimer cet article");
        }

        $modelUser = new \Models\User();
        $is_admin = $modelUser->isAdmin();

        if ($is_admin == 1){
            $commentModel = new \Models\Comment();
            $commentModel->deleteAllWithArticle($id_article);
            $this->model->delete($id_article);
        } else {
            throw \Controllers\Router::error('danger', "Vous n'avez pas la permission de faire cela");
        }
        \Controllers\Router::message('success', "Article supprimé");
        \Http::redirect('index.php?action=administration&task=article');
    }

    public function update()
    {
        $title = null;
        $chapo = null;
        $content = null;
        $id_article = null;

        if (!empty($_POST['title'])){
            $title = htmlspecialchars($_POST['title']);
        }

        if (!empty($_POST['chapo'])){
            $chapo = htmlspecialchars($_POST['chapo']);
        }

        if (!empty($_POST['content'])){
            $content = htmlspecialchars($_POST['content']);
        }

        if (!empty($_GET['id'])){
            $id_article = htmlspecialchars($_GET['id']);
        }

        if (!$title || !$chapo || !$content || !$id_article){
            throw \Controllers\Router::error('danger', "Veuillez remplir le formulaire correctement");
        }

        $id_user = null;

        if (isset($_SESSION['user'])){
            $id_user = $_SESSION['user'];
        }

        if (!$id_user){
            throw \Controllers\Router::error('danger', "Vous n'êtes pas connecté");
        }

        $modelUser = new \Models\User();
        $is_admin = $modelUser->isAdmin();

        if (!$is_admin == 1){
            throw \Controllers\Router::error('danger', "Vous n'avez pas le droit de modifier un article");
        }

        $this->model->update($title, $chapo, $content, $id_article);
        \Controllers\Router::message('success', "L'article a bien été modifié");
        \Http::redirect('index.php?action=administration&task=article');
    }
}