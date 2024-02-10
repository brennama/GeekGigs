<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Job;
use Throwable;

/**
 * Class JobRepository
 *
 * @package App\Repositories
 */
class JobRepository extends DocumentRepository
{
    /**
     * Retrieve document by its id.
     *
     * @throws Throwable
     */
    public function find(string $id): ?Job
    {
        try {
            $response = $this->client->get([
                'index' => 'jobs',
                'id' => $id,
            ]);

            if ($response->getStatusCode() === 404) {
                return null;
            }

            $decoded = $this->decode($response);
            $source = $decoded['_source'];
            $source['id'] = $decoded['_id'];

            return Job::fromArray($source);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Index document.
     *
     * @throws Throwable
     */
    public function save(Job $model): void
    {
        $response = $this->client->index([
            'index' => 'jobs',
            'body' => $model->toArray(),
        ]);

        $decoded = $this->decode($response);
        $model->id = $decoded['_id'];
    }
}
