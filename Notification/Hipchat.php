<?php

namespace Kanboard\Plugin\Hipchat\Notification;

use Kanboard\Core\Base;
use Kanboard\Core\Notification\NotificationInterface;
use Kanboard\Model\TaskModel;

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
        $api_token = $this->configModel->get('hipchat_api_token');

        if (! empty($user['email']) && ! empty($api_token)) {
            $url = sprintf(
                '%s/v2/user/%s/message?auth_token=%s',
                $this->configModel->get('hipchat_api_url', 'https://api.hipchat.com'),
                $user['email'],
                $api_token
            );

            if ($event_name === TaskModel::EVENT_OVERDUE) {
                foreach ($event_data['tasks'] as $task) {
                    $project = $this->projectModel->getById($task['project_id']);
                    $eventData['task'] = $task;
                    $this->httpClient->postJson($url, $this->getMessage($project, $event_name, $event_data));
                }
            } else {
                $project = $this->projectModel->getById($event_data['task']['project_id']);
                $this->httpClient->postJson($url, $this->getMessage($project, $event_name, $event_data));
            }
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
        $room_id = $this->projectMetadataModel->get($project['id'], 'hipchat_room_id');
        $token = $this->projectMetadataModel->get($project['id'], 'hipchat_room_token', $this->configModel->get('hipchat_api_token'));

        if (! empty($room_id) && ! empty($token)) {
            $url = sprintf(
                '%s/v2/room/%s/notification?auth_token=%s',
                $this->configModel->get('hipchat_api_url', 'https://api.hipchat.com'),
                $room_id,
                $token
            );

            $this->httpClient->postJsonAsync($url, $this->getMessage($project, $event_name, $event_data));
        }
    }

    /**
     * Get message to send
     *
     * @access public
     * @param  array     $project
     * @param  string    $event_name
     * @param  array     $event_data
     * @return array
     */
    public function getMessage(array $project, $event_name, array $event_data)
    {
        if ($this->userSession->isLogged()) {
            $author = $this->helper->user->getFullname();
            $title = $this->notificationModel->getTitleWithAuthor($author, $event_name, $event_data);
        } else {
            $title = $this->notificationModel->getTitleWithoutAuthor($event_name, $event_data);
        }

        $html = '<img src="https://kanboard.net/assets/img/favicon-32x32.png"/>';
        $html .= '<strong>'.$project['name'].'</strong><br/>'.$event_data['task']['title'].'<br/>';
        $html .= $title;

        if ($this->configModel->get('application_url') !== '') {
            $html .= '<br/><a href="';
            $html .= $this->helper->url->to('TaskViewController', 'show', array('task_id' => $event_data['task']['id'], 'project_id' => $project['id']), '', true);
            $html .= '">'.t('view the task on Kanboard').'</a>';
        }

        return array(
            'message' => $html,
            'color' => 'yellow',
            'message_format' => 'html',
        );
    }
}
