<?php

namespace FlashMessage;

class FlashNotifier
{
    /**
     * The session writer.
     *
     * @var SessionStore
     */
    private $session;

    /**
     * Array of messages.
     *
     * @var Array
     */
    private $messages = [];
    /**
     * Create a new flash notifier instance.
     *
     * @param SessionStore $session
     */
    function __construct(SessionStore $session)
    {
        $this->session = $session;
    }

    /**
     * Flash an information message.
     *
     * @param  string $message
     * @return $this
     */
    public function info($message)
    {
        $this->message($message, 'info');

        return $this;
    }

    /**
     * Flash a success message.
     *
     * @param  string $message
     * @return $this
     */
    public function success($message)
    {
        $this->message($message, 'success');

        return $this;
    }

    /**
     * Flash an error message.
     *
     * @param  string $message
     * @return $this
     */
    public function error($message)
    {
        $this->message($message, 'danger');

        return $this;
    }

    /**
     * Flash a warning message.
     *
     * @param  string $message
     * @return $this
     */
    public function warning($message)
    {
        $this->message($message, 'warning');

        return $this;
    }

    /**
     * Flash a general message.
     *
     * @param  string $message
     * @param  string $level
     * @return $this
     */
    public function message($message, $level = 'info')
    {
        $this->messages[] = [
            'message'   => $message,
            'level'     => $level,
            'important' => false,
        ];
        $this->session->flash('flash_notification.messages', $this->messages);

        return $this;
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important()
    {
        if (empty($this->messages)) {
            return $this;
        }

        $this->messages[key(array_slice($this->messages, -1, 1,TRUE))]['important'] = true;
        $this->session->flash('flash_notification.messages', $this->messages);

        return $this;
    }

    /**
     * Clear all messages
     *
     * @return $this
     */
    public function clear()
    {
        $this->messages = [];
        $this->session->forget('flash_notification.messages');
    }
}

