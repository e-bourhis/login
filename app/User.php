<?php

namespace App;

/**
 * User model class
 */
class User
{
    private $db;
    private $username = false;
    private $id = false;
    private $level = false;
    private $errorHandler;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        $this->errorHandler = ErrorHandler::getInstance();
    }

    /**
     * Login the User
     * @param  string $username
     * @param  string $password
     */
    public function login($username, $password)
    {

        // Get the corresponding user
        $query = "SELECT * FROM users WHERE username = :name";

        $statement = $this->db->prepare($query);

        $statement->execute(array('name' => $username));

        $user= $statement->fetchAll();

        //if we fin a matching user
        if (count($user) == 1) {
            //if the password is correct
            if (password_verify($password, $user[0]['password'])) {
                // Set User data
                $this->setUserData($user[0]['id'], $user[0]['username'], $user[0]['level']);

                //Set session user variables
                $_SESSION['login'] = true;
                $_SESSION['userid'] = $this->id;

                $this->redirect();
            } else {
                $this->errorHandler->addError('password', "Wrong Password");
            }
        } else {
            $this->errorHandler->addError('username', "This user doesn't exist");
        }
    }

    /**
     * is the User logged In ?
     * @return boolean
     */
    public function isLoggedIn()
    {
        return $_SESSION['login'];
    }

    /**
     * Gets the Session User if the User is already Logged In
     */
    public function getSessionUser()
    {
        if ($_SESSION['login'] && $_SESSION['userid']) {

            //Get logged in user data
            $query = "SELECT * FROM users WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->execute(array('id' => $_SESSION['userid']));
            $user= $statement->fetch();

            $this->setUserData($user['id'], $user['username'], $user['level']);
        }
    }

    /**
     * Sets the current User data
     * @param string $id
     * @param string $username
     * @param string $level
     */
    public function setUserData($id, $username, $level)
    {
        $this->id = $id;
        $this->username = $username;
        $this->level = $level;
    }

    /**
     * Does the User have User permissions ?
     * @return boolean
     */
    public function isUser()
    {
        return ($this->level == 'user' || $this->level == 'admin' || $this->level == 'superadmin');
    }

    /**
     * Does the User have Admin permissions ?
     * @return boolean
     */
    public function isAdmin()
    {
        return ($this->level == 'admin' || $this->level == 'superadmin');
    }

    /**
     * Does the User have Super Admin permissions ?
     * @return boolean
     */
    public function isSuperAdmin()
    {
        return ($this->level == 'superadmin');
    }

    /**
     * Redirects the User to the right page depending on its User Level
     */
    public function redirect()
    {
        if ($this->isLoggedIn()) {
            if ($this->level) {
                switch ($this->level) {
          case 'user':
            header('Location: userPage.php');
            exit();
            break;
          case 'admin':
            header('Location: adminPage.php');
            exit();
            break;
          case 'superadmin':
            header('Location: superAdminPage.php');
            exit();
          break;
          default:
            $this->logout();
            echo "Error: Unknown User Level";
            exit;
          break;
        }
            } else {
                $this->logout();
            }
        } else {
            header('Location: /');
            exit();
        }
    }

    /**
     * Logout the User
     */
    public function logout()
    {
        session_destroy();
    }
}
