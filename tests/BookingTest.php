<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\controllers\Booking;

class BookingTest extends TestCase {

	private $booking;

	/**
	 * Setting default data
	 * @throws \Exception
	 */
	public function setUp(): void {
		parent::setUp();
		$this->booking = new Booking();
	}

	/** @test */
	public function getBookings() {
		$results = $this->booking->getBookings();

		$this->assertIsArray($results);
		$this->assertIsNotObject($results);

		$this->assertEquals($results[0]['id'], 1);
		$this->assertEquals($results[0]['clientid'], 1);
		$this->assertEquals($results[0]['price'], 200);
		$this->assertEquals($results[0]['checkindate'], '2021-08-04 15:00:00');
		$this->assertEquals($results[0]['checkoutdate'], '2021-08-11 15:00:00');
	}

    /** @test */
    public function createBooking()
    {
        $booking = [
            'clientid' => 2,
            'price' => 200,
            'checkindate' => '2021-08-04 15:00:00',
            'checkoutdate' => '2021-08-11 15:00:00'
        ];

        $results = $this->booking->createBooking($booking);

        $this->assertEquals($results['clientid'], $booking['clientid']);
        $this->assertEquals($results['price'], $booking['price']);
        $this->assertEquals($results['checkindate'], $booking['checkindate']);
        $this->assertEquals($results['checkoutdate'], $booking['checkoutdate']);

        $results = $this->booking->getBookings();

        $id = end($results)['id'];

        $this->assertEquals($results[$id - 1]['id'], $id);
        $this->assertEquals($results[$id - 1]['clientid'], $booking['clientid']);
        $this->assertEquals($results[$id - 1]['price'], $booking['price']);
        $this->assertEquals($results[$id - 1]['checkindate'], $booking['checkindate']);
        $this->assertEquals($results[$id - 1]['checkoutdate'], $booking['checkoutdate']);
    }
}
