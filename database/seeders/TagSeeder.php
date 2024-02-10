<?php

namespace Database\Seeders;

use Elastic\Elasticsearch\Client;
use Illuminate\Database\Seeder;
use Throwable;

/**
 * Class TagSeeder
 *
 * @package Database\Seeders
 */
class TagSeeder extends Seeder
{
    /**
     * JobSeeder constructor.
     *
     * @throws Throwable
     */
    public function __construct(private readonly Client $client)
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = DIR_ROOT . '/database/seeders/tags.csv';

        if (!($handle = fopen($file, 'r'))) {
            return;
        }

        $params = [
            'body' => [],
        ];

        $id = 1;
        while (($data = fgetcsv($handle, 50000)) !== false) {
            $params['body'][] = [
                'index' => [
                    '_index' => 'tags',
                    '_id' => $id,
                ]
            ];

            $params['body'][] = [
                'label' => $data[0],
                'count' => $data[1],
            ];

            // Every 1000 documents stop and send the bulk request
            if ($id % 1000 === 0) {
                $this->client->bulk($params);
                $params = ['body' => []];
            }

            $id++;
        }

        // Send the last batch if it exists
        if (!empty($params['body'])) {
            $this->client->bulk($params);
        }

        fclose($handle);
    }
}
