<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\SimpleMigrationStep;
use OCP\Migration\IOutput;

class Version000002Date20190511223225 extends SimpleMigrationStep {

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return null|ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options) {
		/** @var ISchemaWrapper $schema */
		$schema = $schemaClosure();

		$roomsTable = $schema->createTable('reservation_requests');
		$roomsTable->addColumn('id', 'integer', [
			'autoincrement' => true,
			'notnull' => true,
			'unsigned' => true,
		]);
		$roomsTable->addColumn('firstname', 'string', [
			'notnull' => true,
			'length' => 128,
		]);
		$roomsTable->addColumn('lastname', 'string', [
			'notnull' => true,
			'length' => 128,
		]);
		$roomsTable->addColumn('email', 'string', [
			'notnull' => true,
			'length' => 128,
		]);
		$roomsTable->addColumn('phone', 'string', [
			'notnull' => true,
			'length' => 128,
		]);
		$roomsTable->addColumn('rooms', 'json', [
			'notnull' => false,
		]);
		$roomsTable->setPrimaryKey(['id']);

		return $schema;
	}

}
