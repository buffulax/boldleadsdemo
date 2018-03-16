<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/11/18
 * Time: 8:49 PM
 */

namespace Example\Utility;

/**
 * Class Authentication
 * @package Example\Utility
 */
class Authentication
{
    const DEFAULT_SALT = '40afbd99939a1226ef82ee4dd7b1dcd0';

    /**
     * @function verify
     * @description Verify password string (with appended salt) against existing password hash
     * @author ccarlson79
     *
     * @param $string
     * @param $existingHash
     * @return bool
     */
    function verify($string, $existingHash) {

        $string = $string . self::DEFAULT_SALT;

        $hash = password_verify($string, $existingHash);

        return $hash;
    }

    /**
     * @function hash
     * @description Hash password string (with appended salt) default salt
     * @author ccarlson79
     *
     * @param $string
     * @return bool|string
     */
    public function hash($string)
    {
        $string = $string . self::DEFAULT_SALT;

        $hash = password_hash($string, PASSWORD_BCRYPT);

        return $hash;
    }
}