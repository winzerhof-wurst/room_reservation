<?php

declare(strict_types=1);

namespace OCA\RoomReservation\Controller;

use Exception;
use OCA\Mail\Contracts\IUserPreferences;
use OCA\Mail\Http\JSONResponse;
use OCA\Mail\Service\AccountService;
use OCA\Mail\Service\AliasesService;
use OCA\Mail\Service\MailManager;
use OCA\RoomReservation\AppInfo\Application;
use OCA\RoomReservation\Db\RequestMapper;
use OCA\RoomReservation\Db\RoomMapper;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\ContentSecurityPolicy;
use OCP\AppFramework\Http\RedirectResponse;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\IInitialStateService;
use OCP\IRequest;
use OCP\IURLGenerator;
use OCP\IUserSession;

class PageController extends Controller {

	/** @var IInitialStateService */
	private $initialStateService;

	/** @var RoomMapper */
	private $roomMapper;

	/** @var RequestMapper */
	private $requestMapper;

	public function __construct(string $appName,
								IRequest $request,
								IInitialStateService $initialStateService,
								RoomMapper $roomMapper,
								RequestMapper $requestMapper) {
		parent::__construct($appName, $request);
		$this->initialStateService = $initialStateService;
		$this->roomMapper = $roomMapper;
		$this->requestMapper = $requestMapper;
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @return TemplateResponse renders the index page
	 */
	public function index(): TemplateResponse {
		$this->initialStateService->provideInitialState(
			Application::APP_ID,
			'rooms',
			$this->roomMapper->findAll()
		);
		$this->initialStateService->provideInitialState(
			Application::APP_ID,
			'requests',
			$this->requestMapper->findAll()
		);

		return new TemplateResponse($this->appName, 'index');
	}

}
