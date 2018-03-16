<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/13/18
 * Time: 8:01 PM
 */

namespace Example\Utility;

/**
 * Class Redirector
 * @package Example\Utility
 */
class Redirector
{
    /**
     * @function redirect
     * @description redirects user
     * @author ccarlson79
     *
     * @param string $controller
     * @param string $action
     * @param array $gets
     */
    public function redirect($controller = 'pages', $action = 'error', $gets = [])
    {
        $additional = '';

        if (!empty($gets)):
            foreach ($gets as $key => $value):
                $additional = $additional . '&'. $key.'='.$value;
            endforeach;
        endif;

        $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
        header('Location: ' . $actual_link . '/?controller='.$controller.'&action='.$action.$additional);
        die();
    }
}