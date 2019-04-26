<?php declare(strict_types=1);

namespace Shopware\Core\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1556279727PromotionTranslation extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1556279727;
    }

    public function update(Connection $connection): void
    {
        $connection->executeQuery('
        CREATE TABLE `promotion_translation` (
            `name` VARCHAR(255) NOT NULL,
            `promotion_id` BINARY(16) NOT NULL,
            `language_id` BINARY(16) NOT NULL,
            `created_at` DATETIME(3) NOT NULL,
            `updated_at` DATETIME(3) NOT NULL,
            PRIMARY KEY (`promotion_id`,`language_id`),
            KEY `fk.promotion_translation.promotion_id` (`promotion_id`),
            KEY `fk.promotion_translation.language_id` (`language_id`),
            CONSTRAINT `fk.promotion_translation.promotion_id` FOREIGN KEY (`promotion_id`) REFERENCES `promotion` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
            CONSTRAINT `fk.promotion_translation.language_id` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
