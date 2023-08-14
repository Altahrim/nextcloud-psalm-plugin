<?php
declare(strict_types=1);

namespace Altahrim\NextcloudPsalmPlugin;

final class NextcloudVersion {
	public const LATEST_VERSION = 'master';

	public static function get(): string 
	{
		if (!is_readable('appinfo/info.xml')) {
			return self::LATEST_VERSION;
		}

		$appInfo = simplexml_load_file('appinfo/info.xml');
		$nextcloudVersion = $appInfo?->dependencies?->nextcloud;
		if (null === $nextcloudVersion) {
			return self::LATEST_VERSION;
		}

		if (isset($nextcloudVersion['min-version'])) {
			return 'stable' . $nextcloudVersion['min-version'];
		}
		if (isset($nextcloudVersion['max-version'])) {
			return 'stable' . $nextcloudVersion['max-version'];
		}

		return self::LATEST_VERSION;
	}

	private function __construct() {}
}
