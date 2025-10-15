<?php $pager->setSurroundCount(2); ?>
<nav aria-label="Pagination">
    <ul class="pagination justify-content-end">
        <!-- Tombol Previous -->
        <li class="page-item <?= $pager->hasPreviousPage() ? '' : 'disabled' ?>">
            <a class="page-link" href="<?= $pager->hasPreviousPage() ? $pager->getPreviousPage() : '#' ?>">
                &lsaquo; Prev
            </a>
        </li>

        <!-- Nomor Halaman -->
        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <!-- Tombol Next -->
        <li class="page-item <?= $pager->hasNextPage() ? '' : 'disabled' ?>">
            <a class="page-link" href="<?= $pager->hasNextPage() ? $pager->getNextPage() : '#' ?>">
                Next &rsaquo;
            </a>
        </li>
    </ul>
</nav>
