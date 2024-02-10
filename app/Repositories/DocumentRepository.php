<?php

declare(strict_types=1);

namespace App\Repositories;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Http\Promise\Promise;
use Throwable;

/**
 * Class DocumentRepository
 *
 * @package App\Repositories
 */
abstract class DocumentRepository
{
    /**
     * DocumentRepository constructor.
     */
    public function __construct(protected readonly Client $client)
    {

    }

    /**
     * Decode json response from elasticsearch.
     *
     * @throws Throwable
     */
    protected function decode(Elasticsearch|Promise $response): array
    {
        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);
    }
}
