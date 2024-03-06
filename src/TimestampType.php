<?php

namespace MarkTopper\DoctrineDBALTimestampType;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\Exception\NotSupported;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class TimestampType extends Type
{
    public function getName()
    {
        return 'timestamp';
    }

    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param array                                     $fieldDeclaration The field declaration.
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform         The currently used database platform.
     *
     * @throws \Doctrine\DBAL\DBALException
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        $name = '';
        if (method_exists($platform, 'getName')) {
            $name = $platform->getName();
        } else {
            $platformClass = get_class($platform);

            if (strpos($platformClass, 'MySQL') !== false || strpos($platformClass, 'MariaDB') !== false) {
                $name = 'mysql';
            } elseif (strpos($platformClass, 'Sqlite') !== false) {
                $name = 'sqlite';
            }
        }

        if (in_array($name, ['mysql', 'sqlite'])) {
            $method = 'get'.ucfirst($name).'PlatformSQLDeclaration';

            return $this->$method($fieldDeclaration);
        }

        if (class_exists('Doctrine\DBAL\DBALException')) {
            throw DBALException::notSupported(__METHOD__);
        }

        throw NotSupported::new(__METHOD__);
    }

    /**
     * Gets the SQL declaration snippet for a field of this type for the MySQL Platform.
     *
     * @param array $fieldDeclaration The field declaration.
     *
     * @return string
     */
    protected function getMysqlPlatformSQLDeclaration(array $fieldDeclaration)
    {
        $columnType = $fieldDeclaration['precision'] ? "TIMESTAMP({$fieldDeclaration['precision']})" : 'TIMESTAMP';

        if (isset($fieldDeclaration['notnull']) && $fieldDeclaration['notnull'] == true) {
            return $columnType;
        }

        return "$columnType NULL";
    }

    /**
     * Gets the SQL declaration snippet for a field of this type for the Sqlite Platform.
     *
     * @param array $fieldDeclaration The field declaration.
     *
     * @return string
     */
    protected function getSqlitePlatformSQLDeclaration(array $fieldDeclaration)
    {
        return $this->getMysqlPlatformSQLDeclaration($fieldDeclaration);
    }
}
