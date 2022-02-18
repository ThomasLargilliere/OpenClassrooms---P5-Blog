<?php

namespace Models;

class User extends Model
{
    protected $table = 'user';

    /**
     * Retourne un utilisateur grâce à son email
     * 
     * @param string $email
     */

    public function findUserByEmail(string $email)
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $query->execute(compact('email'));
        $user = $query->fetch();
        return $user;
    }
    
    /**
     * Insere un nouvel utilisateur dans la base de données
     * 
     * @param string $email
     * @param string $pseudo
     * @param string $password
     * @param string $first_name
     * @param string $name
     * @return void
     */
    public function insert(string $email, string $pseudo, string $password, string $first_name, string $name): void
    {
        $verifEmail = $this->findUserByEmail($email);

        if ($verifEmail)
        {
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['name'] = $name;
            throw \Controllers\Router::error('danger', 'Cet email est déjà utilisé');
        }

        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = $this->pdo->prepare("INSERT INTO user SET email = :email, pseudo = :pseudo, password = :password, first_name = :first_name, name = :name");
        $query->execute(compact('email', 'pseudo', 'password', 'first_name', 'name'));
    }

    /**
     * Permet de connecter un utilisateur en vérifiant son email et son mot de passe
     * 
     * @param string $email
     * @param string $password
     * @return void
     */
    public function connect(string $email, string $password): void
    {
        $user = $this->findUserByEmail($email);
        if (!$user)
        {
            throw \Controllers\Router::error('danger', 'Aucun compte trouvé avec cet email');
        }

        if (!password_verify($password, $user['password'])){
            $_SESSION['email'] = $email;
            throw \Controllers\Router::error('danger', 'Mot de passe incorrect !');
        }

        $_SESSION['user'] = $user['id'];
    }

    /**
     * Permet de vérifié qu'un utilisateur connecté est administrateur
     * 
     * @return boolean
     */

    public function isAdmin()
    {
        $id = $_SESSION['user'];
        $query = $this->pdo->prepare("SELECT is_admin FROM role r, user u WHERE u.id_role = r.id and u.id = :id");
        $query->execute(compact('id'));
        $is_admin = $query->fetch();
        $is_admin = $is_admin['is_admin'];
        return $is_admin;
    }

    /**
     * Retourne une ou des lignes d'une table
     * 
     * @param string $order
     * @return array
     */
    public function findAll(?string $order = ""): array
    {
        $resultats = $this->pdo->query("SELECT *, u.id as id_user FROM user u, role r WHERE u.id_role = r.id");
        $articles = $resultats->fetchAll();
        return $articles;
    }

    /**
     * Permet de changer certaines informations d'un utilisateur
     * 
     * @param integer $id
     * @param string $email
     * @param string $pseudo
     * @param string $first_name
     * @param string $name
     * @param integer $id_role
     * @param string $password
     * @param string $image
     * 
     * @return void
     */

    public function update(int $id, string $email, string $pseudo, string $first_name, string $name, int $id_role, ?string $password, ?string $image): void
    {
        $args = compact('email', 'pseudo', 'first_name', 'name', 'id_role', 'id');
        $set = 'email = :email, pseudo = :pseudo, first_name = :first_name, name = :name, id_role = :id_role';

        if ($password !== null){
            $password = password_hash($password, PASSWORD_BCRYPT);
            $set = $set . ', password = :password';
            $args = compact('email', 'pseudo', 'first_name', 'name', 'id_role', 'password', 'id');
        }

        if ($image !== null){
            $set = $set . ', image = :image';
            $args = compact('email', 'pseudo', 'first_name', 'name', 'id_role', 'image', 'id');
        }

        if ($image !== null && $password !== null){
            $args = compact('email', 'pseudo', 'first_name', 'name', 'id_role', 'password', 'image', 'id');
        }

        $query = $this->pdo->prepare("UPDATE user SET {$set} WHERE id = :id");
        $query->execute($args);        
    }

    /**
     * Permet de changer le mot de passe d'un utilisateur
     * 
     * @param integer $id
     * @param string $password
     * 
     * @return void
     */

    public function updatePassword(int $id, string $password): void
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $query = $this->pdo->prepare("UPDATE user SET password = :password WHERE id = :id");
        $query->execute(compact('id', 'password'));         
    }

    /**
     * Insère un token dans la bdd pour changer de mot de passe
     * 
     * @param integer $id_user
     * @param string $token
     * 
     * @return void
     */

    public function setToken(int $id_user, string $token): void
    {

        $query = $this->pdo->prepare("DELETE FROM token_password WHERE id_user = :id_user");
        $query->execute(compact('id_user'));

        $query = $this->pdo->prepare("INSERT INTO token_password VALUES (:id_user, :token, NOW())");
        $query->execute(compact('id_user', 'token'));  
    }

    /**
     * Permet de récuperer les informations d'un token
     * 
     * @param string $token
     */

    public function getTokenInfo(string $token)
    {
        $query = $this->pdo->prepare("SELECT * FROM token_password WHERE token = :token");
        $query->execute(compact('token'));
        $tokenInfo = $query->fetch();
        return $tokenInfo;
    }
    /**
     * Permet de supprimer un token
     * 
     * @param string $token
     */
    public function deleteToken(string $token)
    {
        $query = $this->pdo->prepare("DELETE FROM token_password WHERE token = :token");
        $query->execute(compact('token'));
    }

}