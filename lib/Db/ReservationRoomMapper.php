<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Db;

use DateTime;
use OCP\AppFramework\Db\QBMapper;
use OCP\DB\QueryBuilder\IQueryBuilder;
use OCP\IDBConnection;

class ReservationRoomMapper extends QBMapper {

	public function __construct(IDBConnection $db) {
		parent::__construct($db, 'reservation_reservation_rooms');
	}

	/**
	 * @param DateTime $start
	 * @param DateTime $end
	 * @param int[] $roomIds
	 * @return ReservationRoom[]
	 */
	public function findInTimeRange(DateTime $start, DateTime $end, array $roomIds): array {
		$qb = $this->db->getQueryBuilder();

		$query = $qb
			->select('reservation_rooms.*')
			->from('reservation_reservation_rooms', 'reservation_rooms')
			->join(
				'reservation_rooms',
				'reservation_reservations',
				'reservations',
				$qb->expr()->eq('reservation_rooms.reservation_id', 'reservations.id')
			)->where($qb->expr()->andX(
				$qb->expr()->in('reservation_rooms.room_id', $qb->createNamedParameter($roomIds, IQueryBuilder::PARAM_INT_ARRAY)),
				$qb->expr()->lte('reservations.start_date', $qb->createNamedParameter($start, IQueryBuilder::PARAM_DATE)),
				$qb->expr()->gte('reservations.end_date', $qb->createNamedParameter($end, IQueryBuilder::PARAM_DATE)),
				$qb->expr()->gte('reservations.end_date', $qb->createNamedParameter($start, IQueryBuilder::PARAM_DATE))
			));

		return $this->findEntities($query);
	}

}
