<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\ExperienceLevel;
use App\Enums\JobType;
use App\Enums\RemotePolicy;
use Elastic\Elasticsearch\Client;
use Illuminate\Database\Seeder;
use Throwable;

/**
 * Class JobSeeder
 *
 * @package Database\Seeders
 */
class JobSeeder extends Seeder
{
    /**
     * AI generated business names.
     */
    private const COMPANY_NAMES = [
        'Digital Nexus',
        'Code Master Innovations',
        'Byte Beam',
        'Innova Tech Systems',
        'Inno Logic Solutions',
        'Byte Forge Software',
        'Tech Vortex',
        'Logic Hub',
        'Inno Tech Solutions',
        'App Wizard',
        'Tech Nova',
        'Data Sync Solutions',
        'Infini Soft',
        'Code Craft Studios',
        'Byte Wave Systems',
        'Innova Soft Labs',
        'Tech Vortex Labs',
        'App Sphere Innovations',
        'Cyber Edge',
        'Data Driven Dynamics',
        'Innova Soft',
        'Cyber Link Solutions',
        'Inno Tech',
        'Logic Lab Software',
        'Propel Performance',
        'Spark Success',
        'Impress',
        'Amplify Your Message',
        'Impress Influence',
        'Momentum',
        'Trendsetters',
        'Revive',
        'Media Moguls',
        'Strategize',
        'Brand Boosters',
        'Influence Innovators',
        'Thrive',
        'Expand',
        'Elevate',
        'Strategic Solutions',
        'Viral Vision',
        'Optimize Outcomes',
        'Momentum Marketing',
        'Digital Dynamo',
        'Catalyst',
        'Thrive Thrive',
        'Influence',
        'Expand Your Reach',
    ];

    private const LOCATION_CITIES = [
        'Albany',
        'Albuquerque',
        'Anaheim',
        'Ann Arbor',
        'Atlanta',
        'Austin',
        'Baltimore',
        'Boston',
        'Buffalo',
        'Cambridge',
        'Charlotte',
        'Chicago',
        'Cincinnati',
        'Cleveland',
        'Columbus',
        'Dallas',
        'Denver',
        'Detroit',
        'Grand Rapids',
        'Houston',
        'Indianapolis',
        'Lansing',
        'Las Vegas',
        'Los Angeles',
        'Miami',
        'Milwaukee',
        'Minneapolis',
        'Nashville',
        'New Orleans',
        'New York City',
        'Oakland',
        'Oklahoma City',
        'Orlando',
        'Philadelphia',
        'Phoenix',
        'Pittsburgh',
        'Portland',
        'Raleigh',
        'Sacramento',
        'Salt Lake City',
        'San Antonio',
        'San Diego',
        'San Francisco',
        'San Jose',
        'Seattle',
        'St. Louis',
        'Tampa Bay',
        'Washington D.C.',
    ];

    private const LOCATION_STATES = [
        'NY',
        'NM',
        'CA',
        'MI',
        'GA',
        'TX',
        'MD',
        'MA',
        'NY',
        'MA',
        'NC',
        'IL',
        'OH',
        'OH',
        'OH',
        'TX',
        'CO',
        'MI',
        'MI',
        'TX',
        'IN',
        'MI',
        'NV',
        'CA',
        'FL',
        'WI',
        'MN',
        'TN',
        'LA',
        'NY',
        'CA',
        'OK',
        'FL',
        'PA',
        'AZ',
        'PA',
        'OR',
        'NC',
        'CA',
        'UT',
        'TX',
        'CA',
        'CA',
        'CA',
        'WA',
        'MO',
        'FL',
        'DC',
    ];

    private const JOB_TITLES = [
        'Software Engineering Manager',
        'Software Engineer',
        'API Developer',
        'Backend Developer',
        'Frontend Developer',
        'Full-Stack Developer',
        'QA Engineer',
        'Solutions Architect',
        'Infrastructure Developer',
        'Database Manager',
        'Mobile Developer',
        'Software Development Engineer in Test',
    ];

    private const MIN_SALARY_RANGES = [
        [20000, 30000, 40000],
        [40000, 50000, 60000],
        [60000, 70000, 80000],
        [80000, 90000, 100000],
        [100000, 110000, 120000],
        [120000, 130000, 140000],
    ];

