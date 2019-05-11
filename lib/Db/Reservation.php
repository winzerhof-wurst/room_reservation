<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Db;

use DateTime;
use Exception;
use OCP\AppFramework\Db\Entity;

/**
 * @method int getCustomerId()
 * @method void setCustomerId(int $id)
 * @method string getStartDate()
 * @method void setStartDate(string $date)
 * @method string getEndDate()
 * @method void setEndDate(string $date)
 */
class Reservation extends Entity {

	protected $customerId;
	protected $startDate;
	protected $endDate;

	public function __construct() {
		$this->addType('customer_id', 'int');
	}

	/**
	 * @throws Exception
	 */
	public function getStartDateAsDateTime(): DateTime {
		return new DateTime($this->startDate);
	}

	/**
	 * @throws Exception
	 */
	public function getEndDateAsDateTime(): DateTime {
		return new DateTime($this->endDate);
	}

	public function setStartDateTime(DateTime $date): void {
		$this->setStartDate($date->format('Y-m-d H:i:s'));
	}

	public function setEndDateTime(DateTime $date): void {
		$this->setEndDate($date->format('Y-m-d H:i:s'));
	}

}
