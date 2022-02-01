<?php

namespace Controllers;
class Router
{
    public function index()
    {
        $articleModel = new \Models\Article();
        $articles = $articleModel->findAll('created_at DESC');
        $pageTitle = "Accueil";
        \Renderer::render('home', compact('pageTitle', 'articles'));
    }

    public static function message(string $type, ?string $msgContent = "")
    {
        $_SESSION['message'] = ['type' => $type, 'msgContent' => $msgContent];
    }

    public static function error(string $type, ?string $msgContent = "Un problème est survenu", ?string $redirect = "index.php")
    {
        \Controllers\Router::message($type, $msgContent);
        \Http::redirect($redirect);
        die();
    }

}