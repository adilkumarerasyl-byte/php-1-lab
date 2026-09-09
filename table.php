<?php
  $cols  = 5;
  $rows  = 5;
  $color = '#dddddd';

  if (isset($_GET['cols'], $_GET['rows'], $_GET['color'])) {
      $inputCols  = (int) $_GET['cols'];
      $inputRows  = (int) $_GET['rows'];
      $inputColor = trim($_GET['color']);

      if ($inputCols >= 1 && $inputCols <= 10) {
          $cols = $inputCols;
      }
      if ($inputRows >= 1 && $inputRows <= 10) {
          $rows = $inputRows;
      }

      if (preg_match('/^#[0-9a-fA-F]{3}([0-9a-fA-F]{3})?$/', $inputColor) ||
          preg_match('/^[a-zA-Z]{3,20}$/', $inputColor)) {
          $color = $inputColor;
      }
  }

  function drawTable($cols, $rows, $color) {
      echo "<table border='1' width='200'>";
      for ($r = 1; $r <= $rows; $r++) {
          echo "<tr>";
          for ($c = 1; $c <= $cols; $c++) {
              $value = $r * $c;
              if ($r === 1 || $c === 1) {
                  echo "<td style='font-weight: bold; text-align: center; background-color: $color;'>$value</td>";
              } else {
                  echo "<td>$value</td>";
              }
          }
          echo "</tr>";
      }
      echo "</table>";
  }

  // Современное получение года без устаревшей функции strftime()
  $year = date('Y');
?>
<!DOCTYPE html>
<html>

<head>
  <title>Таблица умножения</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <div id="header">
    <img src="logo.gif" width="187" height="29" alt="Наш логотип" class="logo" />
    <span class="slogan">приходите к нам учиться</span>
    </div>

  <div id="content">
    <h1>Таблица умножения</h1>
    <form action='' method='get'>
      <label>Количество колонок: </label>
      <br />
      <input name='cols' type='text' value="<?= htmlspecialchars((string)$cols) ?>" />
      <br />
      <label>Количество строк: </label>
      <br />
      <input name='rows' type='text' value="<?= htmlspecialchars((string)$rows) ?>" />
      <br />
      <label>Цвет: </label>
      <br />
      <input name='color' type='text' value="<?= htmlspecialchars((string)$color) ?>" />
      <br />
      <br />
      <input type='submit' value='Создать' />
    </form>
    <?php
      drawTable($cols, $rows, $color);
    ?>
    </div>
  <div id="nav">
    <h2>Навигация по сайту</h2>
    <ul>
      <li><a href='index.php'>Домой</a></li>
      <li><a href='about.php'>О нас</a></li>
      <li><a href='contact.php'>Контакты</a></li>
      <li><a href='table.php'>Таблица умножения</a></li>
      <li><a href='calc.php'>Калькулятор</a></li>
    </ul>
    </div>
  <div id="footer">
    &copy; Супер Мега Веб-мастер, 2000 &ndash; <?= $year ?>
    </div>
</body>

</html>