<?php foreach ($navbar as $key => $value): ?>
	<li class="nav-item">
		<a href="<?= $key ?>"
		   class="nav-link <?= ($key == $active_uri) ? 'active' : '' ?>"><?= $value ?></a>
	</li>
<?php endforeach; ?>

