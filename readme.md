# Doctrine/DBAL Timestamp Type
Since Doctrine/DBAL does not support the MySQL Timestamp type, you might want to add it on your own using this package.

## Why using this?
According to [this issue](https://github.com/doctrine/dbal/issues/2558), [Doctrine/DBAL](https://github.com/doctrine/dbal) does not support MySQL-specific database types like this one. Therefor we must add it ourself.

## Installation
```
composer require marktopper/doctrine-dbal-timestamp-type
```

Then add the type to `Doctrine\DBAL`:
```
\Doctrine\DBAL\Types\Type::addType('timestamp', 'MarkTopper\DoctrineDBALTimestampType\TimestampType');
```

### Laravel 5
You can use the Laravel Provider to ensure that the type is added to Doctrine\DBAL by adding the following to providers:
```
MarkTopper\DoctrineDBALTimestampType\Laravel5ServiceProvider::class,
```
