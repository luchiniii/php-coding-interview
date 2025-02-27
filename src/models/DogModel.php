<?php

namespace Src\models;

use Src\helpers\Helpers;

class DogModel {

	private $dogData;

	function __construct() {
		$this->helper = new Helpers();
		$string = file_get_contents(dirname(__DIR__) . '/../scripts/dogs.json');
		$this->dogData = json_decode($string, true);
	}

	public function getDogs() {
		return $this->dogData;
	}

    public function getDogsByClientId(int $id)
    {
        return array_filter($this->dogData, function ($dog) use ($id) {
            return $dog['clientid'] === $id;
        });
    }
}