<?php $pager->setSurroundCount(1) ?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination justify-content-center">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="First">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">First</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Previous">
                    <span aria-hidden="true">&lsaquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="Next">
                    <span aria-hidden="true">&rsaquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Last">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Last</span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
