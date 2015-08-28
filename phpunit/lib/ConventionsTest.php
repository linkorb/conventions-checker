<?php

namespace Linkorb\ConventionsChecker\PhpUnit\Lib;

use Symfony\Component\Yaml\Yaml;

class ConventionsTest extends \PHPUnit_Framework_TestCase
{
    private $rootPath;

    public function setUp()
    {
        $this->rootPath = getcwd();
    }

    /**
     * Library CAN'T have composer.lock in repository.
     * So composer.lock MUST be placed at .gitignore file.
     */
    public function testGitignoreContainComposerLock()
    {
        $filename = sprintf("%s/.gitignore", $this->rootPath);
        $content = file_get_contents($filename);
        $lines = array_map(function($line){
            return trim($line);
        }, explode("\n", $content));

        $this->assertTrue(in_array('composer.lock', $lines) || in_array('/composer.lock', $lines), 'Add "composer.lock" to your ".gitignore" file');
    }

}
