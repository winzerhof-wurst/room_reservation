<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Service;

use DateTime;

class BookingRequest {

	/** @var string */
	private $firstname;

	/** @var string */
	private $lastname;

	/** @var string */
	private $phone;

	/** @var string */
	private $email;

	/** @var DateTime */
	private $startDate;

	/** @var DateTime */
	private $endDate;

	public function __construct(string $firstname,
								string $lastname,
								string $phone,
								string $email,
								DateTime $startDate,
								DateTime $endDate) {
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->phone = $phone;
		$this->email = $email;
		$this->startDate = $startDate;
		$this->endDate = $endDate;
	}

}
