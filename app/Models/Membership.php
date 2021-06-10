<?php

namespace App\Models;

use Laravel\Jetstream\Membership as JetstreamMembership;

//created by laravel by default
class Membership extends JetstreamMembership
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
