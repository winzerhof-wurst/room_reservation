<?php

namespace OCA\RoomReservation\Db;

use OCA\RoomReservation\Exception\ReservationConflict;
use OCP\AppFramework\Db\QBMapper;
use OCP\IDBConnection;

class ReservationMapper extends QBMapper {

	/** @var ReservationRoomMapper */
	private $reservationRoomMapper;

	public function __construct(IDBConnection $db,
								ReservationRoomMapper $reservationRoomMapper) {
		parent::__construct($db, 'reservation_reservations');
		$this->reservationRoomMapper = $reservationRoomMapper;
	}

	/**
	 * @todo locking
	 *
	 * @param Reservation $reservation
	 * @param int[] $roomIds
	 * @throws ReservationConflict
	 */
	public function create(Reservation $reservation, array $roomIds): void {
		$this->throwIfExisting($reservation, $roomIds);

		$this->insert($reservation);
		foreach ($roomIds as $roomId) {
			$entity = new ReservationRoom();
			$entity->setReservationId($reservation->getId());
			$entity->setRoomId($roomId);
			$this->reservationRoomMapper->insert($entity);
		}
	}

	/**
	 * @param Reservation $reservation
	 * @param int[] $roomIds
	 * @throws ReservationConflict
	 */
	private function throwIfExisting(Reservation $reservation, array $roomIds): void {
		$existing = $this->reservationRoomMapper->findInTimeRange(
			$reservation->getStartDateAsDateTime(),
			$reservation->getEndDateAsDateTime(),
			$roomIds
		);
		if (count($existing) > 0) {
			$conflictReservations = [];
			$conflictRooms = [];

			foreach ($existing as $reservationRoom) {
				$conflictReservations[] = $reservationRoom->getReservationId();
				$conflictRooms[] = $reservationRoom->getRoomId();
			}

			throw new ReservationConflict(
				array_unique($conflictReservations),
				array_unique($conflictRooms)
			);
		}
	}

}
