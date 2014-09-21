namespace CodiceFiscale;

/**
 * Class to check if italian fiscal's code (codice fiscale) is formally Correct
 * @author SimoneNigro
 *
 */
class Checker
{
    // fiscal's code regex
    const REGEX_CODICEFISCALE = '/^[a-z]{6}[0-9]{2}[a-z][0-9]{2}[a-z][0-9]{3}[a-z]$/i';

    // women char
    const CHR_WOMEN = 'F';

    // male char
    const CHR_MALE = 'M';


    /**
     * is Valid
     * @var bool
     */
    private $isValid = false;

    /**
     * Sex
     * @var string
     */
    private $Sex = null;

    /**
     * Country Birth
     * @var integer
     */
    private $CountryBirth = null;

    /**
     * Day Birth
     * @var integer
     */
    private $DayBirth = null;

    /**
     * Month Birth
     * @var integer
     */
    private $MonthBirth = null;

    /**
     * Year Birth
     * @var integer
     */
    private $YearBirth = null;

    /**
     * Error
     * @var string
     */
    private $Error = null;

    /**
     * List replace omocodia
     * @var array
     */
    private $ListDecOmocodia = array('A' => '!', 'B' => '!', 'C' => '!', 'D' => '!', 'E' => '!', 'F' => '!', 'G' => '!', 'H' => '!', 'I' => '!', 'J' => '!', 'K' => '!', 'L' => '0', 'M' => '1', 'N' => '2', 'O' => '!', 'P' => '3', 'Q' => '4', 'R' => '5', 'S' => '6', 'T' => '7', 'U' => '8', 'V' => '9', 'W' => '!', 'X' => '!', 'Y' => '!', 'Z' => '!', );

    /**
     * Positions affected characters to alteration of coding in the case of omocodia
     * @var array
    */
    private $ListSostOmocodia = array(6,7,9,10,12,13,14);

    /**
     * Weight even char
     * @var array
    */
    private $ListEvenChar = array('0' => 0 , '1' => 1 , '2' => 2 , '3' => 3 , '4' => 4 , '5' => 5 , '6' => 6 , '7' => 7 , '8' => 8 , '9' => 9 , 'A' => 0 , 'B' => 1 , 'C' => 2 , 'D' => 3 , 'E' => 4 , 'F' => 5 , 'G' => 6 , 'H' => 7 , 'I' => 8 , 'J' => 9, 'K' => 10, 'L' => 11, 'M' => 12, 'N' => 13, 'O' => 14, 'P' => 15, 'Q' => 16, 'R' => 17, 'S' => 18, 'T' => 19, 'U' => 20, 'V' => 21, 'W' => 22, 'X' => 23, 'Y' => 24, 'Z' => 25);

    /**
     * Weight odd char
     * @var unknown_type
    */
    private $ListOddChar = array('0' => 1 , '1' => 0 , '2' => 5 , '3' => 7 , '4' => 9 , '5' => 13, '6' => 15, '7' => 17, '8' => 19, '9' => 21, 'A' => 1 , 'B' => 0 , 'C' => 5 , 'D' => 7 , 'E' => 9 , 'F' => 13, 'G' => 15, 'H' => 17, 'I' => 19, 'J' => 21, 'K' => 2 , 'L' => 4 , 'M' => 18, 'N' => 20, 'O' => 11, 'P' => 3 , 'Q' => 6 , 'R' => 8 , 'S' => 12, 'T' => 14, 'U' => 16, 'V' => 10, 'W' => 22, 'X' => 25, 'Y' => 24, 'Z' => 23  );

    /**
     * Control code (char 16)
     * @var array
    */
    private $ListCtrlCode = array( 0 => 'A',  1 => 'B',  2 => 'C',  3 => 'D',  4 => 'E',  5 => 'F',  6 => 'G',  7 => 'H',  8 => 'I',  9 => 'J', 10 => 'K', 11 => 'L', 12 => 'M', 13 => 'N', 14 => 'O', 15 => 'P', 16 => 'Q', 17 => 'R', 18 => 'S', 19 => 'T', 20 => 'U', 21 => 'V', 22 => 'W', 23 => 'X', 24 => 'Y', 25 => 'Z');

    /**
     * Month code
     * @var array
    */
    private $ListDecMonth = array('A' => '01', 'B' => '02', 'C' => '03', 'D' => '04', 'E' => '05', 'H' => '06', 'L' => '07', 'M' => '08', 'P' => '09', 'R' => '10', 'S' => '11', 'T' => '12');

    /**
     * Error list
     * @var unknown_type
    */
    private $ListError = array(0 => 'Empty code', 1 => 'Len error', 2 => 'Code with wrong char', 3 => 'Code with wrong char in omocodia', 4 => 'Wrong code');


    /**
     * Constructor
     * @return CodiceFiscale
    */
    public function __construct()
    {

    }


