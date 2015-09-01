<?php

namespace Linkorb\ConventionsChecker\PhpUnit\Common;

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
    public function testReadmeMdExists()
    {
        $filename = sprintf("%s/README.md", $this->rootPath);
        $this->assertFileExists($filename, 'You need to add "README.md" file to root dir of project');
    }

    /**
     * @depends testReadmeMdExists
     */
    public function testWeHaveBannerAtReadmeMd()
    {
        $filename = sprintf("%s/README.md", $this->rootPath);
        $content = file_get_contents($filename);
        $this->assertTrue(strpos($content, 'Brought to you by the LinkORB Engineering team') > 0, 'You need to add "Brought to you by the LinkORB Engineering team" banner at README.md');
    }

    /**
     *
     */
    public function testComposerJsonExists()
    {
        $filename = sprintf("%s/composer.json", $this->rootPath);
        $this->assertFileExists($filename, 'You need to add "composer.json" file to root dir of project');
    }

    /**
     * @depends testComposerJsonExists
     */
    public function testWeHaveRightComposerJson()
    {
        $filename = sprintf("%s/composer.json", $this->rootPath);
        $content = file_get_contents($filename);
        $json = json_decode($content);

        $this->assertTrue(isset($json->description), 'There is no "description" section at composer.json');
        $this->assertTrue(strlen($json->description) < 64, 'You need to provide clear description at composer.json');
        $this->assertTrue(isset($json->keywords), 'There is no "keywords" section at composer.json');
        $this->assertTrue(in_array('linkorb', $json->keywords), 'You need to place "linkorb" keyword at composer.json');
        $this->assertTrue(isset($json->license), 'There is no "license" section at composer.json');
        $this->assertEquals('MIT', $json->license, 'You need to provide "MIT" license at composer.json');

        $this->assertTrue(isset($json->authors), 'There is no "authors" section at composer.json');
        $authors_emails = array_map(function($author){
            if (empty($author->email)) return false;
            return $author->email;
        }, $json->authors);

        $this->assertTrue(in_array('engineering@linkorb.com', $authors_emails), 'You need to add "engineering@linkorb.com" to authors');
    }

    /**
     * Check .editorconfig file exists.
     */
    public function testEditorconfigExists()
    {
        $filename = sprintf("%s/.editorconfig", $this->rootPath);
        $this->assertFileExists($filename, 'You need to add ".editorconfig" to root dir of project');
    }

}
