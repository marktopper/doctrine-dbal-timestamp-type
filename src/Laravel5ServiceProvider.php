<?php

namespace MarkTopper\DoctrineDBALTimestampType;

use Doctrine\DBAL\Types\Type;
use Illuminate\Support\ServiceProvider;

class Laravel5ServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Type::addType('timestamp', TimestampType::class);
    }

    public function register()
    {
        //
    }
}
