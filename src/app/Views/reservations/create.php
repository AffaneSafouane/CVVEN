<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<section class="container py-4">
    <h2 class="mb-4"><?= esc($title); ?></h2>

    <form action="<?= site_url("rooms/{$roomId}/reservation") ?>" method="post">
        <?= csrf_field() ?>

        <input type="hidden" name="room_id" value="<?= esc($roomId); ?>">

        <div class="mb-3">
            <label for="start_date" class="form-label">Date d'arrivée</label>
            <input
                type="text"
                id="start_date"
                name="start_date"
                class="form-control datepicker"
                placeholder="YYYY-MM-DD"
                required
                autocomplete="off"
            />
        </div>

        <fieldset class="mb-4">
            <legend class="form-label">Nombre de personnes</legend>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="adults" class="form-label">Adultes</label>
                    <input
                        type="number"
                        id="adults"
                        name="adults"
                        class="form-control"
                        min="1"
                        max="<?= esc($capacity); ?>"
                        value="1"
                        required
                    />
                </div>
                <div class="col-md-4">
                    <label for="children" class="form-label">Enfants</label>
                    <input
                        type="number"
                        id="children"
                        name="children"
                        class="form-control"
                        min="0"
                        max="<?= esc($capacity); ?>"
                        value="0"
                    />
                </div>
                <div class="col-md-4">
                    <label for="animals" class="form-label">Animaux</label>
                    <input
                        type="number"
                        id="animals"
                        name="animals"
                        class="form-control"
                        min="0"
                        max="2"
                        value="0"
                    />
                </div>
            </div>
        </fieldset>

        <div class="mb-4">
            <label for="meal_option" class="form-label">Option de pension</label>
            <select name="meal_option" id="meal_option" class="form-select" required>
                <option value="Pension-Compléte">Pension Compléte (+50€)</option>
                <option value="Demi-Pension">Demi-Pension (+30€)</option>
                <option value="Sans-Pension">Sans-Pension (+0€)</option>
            </select>
        </div>

        <div class="form-check mb-4">
            <input
                class="form-check-input"
                type="checkbox"
                id="cleaning_option"
                name="cleaning_option"
                value="1"
            />
            <label class="form-check-label" for="cleaning_option">
                Option ménage (+30€)
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Suivant</button>
    </form>
</section>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#start_date", {
        theme: "airbnb",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d/m/Y",
        locale: "fr",
        minDate: "today",
        maxDate: new Date().fp_incr(7)
    });
});
</script>
<?= $this->endSection(); ?>
