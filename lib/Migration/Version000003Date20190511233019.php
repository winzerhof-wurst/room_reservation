<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\SimpleMigrationStep;
use OCP\Migration\IOutput;

class Version000003Date20190511233019 extends SimpleMigrationStep {

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options) {
		/** @var ISchemaWrapper $schema */
		$schema = $schemaClosure();

		$roomsTable = $schema->getTable('reservation_requests');
		$roomsTable->addColumn('nr_of_people', 'integer', [
			'notnull' => true,
		]);
		$roomsTable->addColumn('nr_of_rooms', 'integer', [
			'notnull' => true,
		]);
		$roomsTable->addColumn('start_date', 'date', [
			'notnull' => true,
		]);
		$roomsTable->addColumn('end_date', 'date', [
			'notnull' => true,
		]);

		return $schema;
	}

}
