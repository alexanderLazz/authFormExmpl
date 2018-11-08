<section>
    <h2>Главная страница</h2>
    <div>
        <?php if (isset($user_name)) { ?>
          <div>
            <p>Приветствую тебя <?=$user_name ?></p>
            <p><a href="hobby.php">Мое хобби</a></p>
          </div>
        <?php } ?>
    </div>
</section>

