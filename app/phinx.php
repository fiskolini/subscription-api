<?php


use Barkyn\Application\Configuration\DbConfig;
use Barkyn\Application\DiContainer;

try {
    $container = (new DiContainer())->build();
} catch (Exception $exception) {
    exit("Error running application. {$exception->getMessage()}");
}

/** @var DbConfig $config */
$config = $container->get(DbConfig::class);

return
    [
        'paths'         => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/src/Persistence/Db/Migrations',
            'seeds'      => '%%PHINX_CONFIG_DIR%%/src/Persistence/Db/Seeds'
        ],
        'environments'  => [
            'default_migration_table' => 'phinxlog',
            'default_environment'     => 'development',
            'development'             => [
                'adapter'   => 'pgsql',
                'host'      => $config->getHost(),
                'name'      => $config->getDatabase(),
                'user'      => $config->getUser(),
                'pass'      => $config->getPassword(),
                'port'      => '5432',
                'charset'   => 'utf8',
                'collation' => 'utf8mb4_general_ci'
            ]
        ],
        'version_order' => 'creation'
    ];
