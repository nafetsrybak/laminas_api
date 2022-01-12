<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Application\Doctrine\CustomFunctions\CountOverSql;

return [
    'doctrine' => [
        'migrations_configuration' => [
            'orm_default' => [
                'table_storage' => [
                    'table_name' => 'doctrine_migration_versions',
                    'version_column_name' => 'version',
                    'version_column_length' => 1024,
                    'executed_at_column_name' => 'executed_at',
                    'execution_time_column_name' => 'execution_time',
                ],

                'migrations_paths' => [
                    'Migrations' => __DIR__ . '/../../data/doctrine/Migrations',
                ],

                'all_or_nothing' => true,
                'transactional' => true,
                'check_database_platform' => true,
                //'organize_migrations' => 'none',
                //'connection' => null,
                //'em' => null
            ]
        ],
        'configuration' => [
            'orm_default' => [
                'string_functions' => [
                    'COUNT_OVER' => CountOverSql::class
                ]
            ]
        ]
    ]
];
