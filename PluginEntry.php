<?php
declare(strict_types=1);

namespace Altahrim\NextcloudPsalmPlugin;

use SimpleXMLElement;
use Psalm\Plugin\PluginEntryPointInterface;
use Psalm\Plugin\RegistrationInterface;

class PluginEntry implements PluginEntryPointInterface
{
	public function __invoke(RegistrationInterface $psalm, ?SimpleXMLElement $config = null): void
	{
		$nextcloudBranch = isset($config->nextcloudVersion)
			? $config->nextcloudVersion
			: NextcloudVersion::get();
		echo 'Target Nextcloud version: ', $nextcloudBranch, PHP_EOL;
		$stubs = $this->listStubsForVersion($nextcloudBranch);
		foreach ($stubs as $stub) {
			$psalm->addStubFile($stub);
		}
	}

	/**
	 * @return string[]
	 */
	private function listStubsForVersion(string $branch): array
	{
		$dir = __DIR__ . '/stubs/' . $branch;
		if (!is_dir($dir)) {
			throw new \Exception('Invalid version ' . $branch);
		}

		return glob($dir . '/*.phpstub' ) ?: [];	
	}
}
