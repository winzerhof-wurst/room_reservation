<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Db;

use DateTime;
use JsonSerializable;
use OCP\AppFramework\Db\Entity;

/**
 * @method string getFirstname()
 * @method void setFirstname(string $firstname)
 * @method string getLastname()
 * @method void setLastname(string $lastname)
 * @method string getPhone()
 * @method void setPhone(string $phone)
 * @method string getEmail()
 * @method void setEmail(string $email)
 * @method string getRooms()
 * @method void setRooms(string $rooms)
 * @method int getNrOfPeople()
 * @method void setNumberOfPeople(int $numberOfPeole)
 * @method int getNumberOfRooms()
 * @method void setNumberOfRooms(int $nrOfRooms)
 * @method string getStartDate()
 * @method void setStartDate(string $startDate)
 * @method string getEndDate()
 * @method void setEndDate(string $endDate)
 */
class Request extends Entity implements JsonSerializable {

	protected $firstname;
	protected $lastname;
	protected $phone;
	protected $email;
	protected $rooms;
	protected $nrOfPeople;
	protected $nrOfRooms;
	protected $startDate;
	protected $endDate;

	public function __construct() {
		$this->addType('nr_of_rooms', 'int');
		$this->addType('nr_of_people', 'int');
	}

	public function jsonSerialize() {
		return [
			'id' => $this->getId(),
			'firstname' => $this->getFirstname(),
			'lastname' => $this->getLastname(),
			'phone' => $this->getPhone(),
			'email' => $this->getEmail(),
			'rooms' => ($this->getRooms() === null ? null : json_decode($this->getRooms(), true)),
			'nrOfRooms' => $this->getNrOfRooms(),
			'nrOfPeople' => $this->getNrOfPeople(),
			'startDate' => $this->getStartDateAsDateTime()->format('c'),
			'endDate' => $this->getEndDateAsDateTime()->format('c'),
		];
	}

	private function getStartDateAsDateTime(): DateTime {
		return new DateTime($this->getStartDate());
	}

	private function getEndDateAsDateTime(): DateTime {
		return new DateTime($this->getEndDate());
	}

	public function setStartDateTime(DateTime $date): void {
		$this->setStartDate($date->format('Y-m-d H:i:s'));
	}

	public function setEndDateTime(DateTime $date): void {
		$this->setEndDate($date->format('Y-m-d H:i:s'));
	}

}
