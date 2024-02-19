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
     * Search for documents.
     *
     * @return Job[]
     */
    public function search(string $term, int $size = 20, int $from = 0): array
    {
        $response = $this->client->search([
            'index' => 'jobs',
            'from' => $from,
            'size' => $size,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            'multi_match' => [
                                'query' => $term,
                                'fields' => [
                                    'tags.label^3',
                                    'title^2',
                                    'description',
                                ],
                            ],
                        ],
                        'filter' => [
                            'term' => [
                                'archived' => false,
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        return $this->decode($response)['hits'];
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
