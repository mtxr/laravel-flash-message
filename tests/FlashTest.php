<?php

use \FlashMessage\FlashNotifier;
use Mockery as m;

class FlashTest extends PHPUnit_Framework_TestCase {

    protected $session;

    protected $flash;

	public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->session = m::mock('FlashMessage\SessionStore');
        return parent::__construct($name, $data, $dataName);
    }

    public function setUp()
    {
        $this->flash = new FlashNotifier($this->session);
    }

	/** @test */
    public function it_displays_default_flash_notifications()
    {
        $message = 'Test message';
        $data = [];
        $data[] = $this->messageGenerator($message, 'info', false);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->message($message);

        $message = 'Test message 2';
        $data[] = $this->messageGenerator($message, 'info', false);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->message($message);
    }

    /** @test */
    public function it_displays_info_flash_notifications()
    {
        $message = 'Test message';
        $data = [];
        $data[] = $this->messageGenerator($message, 'info', false);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->info($message);
    }

    /** @test */
    public function it_displays_success_flash_notifications()
    {
        $message = 'Test message';
        $data = [];
        $data[] = $this->messageGenerator($message, 'success', false);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->success($message);
    }

    /** @test */
    public function it_displays_error_flash_notifications()
    {
        $message = 'Test message';
        $data = [];
        $data[] = $this->messageGenerator($message, 'danger', false);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->error($message);
    }

    /** @test */
    public function it_displays_warning_flash_notifications()
    {
        $message = 'Test message';
        $data = [];
        $data[] = $this->messageGenerator($message, 'warning', false);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->warning($message);
    }

    /** @test */
    public function it_displays_notifications_with_icon()
    {
        $message = 'Test message';
        $data = [];
        $data[] = $this->messageGenerator($message, 'info', false);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);
        $this->flash->message($message);

        $data[0]['icon'] = 'fa fa-tv';
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);
        $this->flash->icon('fa fa-tv');
    }

    private function messageGenerator($message, $level, $important, $icon = null)
    {
        return [
            'message'   => $message,
            'level'     => $level,
            'important' => $important,
            'icon'      => $icon
        ];
    }
}
