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

        $this->userNotificationType->setType('hipchat', t('Hipchat'), '\Kanboard\Plugin\Hipchat\Notification\Hipchat');
        $this->projectNotificationType->setType('hipchat', t('Hipchat'), '\Kanboard\Plugin\Hipchat\Notification\Hipchat');

        $this->on('session.bootstrap', function($container) {
            Translator::load($container['config']->getCurrentLanguage(), __DIR__.'/Locale');
        });
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
        return '1.0.1';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/kanboard/plugin-hipchat';
    }
}
