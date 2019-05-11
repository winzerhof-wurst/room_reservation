<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Test\Integration\Db;

use ChristophWurst\Nextcloud\Testing\DatabaseTransaction;
use ChristophWurst\Nextcloud\Testing\TestCase;
use DateTime;
use OC;
use OCA\RoomReservation\Db\Reservation;
use OCA\RoomReservation\Db\ReservationMapper;
use OCA\RoomReservation\Exception\ReservationConflict;
use OCP\IDBConnection;

class ReservationMapperTest extends TestCase {

	use DatabaseTransaction;

	/** @var IDBConnection */
	private $db;

	/** @var ReservationMapper */
	private $mapper;

	protected function setUp() {
		parent::setUp();

		$this->db = OC::$server->getDatabaseConnection();
		$this->mapper = OC::$server->query(ReservationMapper::class);
	}

	public function testCreateConflict() {
		$today = new DateTime();
		$today->setTime(0, 0);
		$yesterday = clone $today;
		$yesterday->modify('-1 day');
		$tomorrow = clone $today;
		$tomorrow->modify('+1 day');
		$roomId = random_int(1, 10000);
		$existingReservationId = random_int(1, 10000);
		$qb1 = $this->db->getQueryBuilder();
		$qb1
			->insert('reservation_reservations')
			->values([
				'id' => $qb1->createNamedParameter($existingReservationId),
				'customer_id' => $qb1->createNamedParameter(321),
				'start_date' => $qb1->createNamedParameter($yesterday->format('Y-m-d H:i:s')),
				'end_date' => $qb1->createNamedParameter($tomorrow->format('Y-m-d H:i:s')),
			])
			->execute();
		$qb2 = $this->db->getQueryBuilder();
		$qb2
			->insert('reservation_reservation_rooms')
			->values([
				'reservation_id' => $qb2->createNamedParameter($existingReservationId),
				'room_id' => $qb2->createNamedParameter($roomId),
			])
			->execute();
		$this->expectException(ReservationConflict::class);

		$reservation = new Reservation();
		$reservation->setCustomerId(13);
		$reservation->setStartDateTime($today);
		$reservation->setEndDateTime($tomorrow);
		$this->mapper->create($reservation, [$roomId]);
	}

	public function testCreateAlmostOverlapping() {
		$today = new DateTime();
		$today->setTime(0, 0);
		$yesterday = clone $today;
		$yesterday->modify('-1 day');
		$tomorrow = clone $today;
		$tomorrow->modify('+1 day');
		$roomId = random_int(1, 10000);
		$existingReservationId = random_int(1, 10000);
		$qb1 = $this->db->getQueryBuilder();
		$qb1
			->insert('reservation_reservations')
			->values([
				'id' => $qb1->createNamedParameter($existingReservationId),
				'customer_id' => $qb1->createNamedParameter(321),
				'start_date' => $qb1->createNamedParameter($yesterday->format('Y-m-d H:i:s')),
				'end_date' => $qb1->createNamedParameter($today->format('Y-m-d H:i:s')),
			])
			->execute();
		$qb2 = $this->db->getQueryBuilder();
		$qb2
			->insert('reservation_reservation_rooms')
			->values([
				'reservation_id' => $qb2->createNamedParameter($existingReservationId),
				'room_id' => $qb2->createNamedParameter($roomId),
			])
			->execute();

		$reservation = new Reservation();
		$reservation->setCustomerId(13);
		$reservation->setStartDateTime($today);
		$reservation->setEndDateTime($tomorrow);
		$this->mapper->create($reservation, [$roomId]);
		$this->assertNotNull($reservation->getId());
	}

}
