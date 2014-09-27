<?php
require_once __DIR__ . '/../vendor/autoload.php';

class CheckerTest extends \PHPUnit_Framework_TestCase
{
    protected $codiciFiscaliOk;
    protected $codiciFiscaliKo;

    public function setUp()
    {
        $this->codiciFiscaliOk = [
            "RSSMRA79S18F205J",
            "CHRVRD74S53L219F"
        ];

        $this->codiciFiscaliKo = [
            "SLLNDR91C06F205",
            "SXLNDQ67CS8Z210L",
            "XSD91S67CS8Z210L"
        ];
    }

    public function testCorrettezzaFormaleCodiceFiscale()
    {
        $checker = new \CodiceFiscale\Checker();

        foreach ($this->codiciFiscaliOk as $cf) {
            $this->assertTrue($checker->isFormallyCorrect($cf));
        }

        foreach ($this->codiciFiscaliKo as $cf) {
            $this->assertFalse($checker->isFormallyCorrect($cf));
        }
    }
}
