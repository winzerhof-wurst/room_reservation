<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Exception;

class ReservationConflict extends ServiceException {

	/** @var int[] */
	private $reservationIds;

	/** @var int[] */
	private $roomIds;

	public function __construct(array $reservationIds, array $roomIds) {
		parent::__construct("Reservation conflict");
		$this->reservationIds = $reservationIds;
		$this->roomIds = $roomIds;
	}

}
