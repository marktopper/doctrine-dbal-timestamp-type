# Doctrine/DBAL Timestamp Type
Since Doctrine/DBAL does not support the MySQL Timestamp type, you might want to add it on your own using this package.

## Installation
```
composer require marktopper/doctrine-dbal-timestamp-type
```

Then add the type to Doctrine\DBAL:
```
\Doctrine\DBAL\Types\Type::addType('timestamp', 'MarkTopper\DoctrineDBALTimestampType\TimestampType');
```

## Laravel 5
You can use the Laravel Provider to ensure that the type is added to Doctrine\DBAL by adding the following to providers:
```
MarkTopper\DoctrineDBALTimestampType\Laravel5ServiceProvider::class,
```
