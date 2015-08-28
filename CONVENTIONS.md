# Conventions

At LinkORB we place great value in following conventions. This helps developers in working on multiple projects. A common set of simple conventions helps everybody to dive in quickly, understand the code, and contributing new code.

## General

*  Always include a `README.md` in the root of your project (see details below)
*  Always include a `.gitignore` file
*  Always include a `LICENSE.md` file in the root of your project for public repositories (see details below)
*  Use [github.com/linkorb/skeleton](https://github.com/linkorb/skeleton) to start a new skeleton project

## PHP Directory structure

*  The root of your project should include a `composer.json` file. All dependency management should be handled through composer.
*  `src/`: All PHP code goes here
*  `web/`: Use this directory for webservices (sites, or apis), it should include:
    *  `index.php`: This file simply includes `../app/bootstrap.php` and starts the app
    *  `.htaccess`: Use the template
*  `app/`: Put the application code in. This directory should include:
    *  `bootstrap.php` (includes `vendor/autoloader.php`, and instantiates services)
    *  `schema.xml` Database schema if applicable. It should be compatible with `dbtk/schema-loader`
*  `app/config/`: Contains the application config files:
    *  `parameters.yml`: Configuration like db credentials, paths, etc
    *  `routes.yml`: a file defining all the routes (for symfony/routing)
    *  Other configuration can go in `app/config/` too if needed.
*  `examples/`: Any example PHP code or example data files (xml, json, etc)
*  For Silex apps, put the application code in `src/Application.php` (extends `Silex\Application`)

## PHP Naming conventions

*  Always follow [PSR-0, 1, 2 and 4](http://php-fig.org)
*  Always use 4 spaces for indention. Not tabs.
*  All “controller” files should be in a directory called `Controller` (directly in `src/` or in a sub-directory where applicable). And be postfixed with `Controller`. For example:
    `Acme/ProjectName/Controller/DemoController`
*  All “interface” files should be postfixed with `Interface`. For example:
    `Acme/ProjectName/DemoInterface`
*  All “repository” files should be in a directory called `Repository` (directly in `src/` or in a sub-directory where applicable). And be postfixed with `Repository`. For example:
    `Acme/ProjectName/Repository/PdoUserRepository`

## PHP Style

*  All database access uses the "repository" pattern.
*  Don’t use a full ORM or Active Record library unless agreed. Usually the repository pattern is lighter.
*  Model properties are accessed through getters and setters.

## Authentication

Unless otherwise agreed, API's and Web-apps should support [userbase/client](https://packagist.org/packages/userbase/client) for authenentication. Either through the included Symfony Security Provider (APIs), or through JWT (Web apps).

## LICENSE.md

Usually all projects start as private repo’s. A <string>private repository</string> does not need a LICENSE.md file, it is always concidered proprietary.

If you work on a <string>public repository</string>, by convention it will follow the MIT license, and it should include a copy of this file in your repository: [https://github.com/linkorb/skeleton/blob/master/LICENSE](https://github.com/linkorb/skeleton/blob/ma...

The `composer.json` file should also refer to the MIT license using this snippet:

    "license": "MIT"

## README.md

*  Always provide a README.md in the root of your project
*  Include full instructions on:
    *  downloading the code (git clone command)
    *  running composer
    *  initialize database schema (if applicable)
    *  copying `.dist` files to real files
    *  configuring the parameters
    *  starting the service
*  Include the ‘Brought to you by the LinkORB Engineering team` banner at the end of the file.

## composer.json

*  Provide a clear `description`
*  Include the keyword `linkorb` (lowercase, one word) in the `keywords` list, among other relevant keywords.
*  Include the license in the composer.json file
*  Include `engineering@linkorb.com` as one of the authors. Include your own name too if you prefer (optional).

## Routes

*  Store your routes in `app/config/routes.yml`
*  Never use a closing slash on routes. Good: `/x/y/z` Bad: `/x/y/z/`
*  Always use plurals for resource urls Good: `/books/12` Bad: `/book/12`
*  The main resource url always provides a listing or search: `/books` lists all books
*  If your route is an "action" on a resource (for example "delete" or "print"), put the action at the end of the route. Good: `/books/12/print` Bad: `/books/delete/12`

## Templates

*  Use [Twig](http://twig.sensiolabs.org/) for templating
*  Use [Bootstrap3](http://getbootstrap.com/css/) for all basic CSS
*  Use [font-awesome](http://fortawesome.github.io/Font-Awesome/) for icons
*  Templates are stored in `templates/` in the root of your project
*  Use a shared `layout.html.twig` file that other twig templates [extend](https://github.com/linkorb/skeleton/tree/master/templates).
*  Always use named routes for links (using `path`) instead of hard-coded links. Your app will be on different baseurls in production.

## Controllers

*  Never use `exit`, `var_dump`, `echo`, `die` in controllers. Always return a Response object.
*  Keep controller code small. Any functionality should be implemented in Repositories, Models or other classes.
*  Don't put too many controller functions in 1 class. Split them by resource if the class becomes too big.

## Prefered PHP libraries

Here's a list of basic libraries that we enjoy using.

To keep our dependency management simple, and prevent people from learning about multiple libraries that do similar things, we strongly encourage using common libraries that are "commonly used" among other PHP developers

*  [silex/silex](https://packagist.org/packages/silex/silex) For web services and APIs (request/response handling)
*  [symfony/http-foundation](https://packagist.org/packages/symfony/http-foundation) For request/response classes (PSR-7 considered for future projects)
*  [PDO](http://php.net/pdo) For database connectivity
*  [doctrine/dbal](https://packagist.org/packages/doctrine/dbal) For more advanced use-cases
*  [monolog/monolog](https://packagist.org/packages/monolog/monolog) For logging
*  [herald-project/client-php](https://packagist.org/packages/herald-project/client-php) For transactional messages (email, sms, etc)
*  [linkorb/stored-client](https://github.com/linkorb/stored-client) Image handling
*  [crodas/service-provider](https://packagist.org/packages/crodas/service-provider) For configuring services
*  [symfony/routing](https://packagist.org/packages/symfony/routing) For route definitions (implied through Silex)
*  [symfony/yaml](https://packagist.org/packages/symfony/yaml) .yaml file parsing
