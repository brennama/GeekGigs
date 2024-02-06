<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Class JobType
 *
 * @package App\Enums
 */
enum JobType: string
{
    case FullTime = 'full-time';
    case PartTime = 'part-time';
    case Contract = 'contract';
    case Internship = 'internship';
    case Temporary = 'temporary';
}
