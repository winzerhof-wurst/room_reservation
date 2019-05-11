<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Db;

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
 */
class Request extends Entity implements JsonSerializable {

	protected $firstname;
	protected $lastname;
	protected $phone;
	protected $email;
	protected $rooms;

	public function jsonSerialize() {
		return [
			'id' => $this->getId(),
			'firstname' => $this->getFirstname(),
			'lastname' => $this->getLastname(),
			'phone' => $this->getPhone(),
			'email' => $this->getEmail(),
			'rooms' => ($this->getRooms() === null ? null : json_decode($this->getRooms(), true)),
		];
	}
}
