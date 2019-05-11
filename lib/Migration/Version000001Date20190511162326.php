<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\SimpleMigrationStep;
use OCP\Migration\IOutput;

class Version000001Date20190511162326 extends SimpleMigrationStep {

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options) {
		/** @var ISchemaWrapper $schema */
		$schema = $schemaClosure();

		$roomsTable = $schema->createTable('reservation_rooms');
		$roomsTable->addColumn('id', 'integer', [
			'autoincrement' => true,
			'notnull' => true,
			'unsigned' => true,
		]);
		$roomsTable->addColumn('name', 'string', [
			'notnull' => true,
			'length' => 64,
		]);
		$roomsTable->setPrimaryKey(['id']);

		$customerTable = $schema->createTable('reservation_customer');
		$customerTable->addColumn('id', 'integer', [
			'autoincrement' => true,
			'notnull' => true,
			'unsigned' => true,
		]);
		$customerTable->addColumn('firstname', 'string', [
			'notnull' => true,
			'length' => 128,
		]);
		$customerTable->addColumn('lastname', 'string', [
			'notnull' => true,
			'length' => 128,
		]);
		$customerTable->addColumn('email', 'string', [
			'notnull' => true,
			'length' => 128,
		]);
		$customerTable->addColumn('phone', 'string', [
			'notnull' => true,
			'length' => 128,
		]);
		$customerTable->setPrimaryKey(['id']);

		$reservationTable = $schema->createTable('reservation_reservations');
		$reservationTable->addColumn('id', 'integer', [
			'autoincrement' => true,
			'notnull' => true,
			'unsigned' => true,
		]);
		$reservationTable->addColumn('customer_id', 'integer', [
			'notnull' => true,
		]);
		$reservationTable->addColumn('start_date', 'date', [
			'notnull' => true,
		]);
		$reservationTable->addColumn('end_date', 'date', [
			'notnull' => true,
		]);
		$reservationTable->setPrimaryKey(['id']);

		$reservationRoomTable = $schema->createTable('reservation_reservation_rooms');
		$reservationRoomTable->addColumn('room_id', 'integer', [
			'notnull' => true,
			'unsigned' => true,
		]);
		$reservationRoomTable->addColumn('reservation_id', 'integer', [
			'notnull' => true,
			'unsigned' => true,
		]);
		$reservationRoomTable->setPrimaryKey(['room_id', 'reservation_id']);

		return $schema;
	}

}
