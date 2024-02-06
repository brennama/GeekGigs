<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Class RemotePolicy
 *
 * @package App\Enums
 */
enum RemotePolicy: string
{
    case Remote = 'remote';
    case Hybrid = 'hybrid';
    case OnSite = 'on-site';
}
