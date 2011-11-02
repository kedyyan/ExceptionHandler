<?php

/**
 * A simple exception handler.
 *
 * @author  Fabien Nouaillat
 * @version 1.1
 */
class ExceptionHandler
{
    protected $file;
    protected $line;
    protected $message;
    protected $template;
    protected $type;

    /**
     * Turns on exception handling.
     *
     * @param  $template The path of the template file
     *
     * @throws InvalidArgumentException if the file cannot be found
     */
    public function start($template)
    {
        // Checks the file
        if (!is_file($template)):
            throw new \InvalidArgumentException(sprintf(
                'The file %s cannot be found.', $template
            ));
        endif;

        // Launches the output buffer
        ob_start();
        $this->template = $template;
        set_exception_handler(array($this, 'register'));
    }

    /**
     * Turns off exception handling and restores the previous configuration.
     *
     */
    public function stop()
    {
        // Shuts down the output buffer
        ob_end_flush();
        restore_exception_handler();
    }

    /**
     * Transforms errors into exceptions
     *
     * @param mixed $level The degree of error reporting
     */
    public function handleErrorsWithLevel($level)
    {
        error_reporting($level);

        set_error_handler(
            function($severity, $message, $filename, $lineno) use ($level)
            {
                throw new \ErrorException(
                    $message, 0, $severity, $filename, $lineno
                );
            }
        );
    }

    /**
     * Assignes the exception data to the object's properties
     *
     * @param Object $exception
     */
    public function register($exception)
    {
        $this->file    = $exception->getFile();
        $this->line    = $exception->getLine();
        $this->message = $exception->getMessage();
        $this->type    = get_class($exception);

        $this->display();
    }

    /**
     * Calls the template, parse it and display it.
     *
     */
    protected function display()
    {
        $stream     = file_get_contents($this->template);
        $properties = get_object_vars($this);

        // Replaces each property by its value
        foreach ($properties as $key => $value):
            $variable = sprintf('{{ %s }}',  $key);
            $stream = str_replace($variable, $value, $stream);
        endforeach;

        // Erases the output buffer
        ob_end_clean();

        // Displays the template
        echo $stream;
    }
}