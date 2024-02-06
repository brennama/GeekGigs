<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Class ExperienceLevel
 *
 * @package App\Enums
 */
enum ExperienceLevel: string
{
    case Associate = 'associate';
    case EntryLevel = 'entry-level';
    case MidLevel = 'mid-level';
    case SeniorLevel = 'senior-level';
    case Director = 'director';
    case Executive = 'executive';
}
