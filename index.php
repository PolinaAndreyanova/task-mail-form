<?php
include_once("functions-library.php");
include_once("SendMailSmtpClass.php");

$arValidationErrors = [];

[$feedback, $receiverName, $receiverEmail, $senderName, $senderEmail, $message] = ClearValues(6);

if ($_POST) {
    $feedback = "";

    [$receiverName, $receiverEmail, $senderName, $senderEmail, $message] = PostDataHandler();

    $arValidationErrors = HandleValidation($receiverName, $receiverEmail, $senderName, $senderEmail, $message);

    if (!$arValidationErrors) {
        if (SendMail($receiverName, $receiverEmail, $senderName, $senderEmail, $message)) {
            $feedback = "Сообщение успешно отправлено!";

            $arValidationErrors = [];

            [$receiverName, $receiverEmail, $senderName, $senderEmail, $message] = ClearValues(5);
        };
    }

}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style.css" />
    <title>Форма</title>
</head>
<body class="content">
    <form class="content__form" method="post">
        <h1 class="content__header">Форма</h1>

        <h2 class="content__inputsHeader">Получатель</h2>
        
        <input class="content__input" type="text" name="receiver-name" value="<?=$receiverName?>" placeholder="Иван" required />
        <p class="content__feedback content__feedback_type_error"><?=HandleError("receiverName", $arValidationErrors)?></p>
        
        <input class="content__input" type="email" name="receiver-email" value="<?=$receiverEmail?>" placeholder="ivan85@mail.ru" required/>
        <p class="content__feedback content__feedback_type_error"><?=HandleError("receiverEmail", $arValidationErrors)?></p>

        <h2 class="content__inputsHeader">Отправитель</h2>
        
        <input class="content__input" type="text" name="sender-name" value="<?=$senderName?>" placeholder="Александр" required/>
        <p class="content__feedback content__feedback_type_error"><?=HandleError("senderName", $arValidationErrors)?></p>
        
        <input class="content__input" type="email" name="sender-email" value="<?=$senderEmail?>" placeholder="alex86@mail.ru" required/>
        <p class="content__feedback content__feedback_type_error"><?=HandleError("senderEmail", $arValidationErrors)?></p>

        <textarea class="content__textarea" name="message" placeholder="Текст сообщения" required><?=$message?></textarea>
        <p class="content__feedback content__feedback_type_error"><?=HandleError("message", $arValidationErrors)?></p>

        <button class="content__button" type="submit">Отправить</button>
        <p class="content__feedback content__feedback_type_success"><?=$feedback?></p>
    </form>
</body>
</html>