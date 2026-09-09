<?php
/**
 * Отрисовывает меню навигации
 * * @param array $menu Массив со структурой элементов меню
 * @param bool $vertical Флаг ориентации: true — вертикальное, false — горизонтальное
 */
function drawMenu(array $menu, bool $vertical = true): void {
    $style = $vertical 
        ? '' 
        : ' style="display: flex; list-style: none; padding: 0; margin: 0;"';
    
    $liStyle = $vertical ? '' : ' style="margin-right: 15px;"';

    echo "<ul{$style}>";
    foreach ($menu as $item) {
        echo "<li{$liStyle}><a href='" . htmlspecialchars($item['href']) . "'>" . htmlspecialchars($item['link']) . "</a></li>";
    }
    echo "</ul>";
}

// Структура навигационного меню
$leftMenu = [
    ['link' => 'Домой', 'href' => 'index.php'],
    ['link' => 'О нас', 'href' => 'about.php'],
    ['link' => 'Контакты', 'href' => 'contact.php'],
    ['link' => 'Таблица умножения', 'href' => 'table.php'],
    ['link' => 'Калькулятор', 'href' => 'calc.php']
];

// Получение текущего времени и корректной даты на русском языке
$now = new DateTime();
$hour = (int) $now->format('H');
$year = $now->format('Y');
$day  = $now->format('d');

// Форматирование названия месяца на русском
if (class_exists('IntlDateFormatter')) {
    $formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::NONE, IntlDateFormatter::NONE, null, null, 'LLLL');
    $mon = $formatter->format($now);
} else {
    // Резервный массив месяцев на случай отсутствия расширения ext-intl
    $months = [1 => 'январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'];
    $mon = $months[(int)$now->format('n')];
}

// Определение динамического приветствия по времени суток
$welcome = match (true) {
    $hour >= 6 && $hour < 12 => 'Доброе утро',
    $hour >= 12 && $hour < 18 => 'Добрый день',
    $hour >= 18 && $hour < 23 => 'Добрый вечер',
    default => 'Доброй ночи',
};
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <title>Сайт нашей школы</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <div id="header">
    <img src="logo.gif" width="187" height="29" alt="Наш логотип" class="logo" />
    <span class="slogan">приходите к нам учиться</span>
  </div>

  <div id="content">
    <h1><?= htmlspecialchars($welcome) ?>, Гость!</h1>

    <blockquote>
      Сегодня <?= $day ?> число, <?= htmlspecialchars($mon) ?> месяц, <?= $year ?> год.
    </blockquote>

    <h3>Зачем мы ходим в школу?</h3>
    <p>
      У нас каждую минуту что-то происходит и кипит жизнь. Проходят уроки и шумят перемены, кто-то отвечает у доски, кто-то отчаянно зубрит перед контрольной пройденный материал, кому-то ставят «пятерку» за сочинение, кого-то ругают за непрочитанную книгу, на школьной спортивной площадке ребята играют в футбол, а девочки – в волейбол, некоторые готовятся к соревнованиям, другие участвуют в репетициях праздников…
    </p>

    <h3>Что такое ЕГЭ?</h3>
    <p>
      Аббревиатура ЕГЭ расшифровывается как "Единый Государственный Экзамен". Почему "единый"? ЕГЭ одновременно является и вступительным экзаменом в ВУЗ и итоговой оценкой каждого выпускника школы. К тому же на всей территории России используются однотипные задания и единая система оценки.
    </p>
    <p>
      Результаты ЕГЭ оцениваются по 100-балльной и пятибалльной системам и заносятся в свидетельство о результатах единого государственного экзамена. Срок действия данного документа истекает 31 декабря года, следующего за годом его выдачи, поэтому у абитуриентов есть возможность поступать в ВУЗы со свидетельством ЕГЭ в течение двух лет.
    </p>
  </div>

  <div id="nav">
    <h2>Навигация по сайту</h2>
    <?php drawMenu($leftMenu, true); ?>
    </div>

  <div id="footer">
    &copy; Супер Мега Веб-мастер, 2000 &ndash; <?= $year ?>
  </div>

</body>
</html>