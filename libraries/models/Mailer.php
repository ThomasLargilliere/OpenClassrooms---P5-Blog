<?php

namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
class Mailer
{
    /**
     * Fonction permettant d'envoyer un mail
     * 
     * @param string $first_name
     * @param string $name
     * @param string $email
     * @param string $content
     * 
     * @return void
     */
    public function send(string $first_name, string $name, string $email, string $content): void
    {
        require 'env.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = $your_email;
        $mail->Password = $your_password_email;
        $mail->setFrom($email, $first_name . ' ' . $name);
        $mail->addReplyTo($email, $first_name . ' ' . $name);
        $mail->addAddress($your_email);
        $mail->Subject = 'Nouveau mail recu de ' . $first_name . ' ' . $name;
        $mail->Body = $content;
        if (!$mail->send()) {
            throw \Controllers\Router::error('danger', "Erreur lors de l'envoie du mail");
        } else {
            $controllerModel = new \Controllers\Router();
            $controllerModel->message('success', "Votre email a bien été envoyé");
        }
    }

    /**
     * Fonction permettant d'envoyer un mail pour un mot de passe oublié
     * 
     * @param string $email
     * 
     * @return void
     */
    public function sendMailForPassword(string $email, string $token): void
    {
        require 'env.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = $your_email;
        $mail->Password = $your_password_email;
        $mail->setFrom($your_email, 'Blog de ' . $your_name);
        $mail->addAddress($email);
        $mail->Subject = 'Mot de passe oublie sur le blog ' . $your_name;
        $mail->Body = "Pour changer votre mot de passe : http://localhost/blog?action=user&task=changepassword&token=" . $token;
        if (!$mail->send()) {
            throw \Controllers\Router::error('danger', "Erreur lors de l'envoie du mail");
        } else {
            $controllerModel = new \Controllers\Router();
            $controllerModel->message('success', "Email de récupération de mot de passe oublié");
        }
    }
}