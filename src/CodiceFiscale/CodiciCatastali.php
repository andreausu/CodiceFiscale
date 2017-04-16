<?php
namespace CodiceFiscale;

class CodiciCatastali {
    
    /**
     * Codici Catastali
     * @var array
     */
    private $CCList;
    
    /**
     * Constructor
     * @param string $PathToTxt Path to txt data list
     * @return CodiciCatastali
     */
    function __construct($PathToTxt)
    {
        $this->popolateCCList($PathToTxt);
    }
    
    
    /**
     * $CCList popolate
     * @param string $PathToTxt Path to txt data list
     * @throws \Exception
     * @return void
     */
    private function popolateCCList($PathToTxt){
        
        if( $cnt = file_get_contents($PathToTxt) ){
            
            if( empty($cnt) )
                throw new \Exception(sprintf('file %s is empty', $PathToTxt));
            
            $cntLines = explode("\n", $cnt);
            $totLines = (is_array($cntLines)) ? count($cntLines) : 0;
            
            if( $totLines <= 0 )
                throw new \Exception(sprintf('no line found in %s', $PathToTxt));
            
            for ($i = 0; $i < $totLines; $i++)
            {
                $currLine  = $cntLines[$i];
                
                if( empty($currLine) )
                    throw new \Exception(sprintf('empty line %d', $i));
                
                $lineParts = explode(';', $cntLines[$i]);
                
                if( !isset($lineParts[0], $lineParts[1]) )
                    throw new \Exception(sprintf('separator ; missed on line %d: %s', $i, $currLine));
                
                $CCcode = trim($lineParts[1]);
                $CCname = trim($lineParts[0]);
                
                if( empty($CCcode) )
                    throw new \Exception(sprintf('empty code on line %d: %s', $i, $currLine));
                
                if( empty($CCname) )
                    throw new \Exception(sprintf('empty name on line %d: %s', $i, $currLine));
                
                $this->CCList[$CCcode] = $CCname;
            }
        }
        else{
            throw new \Exception(sprintf('open file %s fail', $PathToTxt));
        }
    }
    
    
    /**
     * Get Comune from Codice Catastale
     * @param string $CCCode Codice Catastale
     * @return Ambigous <NULL, \CodiceFiscale\arrai>
     */
    public function GetComune($CCCode){
        return (isset($this->CCList[$CCCode])) ? $this->CCList[$CCCode] : null;
    }
    
    /**
     * Get Codice Catastale from Comune
     * @param string $Comune
     */
    public function GetCodiceCatastale($Comune){
    	return array_search(strtoupper($Comune), $this->CCList);
    }
}
