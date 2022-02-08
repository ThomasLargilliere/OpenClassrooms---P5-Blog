<?php

namespace Controllers;

require_once('libraries/autoload.php');

class User extends Controller
{

    protected $modelName = \Models\User::class;

    /**
     * Inscris l'utilisateur
     */
    public function register()
    {
        $email = null;
        $pseudo = null;
        $password = null;
        $first_name = null;
        $name = null;
        
        if (!empty($_POST['email'])) {
            $email = htmlspecialchars($_POST['email']);
        }

        if (!empty($_POST['pseudo'])) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
        }

        if (!empty($_POST['password1']) && !empty($_POST['password2'])){
            if ($_POST['password1'] != $_POST['password2']){
                throw \Controllers\Router::error('danger', "Vos mots de passes ne correspondent pas");
            }
            $password = htmlspecialchars($_POST['password1']);
        }

        if (!empty($_POST['first_name'])) {
            $first_name = htmlspecialchars($_POST['first_name']);
        }

        if (!empty($_POST['name'])) {
            $name = htmlspecialchars($_POST['name']);
        }

        if (!$email || !$pseudo || !$password || !$first_name || !$name){
            throw \Controllers\Router::error('danger', "Vous n\'avez pas rempli le formulaire correctement !");
        }

        $this->model->insert($email, $pseudo, $password, $first_name, $name);

        \Controllers\Router::message('success', 'Votre compte a bien été crée, vous pouvez désormais vous connecter');
        \Http::redirect('index.php');
    }

    /**
     * Connecte l'utilisateur
     */
    public function connect()
    {
        $email = null;
        $password = null;
        
        if (!empty($_POST['email'])) {
            $email = htmlspecialchars($_POST['email']);
        }

        if (!empty($_POST['password'])) {
            $password = htmlspecialchars($_POST['password']);
        }

        if (!$email || !$password){
            throw \Controllers\Router::error('danger', 'Vous n\'avez pas rempli le formulaire correctement !');
        }

        $this->model->connect($email, $password);
        \Controllers\Router::message('success', 'Vous êtes bien connecté');
        \Http::redirect('index.php');
    }

    public function deconnexion()
    {
        if (isset($_SESSION['user'])){
            \Controllers\Router::message('success', 'Vous êtes déconnecté');
        }
        unset($_SESSION['user']);
        \Http::redirect('index.php');
    }

    public function delete()
    {
        $id_user_del = null;
        $id_user = null;

        if (!empty($_GET['id'])) {
            $id_user_del = $_GET['id'];
        }

        if (isset($_SESSION['user'])){
            $id_user = $_SESSION['user'];
        }

        if (!$id_user_del || !$id_user){
            throw \Controllers\Router::error('danger', "Impossible de supprimer cet utilisateur");
        }

        $is_admin = $this->model->isAdmin();

        if ($is_admin == 1){
            $this->model->delete($id_user_del);
        } else {
            throw \Controllers\Router::error('danger', "Vous ne pouvez pas supprimer cet utilisateur");
        }

        \Controllers\Router::message('success', "Utilisateur supprimé");
        \Http::redirect('index.php?action=administration&task=user');
    }

    public function update()
    {
        $id = null;
        $email = null;
        $pseudo = null;
        $first_name = null;
        $name = null;
        $role = null;
        $password = null;

        if (!empty($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
        }

        if (!empty($_POST['email'])) {
            $email = htmlspecialchars($_POST['email']);
        }

        if (!empty($_POST['pseudo'])) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
        }

        if (!empty($_POST['first_name'])) {
            $first_name = htmlspecialchars($_POST['first_name']);
        }

        if (!empty($_POST['name'])) {
            $name = htmlspecialchars($_POST['name']);
        }

        if (!empty($_POST['role'])) {
            $role = htmlspecialchars($_POST['role']);
        }

        if (!empty($_POST['password'])) {
            $password = htmlspecialchars($_POST['password']);
        }

        if (!$id || !$email || !$pseudo || !$first_name || !$name || !$role){
            throw \Controllers\Router::error('danger', 'Veuillez remplir correctement le formulaire');
        }

        $is_admin = $this->model->isAdmin();

        if ($is_admin != 1){
            throw \Controllers\Router::error('danger', 'Vous devez être administrateur pour faire cela');
        }

        $this->model->update($id, $email, $pseudo, $first_name, $name, $role, $password);
        \Controllers\Router::message('success', "Utilisateur modifié");
        \Http::redirect('index.php?action=administration&task=user');
    }

    public function passwordforget()
    {
        $email = null;
        if (!empty($_POST['email'])) {
            $email = htmlspecialchars($_POST['email']);
        }

        if (!$email){
            throw \Controllers\Router::error('danger', 'Veuillez remplir correctement le formulaire');
        }

        $verifEmail = $this->model->findUserByEmail($email);

        if (!$verifEmail){
            throw \Controllers\Router::error('danger', 'Aucun compte trouvé lié à cet email');
        }

        $id_user = $verifEmail['id'];
        $token = openssl_random_pseudo_bytes(30);
        $token = bin2hex($token);

        $this->model->setToken($id_user, $token);
        $mailerModel = new \Models\Mailer;
        $mailerModel->sendMailForPassword($email, $token);

        \Http::redirect('index.php');
    }

    public function changepassword()
    {
        $token = null;
        if (!empty($_GET['token'])) {
            $token = htmlspecialchars($_GET['token']);
        }

        $tokenInfo = $this->model->getTokenInfo($token);
        
        if (!$tokenInfo){
            throw \Controllers\Router::error('danger', 'Impossible de changer de mot de passe avec ce lien');
        }

        $newPassword = null;
        if (!empty($_POST['password']) && !empty($_POST['confirmPassword'])){
            if ($_POST['password'] != $_POST['confirmPassword']){
                throw \Controllers\Router::error('danger', 'Les mots de passes ne correspondent pas', '?action=user&task=changepassword&token='. $token);
            }
            $newPassword = $_POST['password'];
        }

        if (!$newPassword){
            $pageTitle = "Changement de mot de passe";
            \Renderer::render('changePassword', compact('pageTitle'));
        } else {
            $this->model->deleteToken($token);
            $this->model->updatePassword($tokenInfo['id_user'], $newPassword);
            \Controllers\Router::message('success', "Mot de passe modifié");
            \Http::redirect('index.php');
        }

    }

}