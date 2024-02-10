<?php

declare(strict_types=1);

namespace App\Repositories;

/**
 * Class TagRepository
 *
 * @package App\Repositories
 */
class TagRepository extends DocumentRepository
{
    /**
     * Search for tags.
     */
    public function search(string $term, $size = 20): array
    {
        $response = $this->client->search([
            'index' => 'tags',
            'body' => [
                'query' => [
                    'match_phrase_prefix' => [
                        'label' => $term,
                    ],
                ],
                'sort' => [
                    'count' => [
                        'order' => 'desc',
                    ],
                ],
                'size' => $size,
            ],
        ]);

        $decoded = $this->decode($response);

        $results = [];
        foreach ($decoded['hits']['hits'] as $hit) {
            $results[] = [
                'id' => $hit['_id'],
                'value' => $hit['_source']['label'],
            ];
        }

        return $results;
    }
}
