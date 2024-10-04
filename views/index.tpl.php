<?php include VIEWS . "/header.tpl.php"; ?>
    <div class="flex-grow-1">
        <div class="container-lg py-3">
            <div class="<?="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4"?>">
	            <?php /** @var array $anime_data */
	            /** @var int $offset */
	            foreach(array_slice($anime_data, $offset, $episodes_per_page) as $key => $value): ?>
                    <div class="p-3">
                        <div class="card">
                            <img src="<?= $value['preview']?>" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="/episode/<?=$offset + $key + 1?>" class="link-offset-2 link-underline link-underline-opacity-0 link-body-emphasis">
                                        <?= "Episode " . $offset + $key + 1 ?>
                                    </a>
                                </h5>
                                <a href="/episode/<?=$offset + $key + 1?>" class="btn btn-primary w-100">Watch</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
<!--            paggination-->
	        <?php
	        /** @var bool $show_pagination */
	        if($show_pagination): ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
	                <?php /** @var int $pages_amount */
                    for($i = 1; $i <= $pages_amount; $i++): ?>
                        <li class="page-item">
                            <a class="page-link <?= $current_page == $i ? 'fw-bold' : '' ?>" href="/?page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </div>
<?php include VIEWS . "/footer.tpl.php"; ?>
