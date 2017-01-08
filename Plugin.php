<?php

namespace Kanboard\Plugin\Hipchat;

use Kanboard\Core\Translator;
use Kanboard\Core\Plugin\Base;

/*
 * Hipchat Plugin
 *
 * @package  hipchat
 * @author   Frederic Guillot
 */
class Plugin extends Base
{
    public function initialize()
    {
        $this->template->hook->attach('template:config:integrations', 'hipchat:config/integration');
        $this->template->hook->attach('template:project:integrations', 'hipchat:project/integration');

        $this->userNotificationTypeModel->setType('hipchat', t('Hipchat'), '\Kanboard\Plugin\Hipchat\Notification\Hipchat');
        $this->projectNotificationTypeModel->setType('hipchat', t('Hipchat'), '\Kanboard\Plugin\Hipchat\Notification\Hipchat');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginDescription()
    {
        return 'Receive notifications on Hipchat';
    }

    public function getPluginAuthor()
    {
        return 'Frédéric Guillot';
    }

    public function getPluginVersion()
    {
        return '1.0.6';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/kanboard/plugin-hipchat';
    }

    public function getCompatibleVersion()
    {
        return '>=1.0.37';
    }
}
