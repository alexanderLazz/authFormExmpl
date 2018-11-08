<section>
    <h2>Мое хобби</h2>
    <div>
    	<?php if (!$getHobby) { ?>
    	<form action="../hobby.php" method="post" enctype="multipart/form-data">
		  <h2>Заполните свое хобби</h2>
		  <div>
		    <label for="name">Хобби</label>
		    <input id="hobby" type="text" name="hobby" placeholder="Введите хобби" value="" required>
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
		    <button type="submit" class="button">Отправить</button>
		 </form>
		  <?php } else { 
		  	foreach ($getHobby as $key => $value) { ?>
		  		<p><?=$getHobby[$key] ?></p>
		  	<?php } ?>
		  <?php } ?>
    </div>
</section>