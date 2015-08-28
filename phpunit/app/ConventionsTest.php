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
