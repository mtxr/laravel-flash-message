<?php

use \FlashMessage\FlashNotifier;
use Mockery as m;

class FlashTest extends PHPUnit_Framework_TestCase {

    protected $session;

    protected $flash;

	public function setUp()
	{
        $this->session = m::mock('FlashMessage\SessionStore');
        $this->flash = new FlashNotifier($this->session);
	}

	/** @test */
	public function it_displays_default_flash_notifications()
	{
        $message = 'Test message';
        $data = [];
        $data[] = [
            'message'   => $message,
            'level'     => 'info',
            'important' => false,
        ];
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->message($message);

        $message = 'Test message 2';
        $data[] = [
            'message'   => $message,
            'level'     => 'info',
            'important' => false,
        ];
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->message($message);
	}

    /** @test */
    public function it_displays_info_flash_notifications()
    {
        $message = 'Test message';
        $data = [];
        $data[] = [
            'message'   => $message,
            'level'     => 'info',
            'important' => false,
        ];
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->info($message);
    }

	/** @test */
	public function it_displays_success_flash_notifications()
	{
        $message = 'Test message';
        $data = [];
        $data[] = [
            'message'   => $message,
            'level'     => 'success',
            'important' => false,
        ];
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

		$this->flash->success($message);
	}

	/** @test */
	public function it_displays_error_flash_notifications()
	{
        $message = 'Test message';
        $data = [];
        $data[] = [
            'message'   => $message,
            'level'     => 'danger',
            'important' => false,
        ];
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->error($message);
	}

    /** @test */
    public function it_displays_warning_flash_notifications()
    {
        $message = 'Test message';
        $data = [];
        $data[] = [
            'message'   => $message,
            'level'     => 'warning',
            'important' => false,
        ];
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);

        $this->flash->warning($message);
    }

    /** @test */
    public function it_displays_important_notifications()
    {
        $message = 'Test message';
        $data = [];
        $data[] = [
            'message'   => $message,
            'level'     => 'info',
            'important' => false,
        ];
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);
        $this->flash->message($message);

        $data[0]['important'] = true;
        $this->session->shouldReceive('flash')->with('flash_notification.messages', $data);
        $this->flash->important();

    }
}
