<?php

namespace App;

/**
 * Handles all errors
 */
class ErrorHandler
{
    private $hasError = false;
    private $errors = array();
    private static $instance = null;

    /**
     * Create and/or Get the error Handler
     * @return ErrorHandler Instance of the error Handler
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ErrorHandler();
        }

        return self::$instance;
    }

    /**
     * Are there errors ?
     * @return boolean
     */
    public function hasError()
    {
        return $this->hasError;
    }

    /**
     * Adds an error
     * @param string $type  type of error
     * @param string $error error message
     */
    public function addError($type, $error)
    {
        $this->errors[$type][] = $error;
        $this->hasError = true;
    }

    /**
     * Returns all errors or a particular type
     * @param  string $type type of error
     * @return array Errors
     */
    public function getErrors($type = false)
    {
        if ($this->hasError) {
            if ($type) {
                return $this->errors[$type];
            } else {
                return $this->errors;
            }
        } else {
            return false;
        }
    }
}
