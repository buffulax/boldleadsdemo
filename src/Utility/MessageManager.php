<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/13/18
 * Time: 2:38 PM
 */

namespace Example\Utility;

/**
 * Class MessageManager
 * @package Example\Utility
 */
class MessageManager
{
    const SUCCESS = 'success';
    const ERROR = 'error';

    /**
     * @function addMessage
     * @description add message to array $_SESSION['is_message'][]
     * @author ccarlson79
     *
     * @param $type
     * @param $message
     */
    public function addMessage($type, $message)
    {
        if (!isset($_SESSION['is_message'])) {
            $_SESSION['is_message'] = [];
        }

        $_SESSION['is_message'][] =
            [
                'type' => $type,
                'message' => $message
            ];
    }

    /**
     * @function getNumberOfMessagesPending
     * @description Get the total number of messages pending
     * @author ccarlson79
     *
     * @return int
     */
    public function getNumberOfMessagesPending()
    {
        if (isset($_SESSION['is_message'])) {
            return count($_SESSION['is_message']);
        }

        return 0;
    }

    /**
     * @function clearAllMessages
     * @description Clears out all messages in the Session
     * @author ccarlson79
     */
    public function clearAllMessages()
    {
        if (isset($_SESSION['is_message'])) {
            unset($_SESSION['is_message']);
        }
    }

    /**
     * @function getAllMessages
     * @description Get All Messages from the Session
     * @author ccarlson79
     *
     * @return array
     */
    public function getAllMessages()
    {
        if (isset($_SESSION['is_message'])) {
            return $_SESSION['is_message'];
        }

        return [];
    }
}