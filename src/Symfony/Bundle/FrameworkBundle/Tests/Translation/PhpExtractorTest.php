<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\FrameworkBundle\Tests\Translation;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor;
use Symfony\Component\Translation\MessageCatalogue;

class PhpExtractorTest extends TestCase
{
    public function testExtraction()
    {
        // Arrange
        $extractor = new PhpExtractor();
        $extractor->setPrefix('prefix');
        $catalogue = new MessageCatalogue('en');

        // Act
        $extractor->extract(__DIR__.'/../Fixtures/Resources/views/', $catalogue);

        // Assert
        $this->assertCount(1, $catalogue->all('messages'), '->extract() should find 1 translation');
        $this->assertTrue($catalogue->has('new key'), '->extract() should find at least "new key" message');
        $this->assertEquals('prefixnew key', $catalogue->get('new key'), '->extract() should apply "prefix" as prefix');
    }

    public function testPhpExtraction()
    {
        // Arrange
        $extractor = new PhpExtractor();
        $extractor->setPrefix('prefix');
        $catalogue = new MessageCatalogue('en');

        // Act
        $extractor->extract(__DIR__.'/../Fixtures/Translation', $catalogue);

        // Assert
        $this->assertCount(2, $catalogue->all('messages'), '->extract() should find 2 translations');
        $this->assertTrue($catalogue->has('translation.one'), '->extract() should find "translation.one" message');
        $this->assertTrue($catalogue->has('translation.two'), '->extract() should find "translation.two" message');
        $this->assertEquals('prefixtranslation.one', $catalogue->get('translation.one'), '->extract() should apply "prefix" as prefix');
        $this->assertEquals('prefixtranslation.two', $catalogue->get('translation.two'), '->extract() should apply "prefix" as prefix');
    }
}
