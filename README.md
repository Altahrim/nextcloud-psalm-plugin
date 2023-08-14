# Nextcloud Psalm Plugin for applications

Export Nextcloud public API to your application 

## Installation
In your application directory:
```bash
composer require --dev altahrim/nextcloud-psalm-plugin
vendor/bin/psalm --init
vendor/bin/psalm-plugin enable altahrim/nextcloud-psalm-plugin
```

## Configuration
Force specific Nextcloud version:
```xml
<pluginClass class="Psalm\NextcloudPsalmPlugin\PluginEntry">
    <nextcloudVersion>28</nextcloudVersion>
</pluginClass>
```
Otherwise, version is detected from `appinfo/info.xml`

