<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Service;

final class BookingResult {

	private const RESULT_BOOKED = 0;
	private const RESULT_CONFLICT = 1;
	private const RESULT_ERROR_OTHER = 2;

	/** @var int */
	private $type;

	private function __construct(int $type) {
		$this->type = $type;
	}

	public static function booked(): BookingResult {
		return new self(self::RESULT_BOOKED);
	}

	public static function conclict(): BookingResult {
		return new self(self::RESULT_CONFLICT);
	}

	public static function error(): BookingResult {
		return new self(self::RESULT_ERROR_OTHER);
	}

}
