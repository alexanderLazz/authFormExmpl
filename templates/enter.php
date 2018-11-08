<form action="../enter.php" method="post">
  <h2>Вход</h2>
  <div>
    <label for="name">Имя</label>
    <input id="name" type="text" name="name" placeholder="Введите имя" value="" required>
  </div>
  <div>
    <label for="password">Пароль</label>
    <input id="password" type="password" name="password" placeholder="Введите пароль" required>
  </div>
  <?php if (!empty($errors)) { ?>
    <div>
      <p>Пожалуйста, исправьте следующие ошибки в форме: </p>
      <ul>
      <?php foreach ($errors as $key => $value) { ?>
        <li><?php print($errors[$key]) ?></li>
      <?php } ?>
      </ul>
    </div>
  <?php } ?>
  <button type="submit" class="button">Войти</button>
</form>