    /**
     * Destructor
     * @return void
     */
    public function __destruct()
    {

    }


    /**
     * Getter isValid
     * @return boolean
     */
    public function GetisValid()
    {
        return $this->isValid;
    }


    /**
     * Getter Error
     * @return string
     */
    public function GetError()
    {
        return $this->Error;
    }


    /**
     * Getter Sex
     * @return string
     */
    public function GetSex()
    {
        return $this->Sex;
    }


    /**
     * Getter CountryBirth
     * @return integer
     */
    public function GetCountryBirth()
    {
        return $this->CountryBirth;
    }


    /**
     * Getter YearBirth
     * @return integer
     */
    public function GetYearBirth()
    {
        return $this->YearBirth;
    }


    /**
     * Getter MonthBirth
     * @return integer
     */
    public function GetMonthBirth()
    {
        return $this->MonthBirth;
    }


    /**
     * Getter DayBirth
     * @return integer
     */
    public function GetDayBirth()
    {
        return $this->DayBirth;
    }


    /**
     * Check Codice Fiscale
     * @param string $CodiceFiscale
     * @return boolean
     */
    public function isFormallyCorrect($CodiceFiscale)
    {
        $this->ResetProperties();

        try
        {
            // check empty
            if ( empty($CodiceFiscale) )
                $this->RaiseException(0);

            // Vcheck len
            if ( strlen($CodiceFiscale) !== 16)
                $this->RaiseException(1);

            // Check regex
            if( !preg_match(self::REGEX_CODICEFISCALE, $CodiceFiscale) )
                $this->RaiseException(2);

            
            $CodiceFiscale = strtoupper($CodiceFiscale);
            $CFCharList    = str_split($CodiceFiscale);


            // check omocodia
            for ($i = 0; $i < count($this->ListSostOmocodia); $i++)
            {
                if (!is_numeric($CFCharList[$this->ListSostOmocodia[$i]])){
                    if ($this->ListDecOmocodia[$CFCharList[$this->ListSostOmocodia[$i]]]==='!')
                        $this->RaiseException(3);
                }
            }

            $Pari    = 0;
            $Dispari = $this->ListOddChar[$CFCharList[14]];

            // loop first 14 char, step 2
            for ($i = 0; $i < 13; $i+=2)
            {
                $Dispari = $Dispari + $this->ListOddChar[$CFCharList[$i]];
                $Pari    = $Pari    + $this->ListEvenChar[$CFCharList[$i+1]];
            }

            // verify first 15 char with checksum char (char 16)
            if (!($this->ListCtrlCode[($Pari+$Dispari) % 26]  === $CFCharList[15]))
                $this->RaiseException(4);

            // replace "omocodie"
            for ($i = 0; $i < count($this->ListSostOmocodia); $i++)
            {
                if (!is_numeric($CFCharList[$this->ListSostOmocodia[$i]]))
                    $CFCharList[$this->ListSostOmocodia[$i]] = $this->ListDecOmocodia[$CFCharList[$this->ListSostOmocodia[$i]]];
            }

            
            $CodiceFiscaleAdattato = implode($CFCharList);

            // get fiscal code data
            $this ->Sex          = ((int)(substr($CodiceFiscaleAdattato,9,2) > 40) ? self::CHR_WOMEN : self::CHR_MALE);
            $this ->CountryBirth = substr($CodiceFiscaleAdattato, 11, 4);
            $this ->YearBirth    = substr($CodiceFiscaleAdattato, 6,  2);
            $this ->DayBirth     = substr($CodiceFiscaleAdattato, 9,  2);
            $this ->MonthBirth   = $this->ListDecMonth[substr($CodiceFiscaleAdattato,8,1)];

            // get day birth if sex is women
            if($this->Sex == self::CHR_WOMEN){
                $this ->DayBirth = $this ->DayBirth - 40;

                if (strlen($this ->DayBirth)===1)
                    $this ->DayBirth = '0'.$this ->DayBirth;
            }

            // End verify
            $this ->isValid = true;
            $this ->Error   = null;
        }
        catch(\Exception $e)
        {
            $this->Error   = $e->getMessage();
            $this->isValid = false;
        }

        return $this->isValid;
    }


    /**
     * Reset Class Properties
     * @return void
     */
    private function ResetProperties()
    {
        $this->isValid      = false;
        $this->Sex          = null;
        $this->CountryBirth = null;
        $this->DayBirth     = null;
        $this->MonthBirth   = null;
        $this->YearBirth    = null;
        $this->Error        = null;
    }


    /**
     * Raise Exception
     * @param integer $ErrorNum
     * @throws \Exception
     * @return void
     */
    private function RaiseException($ErrorNum)
    {
        $ErrMessage = isset($this->ListError[$ErrorNum]) ? $this->ListError[$ErrorNum] : 'Unknown Exception';

        throw new \Exception($ErrMessage, $ErrorNum);
    }
}
