<?php

namespace Linkorb\ConventionsChecker\PhpUnit\App;

use Symfony\Component\Yaml\Yaml;

class ConventionsTest extends \PHPUnit_Framework_TestCase
{
    private $rootPath;

    public function setUp()
    {
        $this->rootPath = getcwd();
    }

    /**
     *
     */
    public function testRoutesExists()
    {
        $filename = sprintf("%s/app/config/routes.yml", $this->rootPath);
        $this->assertFileExists($filename, 'File "app/config/routes.yml" does not exists');
    }

    /**
     * @depends testRoutesExists
     */
    public function testRoutes()
    {
        $filename = sprintf("%s/app/config/routes.yml", $this->rootPath);
        $content = file_get_contents($filename);
        $yaml = Yaml::parse($content);

        foreach ($yaml as $route_name=>$route_parameters) {
            $this->assertTrue($route_parameters['path'] == '/' || '/' != substr(trim($route_parameters['path']), -1), 'Never use a closing slash on routes (except top-level "/" path)');
        }
    }

    /**
     * Application MUST have composer.lock in repository.
     * So composer.lock CAN'T BE at .gitignore file.
     */
    public function testGitignoreNotContainComposerLock()
    {
        $filename = sprintf("%s/.gitignore", $this->rootPath);
        $content = file_get_contents($filename);
        $lines = array_map(function($line){
            return trim($line);
        }, explode("\n", $content));

        $this->assertFalse(in_array('composer.lock', $lines) || in_array('/composer.lock', $lines), 'Remove "composer.lock" from your ".gitignore" file');
    }

}
