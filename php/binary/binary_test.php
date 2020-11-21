<?php

class BinaryTest extends PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass() : void
    {
        require_once 'binary.php';
    }

    public function testItParsesBinary0ToDecimal0() : void
    {
        $this->assertEquals(0, parse_binary('0'));
    }

    public function testItParsesBinary1ToDecimal1() : void
    {
        $this->assertEquals(1, parse_binary('1'));
    }

    public function testItParsesDigits() : void
    {
        $this->assertEquals(2, parse_binary('10'));
        $this->assertEquals(3, parse_binary('11'));
        $this->assertEquals(4, parse_binary('100'));
        $this->assertEquals(9, parse_binary('1001'));
    }

    public function testItParsesHundreds() : void
    {
        $this->assertEquals(128, parse_binary('10000000'));
        $this->assertEquals(315, parse_binary('100111011'));
        $this->assertEquals(800, parse_binary('1100100000'));
        $this->assertEquals(999, parse_binary('1111100111'));
    }

    public function testItParsesMaxInt() : void
    {
        $this->assertEquals(
            9223372036854775807,
            parse_binary('111111111111111111111111111111111111111111111111111111111111111')
        );
    }

    public function testItParsesMaxFloat(): void
    {
        $this->assertEquals(
            1.7976931348623E+308,
            parse_binary('1111111111111111111111111111111111111111111111011000001001011101010110010101111011100111100101000110001011111111001101011101001101010010001010010000100010000111000001010110000110101010110010010110111110010010110011100010101000001100101100000101001000000010010000111000110101110010110110110100110110111011000100010011111110000001110001100001011000100100111010110111010001110010110001001111010010011000111000011111001100110101100001011100111111110101110111001100101001001011110110101100111101011001111101101101011010011010011010011111101011011100111001101110000001110100111111101001000010110001101111100110100011110110111100000100111010101100011101010100111010001011101100100010111110110001111010100110010101111111011011010101000110000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000')
        );
    }

    public function testItParsesValuesWithLeadingZeros() : void
    {
        $this->assertEquals(1, parse_binary('01'));
        $this->assertEquals(2, parse_binary('0010'));
        $this->assertEquals(3, parse_binary('00011'));
    }

    /**
     * @dataProvider invalidValues
     */
    public function testItOnlyAcceptsStringsContainingZerosAndOnes($value) : void
    {
        $this->expectException(InvalidArgumentException::class);

        parse_binary($value);
    }

    public function invalidValues() : array
    {
        return [
          ['-0101'], ['2'], ['12345'], ['a'], ['0abcdef'],
        ];
    }
}
