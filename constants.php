<?php

declare(strict_types=1);

/**
 * Define application root.
 */
const DIR_ROOT = __DIR__;

/**
 * Define application directories.
 */
const DIR_ENV = DIR_ROOT . '/env';

/**
 * Define application environments.
 */
const ENV_DEV = 'dev';
const ENV_PROD = 'prod';

/**
 * Define application environment whitelist.
 */
const ENVIRONMENTS = [
    ENV_DEV,
    ENV_PROD,
];

/**
 * Terminal color codes.
 */
const CLI_RESET_ALL = "\033[0m";
const CLI_BOLD = "\033[1m";
const CLI_RED = "\033[31m";
const CLI_GREEN = "\033[32m";
const CLI_YELLOW = "\033[33m";
const CLI_BLUE = "\033[34m";
