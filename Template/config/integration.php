<h3><img src="<?= $this->url->dir() ?>plugins/Hipchat/hipchat-icon.png"/>&nbsp;Hipchat</h3>
<div class="panel">
    <?= $this->form->label(t('Hipchat API URL'), 'hipchat_api_url') ?>
    <?= $this->form->text('hipchat_api_url', $values, array(), array('placeholder="https://api.hipchat.com"')) ?>

    <?= $this->form->label(t('Hipchat API Token'), 'hipchat_api_token') ?>
    <?= $this->form->text('hipchat_api_token', $values) ?>

    <p class="form-help"><a href="https://kanboard.net/plugin/hipchat" target="_blank"><?= t('Help on Hipchat integration') ?></a></p>

    <div class="form-actions">
        <input type="submit" value="<?= t('Save') ?>" class="btn btn-blue">
    </div>
</div>
