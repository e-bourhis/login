<?php

namespace App;

use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationException;

/**
 * App pages Controller
 */
class Controller
{
    private $user;
    private $errorHandler;

    public function __construct()
    {
        $this->user = new User;
        $this->errorHandler = ErrorHandler::getInstance();
    }

    /**
     * Index page Controller
     */
    public function index()
    {
        if ($this->user->isLoggedIn()) {
            if ($_GET['logout']=='true') {
                $this->user->logout();
            } else {
                //Get current session user
                $this->user->getSessionUser();

                $this->user->redirect();
            }
        } else {
            if ($_POST['username'] && $_POST['password']) {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);

                //Set Validation Rules
                $usernameV = Validator::alnum()->noWhitespace()->length(1, 50);
                $passwordV = Validator::stringType()->noWhitespace()->length(1, 50);

                //Apply validation rules and set Errors
                try {
                    $usernameV->assert($username);
                } catch (NestedValidationException $exception) {
                    foreach ($exception->getMessages() as $error) {
                        $this->errorHandler->addError('username', $error);
                    }
                }
                try {
                    $passwordV->assert($password);
                } catch (NestedValidationException $exception) {
                    $this->errorHandler->addError('password', "Incorrect password format");
                }

                //If Data is valid then log the user in
                if (!$this->errorHandler->hasError()) {
                    $this->user->login($username, $password);
                }
            }
        }
    }

    /**
     * Index page Controller
     */
    public function userPage()
    {
        if ($this->user->isLoggedIn()) {
            if ($_GET['logout']=='true') {
                $this->user->logout();
                $this->user->redirect();
            } else {
                //Get current session user
                $this->user->getSessionUser();

                if (!$this->user->isUser()) {
                    header('HTTP/1.0 403 Forbidden');
                    exit();
                }
            }
        } else {
            $this->user->redirect();
        }
    }

    /**
     * Admin page Controller
     */
    public function adminPage()
    {
        if ($this->user->isLoggedIn()) {
            if ($_GET['logout']=='true') {
                $this->user->logout();
                $this->user->redirect();
            } else {
                //Get current session user
                $this->user->getSessionUser();

                if (!$this->user->isAdmin()) {
                    header('HTTP/1.0 403 Forbidden');
                    exit();
                }
            }
        } else {
            $this->user->redirect();
        }
    }

    /**
     * Super Admin page Controller
     */
    public function superAdminPage()
    {
        if ($this->user->isLoggedIn()) {
            if ($_GET['logout']=='true') {
                $this->user->logout();
                $this->user->redirect();
            } else {
                //Get current session user
                $this->user->getSessionUser();

                if (!$this->user->isSuperAdmin()) {
                  header('HTTP/1.0 403 Forbidden');
                  exit();
                }
            }
        } else {
            $this->user->redirect();
        }
    }
}
