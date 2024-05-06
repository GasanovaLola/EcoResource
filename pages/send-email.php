<?php
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom($email, $name);
    $mail->addAddress("lolita.hasanova@nure.ua", "Lolita Hasanova");

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();

    header("Location: sent.php");
?>