<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 * Action enum
 */
final class Action extends Enum
{
    private const ADMIN = 'admin';
    private const GUEST = 'guest';
}
