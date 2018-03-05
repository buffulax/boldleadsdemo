<?php

namespace Example\Controller\Pages;

use \Example\Controller\Framework\AbstractPageController;

/**
 * Class RegisterController
 * @package Example\Controller\Pages
 */
class RegisterController extends AbstractPageController {

    /** @var \Example\Block\Pages\HomeBlock $block */
    private $block;

    /** @var \Example\Model\Users\Users $users */
    private $users;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->block = new \Example\Block\Pages\HomeBlock();
        $this->users = new \Example\Model\Users\Users();
    }

    /**
     * @function home
     * @description home action
     */
    public function home() {
        $block = $this->block;
        require_once('./views/pages/register.phtml');
    }

    /**
     * @function create
     * @description create user action
     */
    public function create()
    {

        if (isset($_POST['email']) && !empty($_POST['email'])
            && isset($_POST['password']) && !empty($_POST['password'])
            && isset($_POST['firstname']) && !empty($_POST['firstname'])
            && isset($_POST['lastname']) && !empty($_POST['lastname'])) {

            try {

                $this->users->insertIntoUsers($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname']);

            } catch (\Exception $exception) {

                $this->is_error = true;
                $this->error_message = $exception->getMessage();

                require_once('./views/pages/error.phtml');
            }

            $_SESSION['is_message'] = true;
            $_SESSION['type_message'] = 'success';
            $_SESSION['message'] = 'Successfully Created User';

            $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
            header('Location: ' . $actual_link . '/index.php');
            die();

        } else {

            $_SESSION['is_message'] = true;
            $_SESSION['type_message'] = 'error';
            $_SESSION['message'] = 'Incomplete Data';
        }

    }

}