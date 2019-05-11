<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Db;

use OCP\AppFramework\Db\Entity;

/**
 * @method int getReservationId()
 * @method void setReservationId(int $id)
 * @method int getRoomId()
 * @method void setRoomId(int $id);
 */
class ReservationRoom extends Entity {

	protected $reservationId;
	protected $roomId;

}
