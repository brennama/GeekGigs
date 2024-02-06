<?php

namespace App\Models;

use App\Enums\ExperienceLevel;
use App\Enums\JobType;
use App\Enums\RemotePolicy;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use OutOfBoundsException;
use Throwable;

/**
 * Class Job
 *
 * @package App\Models
 */
class Job implements Arrayable, Jsonable
{
    public readonly int $id;

    public string $title;

    public ?string $description = null;

    public string $company;

    public ?int $companyId = null;

    public string $city;

    public string $state;

    public string $jobAppUrl;

    public RemotePolicy $remotePolicy;

    public ExperienceLevel $experienceLevel;

    public JobType $jobType;

    public int $salaryRangeMin;

    public int $salaryRangeMax;

    public array $tags = [];

    /**
     * Cast object to array.
     */
    public function toArray(): array
    {
        return (array) $this;
    }

    /**
     * Serialize model as json.
     *
     * @throws Throwable
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    /**
     * Create model instance from array.
     *
     * @throws Throwable
     */
    public static function hydrate(array $values): static
    {
        $throwable = static fn(string $key): Throwable =>
            new OutOfBoundsException("'$key' key is missing from values array.");

        $self = new static();
        $self->id = $values['id'] ?? throw $throwable('id');
        $self->company = $values['company'] ?? throw $throwable('company');
        $self->companyId = $values['company_id'] ?? null;
        $self->title = $values['title'] ?? throw $throwable('title');
        $self->description = $values['description'] ?? null;
        $self->city = $values['city'] ?? throw $throwable('city');
        $self->state = $values['state'] ?? throw $throwable('state');
        $self->jobAppUrl = $values['jobAppUrl'] ?? throw $throwable('jobAppUrl');
        $self->remotePolicy = RemotePolicy::tryFrom($values['remotePolicy']) ?? throw $throwable('remotePolicy');
        $self->experienceLevel = ExperienceLevel::tryFrom($values['experienceLevel']) ?? throw $throwable('experienceLevel');
        $self->jobType = JobType::tryFrom($values['jobType']) ?? throw $throwable('jobType');
        $self->salaryRangeMin = $values['salaryRangeMin'] ?? throw $throwable('salaryRangeMin');
        $self->salaryRangeMax = $values['salaryRangeMax'] ?? throw $throwable('salaryRangeMax');
        $self->tags = $values['tags'] ?? [];

        return $self;
    }
}
