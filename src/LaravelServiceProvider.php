<?php

namespace MarkTopper\DoctrineDBALTimestampType;

use Doctrine\DBAL\Types\Type;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (!Type::hasType('timestamp')) {
            Type::addType('timestamp', TimestampType::class);
        }
    }

    public function register()
    {
        //
    }
}
