<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(0);
?>
<nav>
    <ul class="pagination">
        <li <?= $pager->hasPrevious() ? '' : 'class="page-item disabled"' ?>>
            <a href="<?= $pager->getPrevious() ?? '#' ?>" aria-label="<?= lang('Pager.previous') ?>" class="page-link">
                <span aria-hidden="true"><?= lang('Pager.newer') ?></span>
            </a>
        </li>
        <li <?= $pager->hasNext() ? '' : 'class="page-item disabled"' ?>>
            <a href="<?= $pager->getNext() ?? '#' ?>" aria-label="<?= lang('Pager.next') ?>" class="page-link">
                <span aria-hidden="true"><?= lang('Pager.older') ?></span>
            </a>
        </li>
    </ul>
</nav>
