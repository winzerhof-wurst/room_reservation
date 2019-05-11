<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Db;

use OCP\AppFramework\Db\QBMapper;
use OCP\IDBConnection;

class RequestMapper extends QBMapper {

	public function __construct(IDBConnection $db) {
		parent::__construct($db, 'reservation_requests');
	}

	/**
	 * @return Request[]
	 */
	public function findAll(): array {
		$qb = $this->db->getQueryBuilder();

		$query = $qb
			->select('*')
			->from($this->getTableName());

		return $this->findEntities($query);
	}

}
