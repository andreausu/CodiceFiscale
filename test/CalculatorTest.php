<?php
require_once __DIR__ . '/../vendor/autoload.php';

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    protected $persons;

    public function setUp()
    {
        $this->persons = [
            [
                "nome" => "andrea",
                "cognome" => "usuelli",
                "sesso" => "m",
                "dataNascita" => new \DateTime("1991-01-05"),
                "codiceComune" => "F205",
                'expected' => 'SLLNDR91A05F205T'
            ],
            [
                "nome" => "chiara",
                "cognome" => "nònlòsò",
                "sesso" => "f",
                "dataNascita" => new \DateTime("1992-03-06"),
                "codiceComune" => "F205",
                'expected' => 'NNLCHR92C46F205N'
            ],
            [
                "nome" => "hu",
                "cognome" => "hu",
                "sesso" => "m",
                "dataNascita" => new \DateTime("1956-09-30"),
                "codiceComune" => "Z210",
                'expected' => 'HUXHUX56P30Z210K'
            ],
            [
                "nome" => "hu",
                "cognome" => "hu",
                "sesso" => "f",
                "dataNascita" => new \DateTime("1956-09-30"),
                "codiceComune" => "Z210",
                'expected' => 'HUXHUX56P70Z210O'
            ],
            [
                "nome" => "luca marco giovanni",
                "cognome" => "d'abate spigna maria",
                "sesso" => "m",
                "dataNascita" => new \DateTime("1968-05-26"),
                "codiceComune" => "C926",
                'expected' => 'DBTLMR68E26C926B'
            ],
            [
                "nome" => "l'arnalda",
                "cognome" => "d'annunzio",
                "sesso" => "F",
                "dataNascita" => new \DateTime("1983-12-31"),
                "codiceComune" => "D856",
                'expected' => 'DNNLNL83T71D856L'
            ]
        ];
    }

    public function testCalcoloCodiceFiscale()
    {
        $cf = new \CodiceFiscale\Calculator();

        foreach ($this->persons as $person) {
            $this->assertEquals($person['expected'], $cf->calcola($person['nome'], $person['cognome'], $person['sesso'], $person['dataNascita'], $person['codiceComune']));
        }
    }
}
