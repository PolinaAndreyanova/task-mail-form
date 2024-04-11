<?php
function ClearValues(int $count): array
{
    for ($i = 0; $i < $count; $i++) {
        $arValues[] = "";
    }
    return $arValues;
}

function PostDataHandler(): array
{
    $receiverName = $_POST["receiver-name"];
    $receiverEmail = $_POST["receiver-email"];

    $senderName = $_POST["sender-name"];
    $senderEmail = $_POST["sender-email"];

    $message = $_POST["message"];

    return [$receiverName, $receiverEmail, $senderName, $senderEmail, $message];
}

function NameValidation(string $name): bool
{
    $regex = '/^([а-яА-ЯёЁ]+)(?:$| ([а-яА-ЯёЁ]+$))/s';
    return preg_match($regex, $name);
}

function EmailValidation(string $email): bool
{
    $regex = '/(^([a-zA-Z0-9][a-zA-Z0-9._-]{0,}[a-zA-Z0-9]{0,})@(?:[a-zA-Z0-9][a-zA-Z0-9_-]{0,}[a-zA-Z0-9]{0,}\.)+[a-zA-Z0-9][a-zA-Z0-9_-]{0,}[a-zA-Z0-9]{0,}$)/s';
    return preg_match($regex, $email);
}

function HandleValidation(string $receiverName, string $receiverEmail, string $senderName, string $senderEmail, string $message): array
{
    $arValidationErrors = [];

    if (!NameValidation($receiverName)) {
        $arValidationErrors["receiverName"] = "Поле должно содержать имя и/или фамилию получателя кириллицей";
    }

    if (!NameValidation($senderName)) {
        $arValidationErrors["senderName"] = "Поле должно содержать имя и/или фамилию отправителя кириллицей";
    }

    if (!EmailValidation($receiverEmail)) {
        $arValidationErrors["receiverEmail"] = "Поле не соответствует формату email";
    }

    if (!EmailValidation($senderEmail)) {
        $arValidationErrors["senderEmail"] = "Поле не соответствует формату email";
    }

    if (!$message) {
        $arValidationErrors["message"] = "Сообщение не может быть пустым";
    }

    return $arValidationErrors;
}

function HandleError(string $key, array $arValidationErrors): string
{
    if (array_key_exists($key, $arValidationErrors)) { 
        return $arValidationErrors[$key];
    }
    return "";
}

function SendMail(string $receiverName, string $mailTo, string $senderName, string $from, string $text): bool
{
    $username = "Rti2paBWiMuH";
    $password = "H2kB2ibz5zMR";
    $host = "smtp.mailsnag.com";
    $port = "2525";
    $charset = "UTF-8";

    $smtp = new SendMailSmtpClass($username, $password, $host, $from, $port, $charset);

    $site = $_SERVER['SERVER_NAME'];
    $subject = "С сайта $site отправлено сообщение";

    $message = "Уважаемый $receiverName, вам отправлено письмо от $senderName с сообщением:\n\n";
    $message .= $text;

    $headers = "To: $receiverName <$mailTo>\r\nReply-To: $from\r\nContent-Type: text/plain; charset=UTF-8\r\n";

    return $smtp->send($mailTo, $subject, $message, $headers);
}
