<?php
function NameValidation(string $name): bool
{
    $regex = '/^[а-яА-ЯёЁ\s]+$/s';
    return preg_match($regex, $name);
}

function EmailValidation(string $email): bool
{
    $regex = '//s';
    return preg_match($regex, $email);
}

function SendMail(string $receiverName, string $mailTo, string $senderName, string $from, string $text): bool
{
    $username = "Rti2paBWiMuH";
    $password = "H2kB2ibz5zMR";
    $host = "smtp.mailsnag.com";
    // $from = "elvis@example.com";
    $port = "2525";
    $charset = "UTF-8";

    $smtp = new SendMailSmtpClass($username, $password, $host, $from, $port, $charset);

    // $mailTo = "chuck@example.com";
    $site = $_SERVER['SERVER_NAME'];
    $subject = "С сайта $site отправлено сообщение";

    $message = "Уважаемый $receiverName, вам отправлено письмо от $senderName с сообщением:\n\n";
    $message .= $text;
    
    $headers = "To: $receiverName <$mailTo>\r\nReply-To: $from\r\nContent-Type: text/plain; charset=UTF-8\r\n";

    return $smtp->send($mailTo, $subject, $message, $headers);
}