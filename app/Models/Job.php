<?php

namespace App\Models;

use App\Enums\ExperienceLevel as Exp;
use App\Enums\JobType;
use App\Enums\RemotePolicy;
use DateTimeInterface;
use DateTime;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Throwable;

/**
 * Class Job
 *
 * @package App\Models
 */
class Job implements Arrayable, Jsonable
{
    /**
     * Unique identifier generated by elasticsearch.
     *
     * A model will not contain an id until
     * it has been indexed in elasticsearch.
     */
    public ?string $id = null;

    /**
     * User identifier.
     */
    public int $userId;

    /**
     * Company name.
     */
    public string $company;

    /**
     * Company website url.
     */
    public ?string $companyUrl = null;

    /**
     * Job application url (external site e.g. greenhouse).
     */
    public string $jobUrl;

    /**
     * Job title.
     */
    public string $title;

    /**
     * Job description.
     */
    public ?string $description = null;

    /**
     * Job city.
     */
    public string $city;

    /**
     * Job state.
     */
    public string $state;

    /**
     * Company remote policy.
     */
    public RemotePolicy $remotePolicy;

    /**
     * Job required experience level.
     */
    public Exp $experienceLevel;

    /**
     * Job type.
     */
    public JobType $jobType;

    /**
     * Minimum salary for the job.
     */
    public int $salaryRangeMin;

    /**
     * Maximum salary for the job.
     */
    public int $salaryRangeMax;

    /**
     * Associated tags.
     */
    public string|array|null $tags = null;

    /**
     * Whether job has been archived.
     */
    public bool $archived = false;

    public DateTimeInterface $createdAt;
    public ?DateTimeInterface $updatedAt = null;

    /**
     * Cast object to array.
     */
    public function toArray(): array
    {
        $arr = (array) $this;
        $arr['createdAt'] = $this->createdAt->format('Y-m-d H:i:s');
        $arr['updatedAt'] = $this->updatedAt?->format('Y-m-d H:i:s');

        return $arr;
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
     */
    public static function fromArray(array $values): static
    {
        $self = new static();
        $self->id = $values['_id'] ?? $values['id'] ?? null;
        $self->userId = $values['user_id'] ?? $values['userId'] ?? null;
        $self->company = $values['company'] ?? null;
        $self->companyUrl = $values['companyUrl'] ?? null;
        $self->jobUrl = $values['jobUrl'] ?? null;
        $self->title = $values['title'] ?? null;
        $self->description = $values['description'] ?? null;
        $self->city = $values['city'] ?? '';
        $self->state = $values['state'] ?? '';
        $self->salaryRangeMin = $values['salaryRangeMin'] ?? 0;
        $self->salaryRangeMax = $values['salaryRangeMax'] ?? 0;
        $self->remotePolicy = RemotePolicy::tryFrom($values['remotePolicy'] ?? null) ?? RemotePolicy::OnSite;
        $self->experienceLevel = Exp::tryFrom($values['experienceLevel'] ?? null) ?? Exp::MidLevel;
        $self->jobType = JobType::tryFrom($values['jobType'] ?? null) ?? JobType::FullTime;
        $self->archived = $values['archived'] ?? false;
        $self->tags = $values['tags'] ?? '[]';
        $self->createdAt = !empty($values['createdAt']) ? new DateTime($values['createdAt']) : new DateTime();
        $self->updatedAt = !empty($values['updatedAt']) ? new DateTime($values['updatedAt']) : null;

        return $self;
    }
}
