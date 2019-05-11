<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Db;

use JsonSerializable;
use OCP\AppFramework\Db\Entity;

/**
 * @method string getName()
 * @method void setName(string $name)
 */
class Room extends Entity implements JsonSerializable {

	protected $name;

	public function jsonSerialize() {
		return [
			'id' => $this->getId(),
			'name' => $this->getName(),
		];
	}
	
}
