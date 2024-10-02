<?php include VIEWS . "/header.tpl.php"; ?>
    <div class="flex-grow-1">
        <div class="container-lg py-3">
            <div class="<?="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4"?>">
	            <?php /** @var array $anime_data */
                foreach($anime_data as $key => $value): ?>
                    <div class="p-3">
                        <div class="card">
                            <img src="<?= $value['preview']?>" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Episode <?=$key + 1?></h5>
                                <a href="/episode/<?=$key + 1?>" class="btn btn-primary w-100">Watch</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php include VIEWS . "/footer.tpl.php"; ?>