    private const STACKS = [
        [
            ['id' => 1, 'label' => 'javascript'],
            ['id' => 5, 'label' => 'php'],
            ['id' => 13, 'label' => 'mysql'],
            ['id' => 63, 'label' => 'docker'],
            ['id' => 90, 'label' => 'apache'],
        ] ,
        [
            ['id' => 1, 'label' => 'javascript'],
            ['id' => 2, 'label' => 'python'],
            ['id' => 47, 'label' => 'postgresql'],
            ['id' => 63, 'label' => 'docker'],
            ['id' => 151, 'label' => 'nginx'],
        ],
        [
            ['id' => 3, 'label' => 'java'],
            ['id' => 34, 'label' => 'typescript'],
            ['id' => 63, 'label' => 'docker'],
            ['id' => 202, 'label' => 'tomcat'],
            ['id' => 440, 'label' => 'cassandra'],
        ],
    ];

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
        $params = [
            'body' => [],
        ];

        for ($id = 1; $id <= 100; $id++) {
            $params['body'][] = [
                'index' => [
                    '_index' => 'jobs',
                ]
            ];

            $params['body'][] = $this->generateJobPosting($id);

            // Every 1000 documents stop and send the bulk request
            if ($id % 1000 === 0) {
                $this->client->bulk($params);
                $params = ['body' => []];
            }
        }

        // Send the last batch if it exists
        if (!empty($params['body'])) {
            $this->client->bulk($params);
        }
    }

    /**
     * Generate job post.
     */
    private function generateJobPosting(int $id): array
    {
        static $companyLocations = [];
        $companyIndex = random_int(0, count(self::COMPANY_NAMES) - 1);
        $remotePolicyIndex = random_int(0, 2);
        $experienceLevelIndex = random_int(0, 5);

        if (!isset($companyLocations[$companyIndex])) {
            $companyLocations[$companyIndex] = random_int(0, count(self::LOCATION_CITIES) - 1);
        }

        $title = self::JOB_TITLES[random_int(0, count(self::JOB_TITLES) - 1)];

        return [
            'userId' => 1,
            'title' => $title,
            'company' => self::COMPANY_NAMES[$companyIndex],
            'companyUrl' => sprintf(
                'https://www.%s.com',
                strtolower(str_replace(' ' , '', self::COMPANY_NAMES[$companyIndex])),
            ),
            'jobUrl' => 'https://www.greenhouse.com/' . uniqid('', false),
            'description' => 'Todo: generate company job descriptions',
            'city' => self::LOCATION_CITIES[$companyLocations[$companyIndex]],
            'state' => self::LOCATION_STATES[$companyLocations[$companyIndex]],
            'jobType' => JobType::FullTime->value,
            'remotePolicy' => match ($remotePolicyIndex) {
                0 => RemotePolicy::OnSite->value,
                1 => RemotePolicy::Remote->value,
                2 => RemotePolicy::Hybrid->value,
            },
            'experienceLevel' => match ($experienceLevelIndex) {
                0 => ExperienceLevel::Associate->value,
                1 => ExperienceLevel::EntryLevel->value,
                2 => ExperienceLevel::MidLevel->value,
                3 => ExperienceLevel::SeniorLevel->value,
                4 => ExperienceLevel::Director->value,
                5 => ExperienceLevel::Executive->value,
            },
            'salaryRangeMin' => match ($experienceLevelIndex) {
                0 => $min = self::MIN_SALARY_RANGES[0][array_rand(self::MIN_SALARY_RANGES[0])],
                1 => $min = self::MIN_SALARY_RANGES[1][array_rand(self::MIN_SALARY_RANGES[1])],
                2 => $min = self::MIN_SALARY_RANGES[2][array_rand(self::MIN_SALARY_RANGES[2])],
                3 => $min = self::MIN_SALARY_RANGES[3][array_rand(self::MIN_SALARY_RANGES[3])],
                4 => $min = self::MIN_SALARY_RANGES[4][array_rand(self::MIN_SALARY_RANGES[4])],
                5 => $min = self::MIN_SALARY_RANGES[5][array_rand(self::MIN_SALARY_RANGES[5])],
            },
            'salaryRangeMax' => match ($experienceLevelIndex) {
                0 => $min + 10000,
                1 => $min + 20000,
                2 => $min + 30000,
                3 => $min + 40000,
                4 => $min + 50000,
                5 => $min + 60000,
            },
            'tags' => self::STACKS[random_int(0, count(self::STACKS) - 1)],
            'archived' => $id % 20 === 0,
            'createdAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s'),
        ];
    }
}
