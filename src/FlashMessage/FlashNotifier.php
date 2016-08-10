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
     * Last message key.
     *
     * @var int
     */
    private $lastKey = -1;

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
    public function info($message, $important = false)
    {
        $this->message($message, 'info', $important);

        return $this;
    }

    /**
     * Flash a success message.
     *
     * @param  string $message
     * @return $this
     */
    public function success($message, $important = false)
    {
        $this->message($message, 'success', $important);

        return $this;
    }

    /**
     * Flash an error message.
     *
     * @param  string $message
     * @return $this
     */
    public function error($message, $important = false)
    {
        $this->message($message, 'danger', $important);

        return $this;
    }

    /**
     * Flash a warning message.
     *
     * @param  string $message
     * @return $this
     */
    public function warning($message, $important = false)
    {
        $this->message($message, 'warning', $important);

        return $this;
    }

    /**
     * Flash a general message.
     *
     * @param  string $message
     * @param  string $level
     * @return $this
     */
    public function message($message, $level = 'info', $important = false)
    {
        $this->lastKey++;
        $this->messages[$this->lastKey] = $this->messageGenerator($message, $level, $important);
        $this->session->flash('flash_notification.messages', $this->messages);

        return $this;
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important($important = true)
    {
        return $this->setProperty('important', $important);
    }

    /**
     * Add an icon in front of the message
     *
     * @return $this
     */
    public function icon($icon = null)
    {
        return $this->setProperty('icon', $icon);
    }

    /**
     * Clear all messages
     *
     * @return $this
     */
    public function clear()
    {
        $this->lastKey  = -1;
        $this->messages = [];
        $this->session->flash('flash_notification.messages', $this->messages);

        return $this;
    }

    /**
     * Delete last message
     *
     * @return $this
     */
    public function delete()
    {
        if ($this->lastKey < 0) {
            return $this;
        }

        $this->lastKey--;
        array_pop($this->messages);

        $this->session->flash('flash_notification.messages', $this->messages);

        return $this;
    }

    private function setProperty($property, $value)
    {
        if (!isset($this->messages[$this->lastKey])) {
            return $this;
        }

        $this->messages[$this->lastKey][$property] = $value;

        $this->session->flash('flash_notification.messages', $this->messages);

        return $this;
    }

    private function messageGenerator($message, $level, $important, $icon = null)
    {
        return [
            'message'   => $message,
            'level'     => $level,
            'important' => $important,
            'icon'      => $icon,
        ];
    }

    private function udpateSesion()
    {
        $this->session->flash('flash_notification.messages', $this->messages);
        return $this;
    }
}

