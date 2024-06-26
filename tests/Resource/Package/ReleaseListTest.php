<?php
declare(strict_types = 1);

namespace Pickling\Test\Resource\Package;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Pickling\Resource\Package\Release\Version;
use Pickling\Resource\Package\ReleaseList;
use SimpleXMLElement;

#[CoversClass(ReleaseList::class)]
final class ReleaseListTest extends TestCase {
  #[DataProvider('propertyGettersDataProvider')]
  public function testPropertyGetters(string $file, array $properties): void {
    $content = file_get_contents(__DIR__ . $file);
    $xml = new SimpleXMLElement($content);

    $releaseList = new ReleaseList($xml);
    $this->assertSame($properties[0], $releaseList->getPackageName());
    $this->assertSame($properties[1], $releaseList->getChannel());

    // test release list countable
    $this->assertSame($properties[2], count($releaseList));

    // test release list iterator
    $this->assertEquals($properties[3], iterator_to_array($releaseList));

    // test release list array access
    $this->assertEquals($properties[3][0], $releaseList[0]);
    $this->assertTrue(isset($properties[3][0]));
    $this->assertTrue(isset($releaseList[count($releaseList) - 1]));
    $this->assertFalse(isset($releaseList[count($releaseList)]));

    // test release list array access immutability
    unset($releaseList[0]);
    $releaseList[1] = '';
    $this->assertEquals($properties[3][0], $releaseList[0]);
    $this->assertEquals($properties[3][1], $releaseList[1]);
    $this->assertTrue(isset($releaseList[0]));
    $this->assertTrue(isset($releaseList[count($releaseList) - 1]));
    $this->assertFalse(isset($releaseList[count($releaseList)]));
  }

  public static function propertyGettersDataProvider(): array {
    return [
      [
        '/../../Fixtures/amqp/allreleases.xml',
        [
          'amqp',
          'pecl.php.net',
          42,
          [
            new Version(new SimpleXMLElement('<r><v>1.10.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.10.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.9.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.9.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.9.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.9.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.9.0beta2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.9.0beta1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.8.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.8.0beta2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.8.0beta1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.7.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.7.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.7.0alpha2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.7.0alpha1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0beta4</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0beta3</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0beta2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.0beta2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.0beta1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.0</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.10</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.9</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.8</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.7</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.6</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.5</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.3.1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.3.0</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.2.2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.2.1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.2.0</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.1.1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.1.0</v><s>beta</s></r>'))
          ]
        ]
      ],
      [
        '/../../Fixtures/mongo/allreleases.xml',
        [
          'mongo',
          'pecl.php.net',
          85,
          [
            new Version(new SimpleXMLElement('<r><v>1.6.16</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.15</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.14</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.13</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.12</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.11</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.10</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.9</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.8</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.7</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.6</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.5</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0RC3</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0RC2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0RC1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.8</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.7</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.6</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.5</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.0RC2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.0RC1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.0alpha1</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.5</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.0RC1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.0beta1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.7</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.6</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.5</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.2RC1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.0RC3</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.0RC2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.0RC1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.0beta2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.0beta1</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.12</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.11</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.10</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.9</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.8</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.7</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.6</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.5</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.11</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.10</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.9</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.8</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.7</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.6</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.5</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.9.0</v><s>alpha</s></r>'))
          ]
        ]
      ],
      [
        '/../../Fixtures/mongodb/allreleases.xml',
        [
          'mongodb',
          'pecl.php.net',
          85,
          [
            new Version(new SimpleXMLElement('<r><v>1.9.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.9.0RC1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.8.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.8.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.8.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.8.0RC1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.7.5</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.8.0beta2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.8.0beta1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.7.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.7.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.7.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.7.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.7.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0RC1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0alpha3</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.5</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0alpha2</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.6.0alpha1</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.5.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.0RC2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.0RC1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.4.0beta1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.11</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.0RC1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.10</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.3.0beta1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.9</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.8</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.7</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.6</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.5</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.10</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.9</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.0alpha3</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.0alpha2</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.2.0alpha1</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.8</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.7</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.6</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.5</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.0RC0</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.0beta2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.0beta1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.0alpha2</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.0alpha1</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.6.3</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.6.2</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.6.1</v><s>devel</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.6.0</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.5.1</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.5.0</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.4.1</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.4.0</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.3.1</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.3.0</v><s>alpha</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.2.0</v><s>alpha</s></r>'))
          ]
        ]
      ],
      [
        '/../../Fixtures/parallel/allreleases.xml',
        [
          'parallel',
          'pecl.php.net',
          14,
          [
            new Version(new SimpleXMLElement('<r><v>1.1.4</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.1.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.3</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.2</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.1</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>1.0.0</v><s>stable</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.9.0</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.8.3</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.8.2</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.8.1</v><s>beta</s></r>')),
            new Version(new SimpleXMLElement('<r><v>0.8.0</v><s>beta</s></r>'))
          ]
        ]
      ]
    ];
  }
}
