<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style.css" />
    <title>Форма</title>
</head>
<body class="content">
    <form class="content__form" action="form-handler.php" method="post">
        <h1 class="content__header">Форма</h1>

        <h2 class="content__inputsHeader">Получатель</h2>
        <input class="content__input" type="text" name="receiver-name" value="" placeholder="Иван" required /><br>
        <input class="content__input" type="email" name="receiver-email" value="" placeholder="ivan85@mail.ru" /><br>

        <h2 class="content__inputsHeader">Отправитель</h2>
        <input class="content__input" type="text" name="sender-name" value="" placeholder="Александр" /><br>
        <input class="content__input" type="email" name="sender-email" value="" placeholder="alex86@mail.ru" /><br>

        <textarea class="content__textarea" name="message" placeholder="Текст сообщения"></textarea><br>

        <button class="content__button" type="submit">Отправить</button>
    </form>
</body>
</html>