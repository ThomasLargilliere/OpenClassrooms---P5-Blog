<?php

namespace Controllers;

require_once('libraries/autoload.php');

class Comment extends Controller
{

    protected $modelName = \Models\Comment::class;

    public function insert()
    {
        $id_article = null;
        $id_user = null;
        $content = null;

        if (!empty($_POST['id_article'])) {
            $id_article = $_POST['id_article'];
        }

        if (!empty($_POST['content'])) {
            $content = htmlspecialchars($_POST['content']);
        }

        if (isset($_SESSION['user'])){
            $id_user = $_SESSION['user'];
        }

        if (!$id_article || !$content || !$id_user){
            throw \Controllers\Router::error('danger', "Vous n'avez pas rempli le formulaire correctement ou vous n'êtes pas connecté !");
        }

        $this->model->insert($id_article, $content, $id_user);


        \Controllers\Router::message('warning', "Votre commentaire a été ajouté, il doit désormais être validé par un administrateur");
        \Http::redirect('index.php?action=article&task=read&id=' . $id_article);
    }

    public function delete()
    {
        $id_article = null;
        $id_user = null;
        $id_comment = null;

        if (!empty($_GET['id_article'])) {
            $id_article = $_GET['id_article'];
        }

        if (!empty($_GET['id'])) {
            $id_comment = $_GET['id'];
        }

        if (isset($_SESSION['user'])){
            $id_user = $_SESSION['user'];
        }

        if (!$id_article || !$id_comment || !$id_user){
            throw \Controllers\Router::error('danger', "Impossible de supprimer ce commentaire");
        }

        $userModel = new \Models\User();

        $is_admin = $userModel->isAdmin();
        $commentaire = $this->model->find($id_comment);

        if ($commentaire['id_user'] == $id_user || $is_admin == 1){
            $this->model->delete($id_comment);
        } else {
            throw \Controllers\Router::error('danger', "Vous ne pouvez pas supprimer ce commentaire");
        }

        \Controllers\Router::message('success', "Commentaire supprimé");
        \Http::redirect('index.php?action=article&task=read&id=' . $id_article);
    }

    public function valid()
    {
        $id = null;
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (!$id){
            throw \Controllers\Router::error('danger', "Aucun ID de commentaire trouvé");
        }

        $id_user = null;

        if (isset($_SESSION['user'])){
            $id_user = $_SESSION['user'];
        }

        if (!$id_user){
            throw \Controllers\Router::error('danger', "Vous devez être connecté pour valider un commentaire");
        }

        $modelUser = new \Models\User();
        $is_admin = $modelUser->isAdmin();

        if ($is_admin != 1){
            throw \Controllers\Router::error('danger', "Vous devez être administrateur pour valider un commentaire");
        }


        $this->model->state($id, 1);
        \Controllers\Router::message('success', "Commentaire validé");
        \Http::redirect('index.php?action=administration&task=valid');
    }

    public function refuse()
    {
        $id = null;
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (!$id){
            throw \Controllers\Router::error('danger', "Aucun ID de commentaire trouvé");
        }

        $id_user = null;

        if (isset($_SESSION['user'])){
            $id_user = $_SESSION['user'];
        }

        if (!$id_user){
            throw \Controllers\Router::error('danger', "Vous devez être connecté pour refuser un commentaire");
        }

        $modelUser = new \Models\User();
        $is_admin = $modelUser->isAdmin();

        if ($is_admin != 1){
            throw \Controllers\Router::error('danger', "Vous devez être administrateur pour refuser un commentaire");
        }

        $this->model->delete($id, 1);
        \Controllers\Router::message('success', "Commentaire refusé et supprimé");
        \Http::redirect('index.php?action=administration&task=valid');
    }

}