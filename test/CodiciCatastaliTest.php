<?php
require_once __DIR__ . '/../vendor/autoload.php';

class CodiciCatastaliTest extends PHPUnit_Framework_TestCase
{
    protected $codici;
    protected $comuni; 

    public function setUp()
    {
        $this->codici = array(
            "A001" => "ABANO TERME",
            "Z356" => "ZANZIBAR",
        	"XXXX" => null
        );

        $this->comuni = array(
            "ABANO TERME" => "A001",
            "ZANZIBAR" => "Z356",
            "MORDOR" => null
        );
    }

    public function testGetComune()
    {
    	$cc = new \CodiceFiscale\CodiciCatastali(dirname(dirname(__FILE__)).'\data\CCList.txt');

        foreach ($this->codici as $cod => $expt) {
            $this->assertEquals($expt, $cc->GetComune($cod));
        }

        foreach ($this->comuni as $name => $expt) {
            $this->assertEquals($expt, $cc->GetCodiceCatastale($name));
        }
    }
}
