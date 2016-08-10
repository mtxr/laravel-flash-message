<?php

if ( ! function_exists('flash')) {

    /**
     * Arrange for a flash message.
     *
     * @param  string|null $message
     * @param  string      $level
     * @return FlashMessage\FlashNotifier
     */
    function flash($message = null, $level = 'info', $important = false)
    {
        $flasher = app('flash');

        if ( ! is_null($message)) {
            return $flasher->message($message, $level, $important);
        }

        return $flasher;
    }

}
