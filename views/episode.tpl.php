<?php
/**
 * @var int $episode_number;
 * @var array $anime_data;
 */
include VIEWS . "/header.tpl.php"; ?>

<div class="flex-grow-1">
	<div class="container-lg pt-5 pt-md-0">
		<h3 class="pt-3">Episode <?= $episode_number; ?></h3>
        <hr>
        <video width="100%" class="object-fit-contain" controls>
            <source src="<?= $anime_data[$episode_number - 1]['url'] ?>">
        </video>
        <nav aria-label="Video episode pages">
            <ul class="pagination d-flex justify-content-between">
                <li class="page-item <?= $episode_number == 1 ? "disabled" : "" ?>">
                    <a class="page-link" href="/episode/<?=$episode_number - 1?>">&laquo; Previous</a>
                </li>
                <li class="page-item <?= $episode_number == count($anime_data) ? "disabled" : ""  ?>">
                    <a class="page-link" href="/episode/<?=$episode_number + 1?>">Next &raquo;</a>
                </li>
            </ul>
        </nav>
	</div>
</div>

<?php include VIEWS . "/footer.tpl.php"; ?>
