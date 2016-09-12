<?php

use \FlashMessage\FlashNotifier;
use Mockery as m;

class ImportantTest extends PHPUnit_Framework_TestCase {

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
    public function it_displays_important_default_flash_notifications()
    {
        $message = 'Test message';
        $data = [];
        $important = true;
        $data[] = $this->messageGenerator($message, 'info', $important);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->message($message, 'info', $important);

        $message = 'Test message 2';
        $important = true;
        $data[] = $this->messageGenerator($message, 'danger', $important);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->message($message, 'danger', $important);
    }

    /** @test */
    public function it_displays_important_info_flash_notifications()
    {
        $message = 'Test message';
        $data = [];
        $important = true;
        $data[] = $this->messageGenerator($message, 'info', $important);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->info($message, $important);
    }

    /** @test */
    public function it_displays_important_success_flash_notifications()
    {
        $message = 'Test message';
        $data = [];
        $important = true;
        $data[] = $this->messageGenerator($message, 'success', $important);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->success($message, $important);
    }

    /** @test */
    public function it_displays_important_error_flash_notifications()
    {
        $message = 'Test message';
        $data = [];
        $important = true;
        $data[] = $this->messageGenerator($message, 'danger', $important);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->error($message, $important);
    }

    /** @test */
    public function it_displays_important_warning_flash_notifications()
    {
        $message = 'Test message';
        $data = [];
        $important = true;
        $data[] = $this->messageGenerator($message, 'warning', $important);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->warning($message, $important);
    }

    /** @test */
    public function it_displays_important_notifications()
    {
        $message = 'Test message';
        $data = [];
        $data[] = $this->messageGenerator($message, 'info', false);
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);
        $this->flash->message($message);

        $data[0]['important'] = true;
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);
        $this->flash->important();
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
