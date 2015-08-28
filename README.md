## Goal

Make automatic [convensions](CONVENTIONS.md) checking on each commit.

## Installaion

Add checker to your `composer.json`:

```
composer require linkorb/conventions-checker
```

Reinitialize git hook:

```
php ./vendor/bin/grumphp git:init --config=vendor/linkorb/conventions-checker/config/lib/grumphp.yml
```

for library project, or

```
php ./vendor/bin/grumphp git:init --config=vendor/linkorb/conventions-checker/config/app/grumphp.yml
```

for application project.

## Usage

Just commit some changes and you see warnings if you don't follow conventions.

## TODO

- [ ] Branded ASCII
- [ ] Distribute it as separate `linkorb-checker.phar` (Maybe?)
- [ ] Automatic hook reinitialization `linkorb-checker init:app` and `linkorb-checker init:lib`

