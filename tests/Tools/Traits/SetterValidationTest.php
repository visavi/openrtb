<?php

namespace OpenRtb\Tests\Tools\Traits;

use PHPUnit\Framework\TestCase;
use OpenRtb\Tests\AccessProtectedMethod;

class SetterValidationTest extends TestCase
{
    private $setterValidation;

    public function setUp(): void
    {
        $this->setterValidation =  $this->getMockForTrait('OpenRtb\Tools\Traits\SetterValidation');
    }

    public function testValidateString()
    {
        $this->assertTrue(AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateString', ['test', 1]));
    }

    /**
     * @dataProvider validateStringExceptionProvider
     */
    public function testValidateStringException($value)
    {
        $this->expectException(\OpenRtb\Tools\Exceptions\ExceptionInvalidValue::class);
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateString', [$value]);
    }

    public function validateStringExceptionProvider()
    {
        return [
            [1],
            [1.234],
            [new \stdClass]
        ];
    }

    public function testValidateInt()
    {
        $this->assertEquals(1, AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateInt', [1]));
        $this->assertEquals(-1, AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateInt', [-1]));
        $this->assertEquals(0, AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateInt', [0]));
    }

    /**
     * @dataProvider validateIntExceptionProvider
     */
    public function testValidateIntException($value)
    {
        $this->expectException(\OpenRtb\Tools\Exceptions\ExceptionInvalidValue::class);
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateInt', [$value, 1]);
    }

    public function validateIntExceptionProvider()
    {
        return [
            ['test'],
            [1.234],
            [new \stdClass]
        ];
    }

    public function testValidatePositiveInt()
    {
        $this->assertEquals(1, AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveInt', [1, 1]));
        $this->assertEquals(0, AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveInt', [0, 1]));
    }

    /**
     * @dataProvider validatePositiveIntExceptionProvider
     */
    public function testValidatePositiveIntException($value)
    {
        $this->expectException(\OpenRtb\Tools\Exceptions\ExceptionInvalidValue::class);
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveInt', [$value, 1]);
    }

    public function validatePositiveIntExceptionProvider()
    {
        return [
            ['test'],
            [1.234],
            [-1],
            [new \stdClass]
        ];
    }

    public function testValidatePositiveFloat()
    {
        $this->assertEquals(
            0.0,
            AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveFloat', [0.0, 1])
        );
        $this->assertEquals(
            1.2,
            AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveFloat', [1.2, 1])
        );
        $this->assertEquals(
            0.0,
            AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveFloat', [0, 1])
        );
        $this->assertEquals(
            1.0,
            AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveFloat', [1, 1])
        );
    }

    /**
     * @dataProvider validatePositiveFloatExceptionProvider
     */
    public function testValidatePositiveFloatException($value)
    {
        $this->expectException(\OpenRtb\Tools\Exceptions\ExceptionInvalidValue::class);
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveFloat', [$value, 1]);
    }

    public function validatePositiveFloatExceptionProvider()
    {
        return [
            ['test'],
            [-1],
            [-1.2],
            [new \stdClass]
        ];
    }

    public function testValidateIn()
    {
        $this->assertTrue(
            AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateIn', [1, [1 ,2, 3], 1])
        );
        $this->assertTrue(
            AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateIn', ['alpha', ['alpha', 'bravo'], 1])
        );
    }

    /**
     * @dataProvider validateInExceptionProvider
     */
    public function testValidateInException($value, $validValues)
    {
        $this->expectException(\OpenRtb\Tools\Exceptions\ExceptionInvalidValue::class);
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateIn', [$value, $validValues, 1]);
    }

    public function validateInExceptionProvider()
    {
        return [
            ['test', ['alpha', 'bravo']],
            [1, [2, 3]]
        ];
    }

    public function testValidateInWithCustom500Values()
    {
        $this->assertTrue(
            AccessProtectedMethod::invokeMethod(
                $this->setterValidation,
                'validateInWithCustom500Values',
                [501, [1 ,2, 3], 1]
            )
        );
        $this->assertTrue(
            AccessProtectedMethod::invokeMethod(
                $this->setterValidation,
                'validateInWithCustom500Values',
                [599, [1 ,2, 3], 1]
            )
        );
    }

    /**
     * @dataProvider validateInWithCustom500ValuesExceptionProvider
     */
    public function testValidateInWithCustom500ValuesException($value, $validValues)
    {
        $this->expectException(\OpenRtb\Tools\Exceptions\ExceptionInvalidValue::class);
        AccessProtectedMethod::invokeMethod(
            $this->setterValidation,
            'validateInWithCustom500Values',
            [$value, $validValues, 1]
        );
    }

    public function validateInWithCustom500ValuesExceptionProvider()
    {
        return [
            [99, [1, 2, 3]],
            [499, [1, 2, 3]]
        ];
    }

    public function testValidateMd5()
    {
        $this->assertTrue(AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateMd5', [md5(1), 1]));
    }

    /**
     * @dataProvider validateMd5ExceptionProvider
     */
    public function testValidateMd5Exception($value)
    {
        $this->expectException(\OpenRtb\Tools\Exceptions\ExceptionInvalidValue::class);
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateMd5', [$value, 1]);
    }

    public function validateMd5ExceptionProvider()
    {
        return [
            ['g4ca4238a0b923820dcc509a6f75849b'],
            ['cc4ca4238a0b923820dcc509a6f75849b'],
            ['4ca4238a0b923820dcc509a6f75849b'],
            [1],
            [1.234],
            [new \stdClass]
        ];
    }

    public function testValidateSha1()
    {
        $this->assertTrue(AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateSha1', [sha1(1), 1]));
    }

    /**
     * @dataProvider validateSha1ExceptionProvider
     */
    public function testValidateSha1Exception($value)
    {
        $this->expectException(\OpenRtb\Tools\Exceptions\ExceptionInvalidValue::class);
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateSha1', [$value, 1]);
    }

    public function validateSha1ExceptionProvider()
    {
        return [
            ['g4ca4238a0b923820dcc509a6f75849b509a6f75'],
            ['cc4ca4238a0b923820dcc509a6f75849b509a6f75'],
            ['4ca4238a0b923820dcc509a6f75849b509a6f75'],
            [1],
            [1.234],
            [new \stdClass]
        ];
    }

    /**
    * @dataProvider validateIpProvider
    */
    public function testValidateIp($ip)
    {
        $this->assertTrue(AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateIp', [$ip]));
    }

    public function validateIpProvider()
    {
        return [
            ['2001:cdba:0000:0000:0000:0000:3257:9652'],
            ['2001:cdba:0:0:0:0:3257:9652'],
            ['2001:cdba::3257:9652'],
            ['192.168.0.1'],
            ['188.200.88.12'],
            ['0.0.0.0'],
            ['8.8.8.8']
        ];
    }

    /**
     * @dataProvider validateIpExceptionProvider
     */
    public function testValidateIpException($ip)
    {
        $this->expectException(\OpenRtb\Tools\Exceptions\ExceptionInvalidValue::class);
        $this->assertTrue(AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateIp', [$ip]));
    }

    public function validateIpExceptionProvider()
    {
        return [
            ['zzzz:cdba:0000:0000:0000:0000:3257:9652'],
            ['2001:cdba:0:0:0:0:zzzz:9652'],
            ['2001:cdba3257:9652'],
            ['192.168.0.256'],
            ['188.200.88'],
            ['0.0.0.1000'],
            ['8.8.8.800']
        ];
    }
}
