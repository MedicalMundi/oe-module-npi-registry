# Developer Tools

This repository is provided with tools for testing and code quality management.

You can install all tools with a single step, inside your project dir run:

```
composer bin all install
```

## Tools list

- phpunit (testing)
- easy-coding-standard (coding standard)
- psalm (static analysis)
- rector (maintenance and upgrade)

## How to use

Check the sortcuts definded inside composer.json

```json lines
"scripts": {
    "cs": "./vendor/bin/ecs",
    "cs:fix": "./vendor/bin/ecs --fix",
    "rc": "./vendor/bin/rector --dry-run",
    "rc:fix": "./vendor/bin/rector",
    "sa": "./vendor/bin/psalm",
    "tf": "./vendor/bin/phpunit --testsuite=functional --testdox",
    "ti": "./vendor/bin/phpunit --testsuite=integration --testdox",
    "tu": "./vendor/bin/phpunit --testsuite=unit --testdox"
    },
    "scripts-descriptions": {
    "cs": "Check php coding style",
    "cs:fix": "Fix php coding style",
    "rc": "Check rector roules",
    "rc:fix": "Fix rector issues",
    "sa": "Check static analysis (psalm)",
    "tf": "Run functional testsuite",
    "ti": "Run integration testsuite",
    "tu": "Run unit testsuite"
}
```


Examples:


```shell
# run unit test
composer tu

# check coding standard
composer cs

# fix check coding standard issues
composer cs:fix
```
