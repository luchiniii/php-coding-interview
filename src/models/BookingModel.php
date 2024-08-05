<?php

namespace Src\models;

use Src\helpers\Helpers;

class BookingModel {

	private $bookingData;

    private $helper;

	function __construct() {
        $this->helper = new Helpers();
		$string = file_get_contents(dirname(__DIR__) . '/../scripts/bookings.json');
		$this->bookingData = json_decode($string, true);
	}

	public function getBookings() {
		return $this->bookingData;
	}

    public function createBooking(array $data): array
    {
        $bookings = $this->getBookings();

        $data['id'] = end($bookings)['id'] + 1;
        $bookings[] = $data;

        $clientsDog = (new DogModel())->getDogsByClientId($data['clientid']);

        $average = array_sum(array_column($clientsDog, 'age')) / count($clientsDog);

        var_dump($average);
        die();

        $this->helper->putJson($bookings, 'bookings');

        return $data;
    }
}