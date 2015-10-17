<h3><img src="<?= $this->url->dir() ?>plugins/Hipchat/hipchat-icon.png"/>&nbsp;Hipchat</h3>
<div class="listing">
    <?= $this->form->label(t('Room API ID or name'), 'hipchat_room_id') ?>
    <?= $this->form->text('hipchat_room_id', $values) ?>

    <?= $this->form->label(t('Room notification token'), 'hipchat_room_token') ?>
    <?= $this->form->text('hipchat_room_token', $values) ?>

    <p class="form-help"><a href="https://github.com/kanboard/plugin-hipchat" target="_blank"><?= t('Help on Hipchat integration') ?></a></p>

    <div class="form-actions">
        <input type="submit" value="<?= t('Save') ?>" class="btn btn-blue"/>
    </div>
</div>