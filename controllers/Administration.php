<?php

namespace Controllers;
class Administration
{
    public function index()
    {
        $modelUser = new \Models\User();
        $is_admin = $modelUser->isAdmin();

        if (!$is_admin){
            throw \Controllers\Router::error('danger', "Vous n'êtes pas administrateur");
        }
        $pageTitle = "Administration";
        \Renderer::render('administration', compact('pageTitle'));
    }

    public function valid()
    {
        $modelUser = new \Models\User();
        $is_admin = $modelUser->isAdmin();

        if (!$is_admin){
            throw \Controllers\Router::error('danger', "Vous n'êtes pas administrateur");
        }

        $commentModel = new \Models\Comment();

        $pageTitle = "Validation des commentaires";
        $commentaires = $commentModel->findAllComment(0);
        \Renderer::render('adminComment', compact('pageTitle', 'commentaires'));
    }

    public function article()
    {
        $modelUser = new \Models\User();
        $is_admin = $modelUser->isAdmin();

        if (!$is_admin){
            throw \Controllers\Router::error('danger', "Vous n'êtes pas administrateur");
        }

        $articleModel = new \Models\Article();
        $articles = $articleModel->findAll('created_at DESC');

        $pageTitle = "Articles";
        \Renderer::render('adminArticle', compact('pageTitle', 'articles'));
    }

    public function user()
    {
        $modelUser = new \Models\User();
        $is_admin = $modelUser->isAdmin();

        if (!$is_admin){
            throw \Controllers\Router::error('danger', "Vous n'êtes pas administrateur");
        }

        $modelRole = new \Models\Role();

        $users = $modelUser->findAll();
        $roles = $modelRole->findAll();

        $pageTitle = "Utilisateurs";
        \Renderer::render('adminUser', compact('pageTitle', 'users', 'roles'));
    }

    public function writeArticle()
    {
        $modelUser = new \Models\User();
        $is_admin = $modelUser->isAdmin();

        if (!$is_admin){
            throw \Controllers\Router::error('danger', "Vous n'êtes pas administrateur");
        }

        $pageTitle = "Ecrire un article";
        \Renderer::render('writeArticle', compact('pageTitle'));
    }

    public function updateArticle()
    {
        $modelUser = new \Models\User();
        $is_admin = $modelUser->isAdmin();

        if (!$is_admin){
            throw \Controllers\Router::error('danger', "Vous n'êtes pas administrateur");
        }

        $id_article = null;
        if (!empty($_GET['id'])){
            $id_article = $_GET['id'];
        }

        if (!$id_article){
            throw \Controllers\Router::error('Aucun ID d\'article trouvé', "<a href='index.php?action=administration&task=article'>Retourner aux articles</a>");
        }

        $articleModel = new \Models\Article();

        $pageTitle = "Modifier un article";
        $article = $articleModel->find($id_article);
        \Renderer::render('updateArticle', compact('pageTitle', 'article'));

    }

    public function updateUser()
    {
        $userModel = new \Models\User();
        $is_admin = $userModel->isAdmin();

        if (!$is_admin){
            throw \Controllers\Router::error('danger', "Vous n'êtes pas administrateur");
        }

        $id_user = null;
        if (!empty($_GET['id'])){
            $id_user = $_GET['id'];
        }

        if (!$id_user){
            throw \Controllers\Router::error('danger', "Aucun ID utilisateur trouvé");
        }

        $roleModel = new \Models\Role();

        $pageTitle = "Modifier un utilisateur";
        $user = $userModel->find($id_user);
        $roles = $roleModel->findAll();
        \Renderer::render('updateUser', compact('pageTitle', 'user', 'roles'));

    }
}