<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<section class="container px-4 py-4">
    <?php if (session('error')): ?>
        <div class="alert alert-danger"><?= session('error'); ?></div>
    <?php endif; ?>
    <?php if (session('errors')): ?>
        <div class="alert alert-danger">
            <?php if (is_array(session('errors'))): ?>
                <?php foreach (session('errors') as $error): ?>
                    <?= esc($error) ?><br>
                <?php endforeach; ?>
            <?php else: ?>
                <?= esc(session('errors')) ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="bg-light p-4 rounded">
        <h2 class="mb-4"><?= esc($title); ?></h2>
        <?= form_open('reservations/create'); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id"    value="<?= esc($id); ?>">
            <input type="hidden" name="start" value="<?= esc($start ?? ''); ?>">
            <input type="hidden" name="end"   value="<?= esc($end ?? ''); ?>">

            <div class="mb-3">
                <label for="nbPeople" class="form-label">Nombre de personnes</label>
                <input type="number" id="nbPeople" name="nbPeople" min="1" max="<?= esc($capacity); ?>" class="form-control" placeholder="1 à <?= esc($capacity); ?>" required>
            </div>

            <div class="mb-3">
                <label for="pensionType" class="form-label">Option repas</label>
                <select id="pensionType" name="pensionType" class="form-select" required>
                    <option value="" disabled selected>Choisissez une option</option>
                    <option value="Pension Compléte">Pension complète</option>
                    <option value="Demi-Pension">Demi-pension</option>
                    <option value="Sans-Pension">Pas de pension</option>
                </select>
            </div>

            <fieldset class="mb-3">
                <legend>Option ménage</legend>
                <div class="form-check">
                    <input type="radio" id="cleaningYes" name="cleaningOption" value="1" class="form-check-input" checked>
                    <label class="form-check-label" for="cleaningYes">Oui</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="cleaningNo" name="cleaningOption" value="0" class="form-check-input">
                    <label class="form-check-label" for="cleaningNo">Non</label>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-primary">Soumettre</button>
        <?= form_close(); ?>
    </div>
</section>
<?= $this->endSection(); ?>
