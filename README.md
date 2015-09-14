## Goal

Make automatic [convensions](CONVENTIONS.md) checking on each commit.

## Installaion

### 1. Add path to grumphp configuration file to your `composer.json`'s extra:

For application project:

```
    "extra": {
        "grumphp": {
            "config-default-path": "vendor/linkorb/conventions-checker/config/app/grumphp.yml"
        }
    }
```

For library project:

```
    "extra": {
        "grumphp": {
            "config-default-path": "vendor/linkorb/conventions-checker/config/lib/grumphp.yml"
        }
    }
```

### 2. Add checker to your `composer.json`:

```
composer require --dev linkorb/conventions-checker
```

## Usage

Just commit some changes and you see warnings if you don't follow [convensions](CONVENTIONS.md).

## TODO

- [ ] Automatic project type definition by `composer.json`'s `type` ("application" or default "library") and update `composer.json`'s extra
- [ ] Branded ASCII
- [ ] Distribute it as separate `linkorb-checker.phar` (Maybe?)
