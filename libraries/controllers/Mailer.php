<?php

namespace Controllers;

require_once('libraries/autoload.php');

class Mailer extends Controller
{

    protected $modelName = \Models\Mailer::class;

    public function send()
    {
        $first_name = null;

        if (!empty($_POST['first_name'])){
            $first_name = htmlspecialchars($_POST['first_name']);
        }

        $name = null;

        if (!empty($_POST['name'])){
            $name = htmlspecialchars($_POST['name']);
        }

        $email = null;

        if (!empty($_POST['email'])){
            $email = htmlspecialchars($_POST['email']);
        }

        $content = null;

        if (!empty($_POST['content'])){
            $content = htmlspecialchars($_POST['content']);
        }

        if (!$first_name || !$name || !$email || !$content){
            throw \Controllers\Router::error('danger', "Vous n\'avez pas rempli le formulaire correctement, le mail n'a pas pu être envoyé !");
        }

        $this->model->send($first_name, $name, $email, $content);
    }
}