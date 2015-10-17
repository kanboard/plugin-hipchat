<?php

namespace Kanboard\Plugin\Hipchat\Notification;

use Kanboard\Core\Base;
use Kanboard\Notification\NotificationInterface;

/**
 * Hipchat Notification
 *
 * @package  notification
 * @author   Frederic Guillot
 */
class Hipchat extends Base implements NotificationInterface
{
    /**
     * Send notification to a user
     *
     * @access public
     * @param  array     $user
     * @param  string    $event_name
     * @param  array     $event_data
     */
    public function notifyUser(array $user, $event_name, array $event_data)
    {
        $api_token = $this->config->get('hipchat_api_token');

        if (! empty($user['email']) && ! empty($api_token)) {
            $project = $this->project->getById($event_data['task']['project_id']);

            $url = sprintf(
                '%s/v2/user/%s/message?auth_token=%s',
                $this->config->get('api_url', 'https://api.hipchat.com'),
                $user['email'],
                $api_token
            );

            $this->httpClient->postJson($url, $this->getMessage($project, $event_name, $event_data));
        }
    }

    /**
     * Send notification to a project
     *
     * @access public
     * @param  array     $project
     * @param  string    $event_name
     * @param  array     $event_data
     */
    public function notifyProject(array $project, $event_name, array $event_data)
    {
        $room_id = $this->projectMetadata->get($project['id'], 'hipchat_room_id');
        $token = $this->projectMetadata->get($project['id'], 'hipchat_room_token', $this->config->get('hipchat_api_token'));

        if (! empty($room_id) && ! empty($token)) {
            $url = sprintf(
                '%s/v2/room/%s/notification?auth_token=%s',
                $this->config->get('api_url', 'https://api.hipchat.com'),
                $room_id,
                $token
            );

            $this->httpClient->postJson($url, $this->getMessage($project, $event_name, $event_data));
        }
    }

    /**
     * Get message to send
     *
     * @access public
     * @param  array     $project
     * @param  string    $event_name
     * @param  array     $event_data
     */
    public function getMessage(array $project, $event_name, array $event_data)
    {
        if ($this->userSession->isLogged()) {
            $author = $this->user->getFullname($this->session['user']);
            $title = $this->notification->getTitleWithAuthor($author, $event_name, $event_data);
        } else {
            $title = $this->notification->getTitleWithoutAuthor($event_name, $event_data);
        }

        $html = '<img src="http://kanboard.net/assets/img/favicon-32x32.png"/>';
        $html .= '<strong>'.$project['name'].'</strong><br/>'.$event_data['task']['title'].'<br/>';
        $html .= $title;

        if ($this->config->get('application_url') !== '') {
            $html .= '<br/><a href="';
            $html .= $this->helper->url->to('task', 'show', array('task_id' => $event_data['task']['id'], 'project_id' => $project['id']), '', true);
            $html .= '">'.t('view the task on Kanboard').'</a>';
        }

        return array(
            'message' => $html,
            'color' => 'yellow',
            'message_format' => 'html',
        );
    }
}
