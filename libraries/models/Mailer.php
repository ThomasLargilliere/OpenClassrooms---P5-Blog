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

        $myMail = 'thomas.largilliere.mail@gmail.com';
        $myName = 'Thomas Largillière';
        $myPassword = 'TheThomzsS93140';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = $myMail;
        $mail->Password = $myPassword;
        $mail->setFrom($email, $first_name . ' ' . $name);
        $mail->addReplyTo($email, $first_name . ' ' . $name);
        $mail->addAddress($myMail);
        $mail->Subject = 'Nouveau mail recu de ' . $first_name . ' ' . $name;
        $mail->Body = $content;
        if (!$mail->send()) {
            throw \Controllers\Router::error('danger', "Erreur lors de l'envoie du mail");
        } else {
            $controllerModel = new \Controllers\Router();
            $controllerModel->message('success', "Votre email a bien été envoyé");
        }
    }
}