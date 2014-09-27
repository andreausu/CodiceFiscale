<?php
require_once __DIR__ . '/../vendor/autoload.php';

class CoreTest extends \PHPUnit_Framework_TestCase
{
    public function testCore()
    {
    	$DR = DIRECTORY_SEPARATOR;
    	
    	$calc = new \CodiceFiscale\Calculator();
    	$chk  = new \CodiceFiscale\Checker();
    	$cc   = new \CodiceFiscale\CodiciCatastali(dirname(dirname(__FILE__)).$DR.'data'.$DR.'CCList.txt');
    	
    	$nome        = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 3, 12);
    	$cognome     = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 3, 12);
    	$dataNascita = new \DateTime(date('Y-m-d', strtotime( '-'.mt_rand(0,54750).' days')));
    	$cCode       = array_rand($cc->GetCodiciCatastali());
    	$sesso       = substr(str_shuffle("MF"), 1, 2);
    	
    	$CF = $calc->calcola($nome, $cognome, $sesso, $dataNascita, $cCode);
    	
    	for($i = 0; $i < 10000; $i++)
    	{
    		$this->assertTrue($chk->isFormallyCorrect($CF));
    	}
    }
}
