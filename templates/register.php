<form action="../register.php" method="post" enctype="multipart/form-data">
  <h2>Регистрация нового аккаунта</h2>
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
  <button type="submit" class="button">Зарегистрироваться</button>
</form>