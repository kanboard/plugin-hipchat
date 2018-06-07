<h3><img src="<?= $this->url->dir() ?>plugins/Hipchat/hipchat-icon.png"/>&nbsp;Hipchat</h3>
<div class="panel">
    <?= $this->form->label(t('Hipchat API URL'), 'hipchat_api_url') ?>
    <?= $this->form->text('hipchat_api_url', $values, array(), array('placeholder="https://api.hipchat.com"')) ?>
    <p class="form-help">
        <?= t('Leave blank to use global settings ("%s").', $this->app->config('hipchat_api_url', 'https://api.hipchat.com')) ?>
    </p>

    <?= $this->form->label(t('Room API ID or name'), 'hipchat_room_id') ?>
    <?= $this->form->text('hipchat_room_id', $values) ?>

    <?= $this->form->label(t('Room notification token'), 'hipchat_room_token') ?>
    <?= $this->form->password('hipchat_room_token', $values) ?>

    <p class="form-help"><a href="https://github.com/kanboard/plugin-hipchat#configuration" target="_blank"><?= t('Help on Hipchat integration') ?></a></p>

    <div class="form-actions">
        <input type="submit" value="<?= t('Save') ?>" class="btn btn-blue">
    </div>
</div>
