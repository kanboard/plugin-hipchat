<h3><img src="<?= $this->url->dir() ?>plugins/Hipchat/hipchat-icon.png"/>&nbsp;Hipchat</h3>
<div class="panel">
    <?= $this->form->label(t('Personal Hipchat API Token'), 'hipchat_api_token') ?>
    <?= $this->form->password('hipchat_api_token', $values) ?>

    <p class="form-help"><a href="https://github.com/kanboard/plugin-hipchat#configuration" target="_blank"><?= t('Help on Hipchat integration') ?></a></p>

    <div class="form-actions">
        <input type="submit" value="<?= t('Save') ?>" class="btn btn-blue">
    </div>
</div>