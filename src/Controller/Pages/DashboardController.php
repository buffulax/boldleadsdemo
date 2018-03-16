<?php

namespace Example\Controller\Pages;

use \Example\Controller\Framework\AbstractPageController;
use \Example\Block\Pages\DashboardBlock;
use \Example\Model\Framework\Collection;
use \Example\Model\Users\UsersModel;
use \Example\Utility\MessageManager;

/**
 * Class DashboardController
 * @package Example\Controller\Pages
 */
class DashboardController extends AbstractPageController {

    /** @var \Example\Block\Pages\DashboardBlock $block */
    private $block;

    /** @var \Example\Utility\Authentication $authentication */
    private $authentication;

    /** @var \Example\Model\Users\UsersGateway $usersGateway */
    private $usersGateway;

    /** @var \Example\Model\Users\UsersFactory $usersFactory */
    private $usersFactory;

    /** @var \Example\Utility\UserSession $userSession */
    private $userSession;

    /** @var \Example\Utility\MessageManager $messageManager */
    private $messageManager;

    /** @var \Example\Utility\Redirector $redirector */
    private $redirector;

    /**
     * DashboardController constructor.
     *
     * @param DashboardBlock $block
     * @param \Example\Utility\Authentication $authentication
     * @param \Example\Model\Users\UsersGateway $usersGateway
     * @param \Example\Model\Users\UsersFactory $usersFactory
     * @param \Example\Utility\UserSession $userSession
     * @param MessageManager $messageManager
     * @param \Example\Utility\Redirector $redirector
     */
    public function __construct(
        \Example\Block\Pages\DashboardBlock $block,
        \Example\Utility\Authentication $authentication,
        \Example\Model\Users\UsersGateway $usersGateway,
        \Example\Model\Users\UsersFactory $usersFactory,
        \Example\Utility\UserSession $userSession,
        \Example\Utility\MessageManager $messageManager,
        \Example\Utility\Redirector $redirector
    ) {
        $this->block = $block;
        $this->authentication = $authentication;
        $this->usersGateway = $usersGateway;
        $this->usersFactory = $usersFactory;
        $this->userSession = $userSession;
        $this->messageManager = $messageManager;
        $this->redirector = $redirector;
    }

    /**
     * @function home
     * @description home action
     * @author ccarlson79
     */
    public function home() {

        if ($this->userSession->getIsLoggedIn()) {
            $block = $this->block;
            require_once('./views/pages/dashboard.phtml');
        } else {
            $this->messageManager->addMessage(MessageManager::ERROR, 'Please login or register');

            $this->redirector->redirect('dashboard', 'register');
        }

    }

    /**
     * @function register
     * @description register action
     * @author ccarlson79
     */
    public function register()
    {
        if ($this->userSession->getIsLoggedIn()) {
            $this->redirector->redirect('dashboard', 'home');
        } else {
            $block = $this->block;
            require_once('./views/pages/register.phtml');
        }
    }

    /**
     * @function registeruser
     * @description registeruser action
     * @author ccarlson79
     */
    public function registeruser()
    {

        if (isset($_POST['email']) && !empty($_POST['email'])
            && isset($_POST['password']) && !empty($_POST['password'])
            && isset($_POST['firstname']) && !empty($_POST['firstname'])
            && isset($_POST['lastname']) && !empty($_POST['lastname'])) {


            if ($this->usersGateway->getUsersByEmail($_POST['email'])->count() == 0):

                $hash = $this->authentication->hash($_POST['password']);

                $user = $this->usersFactory->create();
                $user->setEmail($_POST['email'])
                    ->setHash($hash)
                    ->setFirstname($_POST['firstname'])
                    ->setLastname($_POST['lastname']);

                $user = $this->usersGateway->saveUser($user);

                $this->userSession->setIsLoggedIn(true)->setCustomerId($user->getId());

                $this->messageManager->addMessage(MessageManager::SUCCESS, 'Thanks for registering '.$user->getFirstname());
                $this->redirector->redirect('dashboard', 'home');

            else:

                $this->messageManager->addMessage(MessageManager::ERROR, 'Email is already taken');
                $this->redirector->redirect('dashboard', 'register');

            endif;

        } else {

            $this->messageManager->addMessage(MessageManager::ERROR, 'Missing some form data');
            $this->redirector->redirect('dashboard', 'register');
        }
    }

    /**
     * @function loginuser
     * @description loginuser action
     * @author ccarlson79
     */
    public function loginuser()
    {
        if (isset($_POST['email']) && !empty($_POST['email'])
            && isset($_POST['password']) && !empty($_POST['password'])) {

            /** @var Collection $usersCollection */
            $usersCollection = $this->usersGateway->getUsersByEmail($_POST['email']);

            if ($usersCollection->count()) {

                /** @var UsersModel $user */
                $user = $usersCollection->getFirstItem();

                if ($this->authentication->verify($_POST['password'], $user->getHash())):

                    $this->userSession->setIsLoggedIn(true)->setCustomerId($user->getId());

                    $this->messageManager->addMessage(MessageManager::SUCCESS, 'Welcome '.$user->getFirstname());
                    $this->redirector->redirect('dashboard', 'home');

                else :

                    $this->messageManager->addMessage(MessageManager::ERROR, 'Invalid Credentials');
                    $this->redirector->redirect('dashboard', 'register');
                endif;

            } else {
                $this->messageManager->addMessage(MessageManager::ERROR, 'User doesn\'t exist');
                $this->redirector->redirect('dashboard', 'register');
            }

        } else {

            $this->messageManager->addMessage(MessageManager::ERROR, 'Missing email and/or password');

            $this->redirector->redirect('dashboard', 'register');
        }
    }

    /**
     * @function logoutuser
     * @description logoutuser action
     * @author ccarlson79
     */
    public function logoutuser()
    {
        if ($this->userSession->getIsLoggedIn()) {
            $this->userSession->setIsLoggedIn(false);

            $this->messageManager->addMessage(MessageManager::SUCCESS, 'Goodbye!');
        }

        $this->redirector->redirect('dashboard', 'register');
    }
}