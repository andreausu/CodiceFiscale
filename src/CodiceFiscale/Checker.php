<?php

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
    private $sex = null;

    /**
     * Country Birth
     * @var integer
     */
    private $countryBirth = null;

    /**
     * Day Birth
     * @var integer
     */
    private $dayBirth = null;

    /**
     * Month Birth
     * @var integer
     */
    private $monthBirth = null;

    /**
     * Year Birth
     * @var integer
     */
    private $yearBirth = null;

    /**
     * Error
     * @var string
     */
    private $error = null;

    /**
     * List replace omocodia
     * @var array
     */
    private $listDecOmocodia = array('A' => '!', 'B' => '!', 'C' => '!', 'D' => '!', 'E' => '!', 'F' => '!', 'G' => '!', 'H' => '!', 'I' => '!', 'J' => '!', 'K' => '!', 'L' => '0', 'M' => '1', 'N' => '2', 'O' => '!', 'P' => '3', 'Q' => '4', 'R' => '5', 'S' => '6', 'T' => '7', 'U' => '8', 'V' => '9', 'W' => '!', 'X' => '!', 'Y' => '!', 'Z' => '!',);

    /**
     * Positions affected characters to alteration of coding in the case of omocodia
     * @var array
     */
    private $listSostOmocodia = array(6, 7, 9, 10, 12, 13, 14);

    /**
     * Weight even char
     * @var array
     */
    private $listEvenChar = array('0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, 'A' => 0, 'B' => 1, 'C' => 2, 'D' => 3, 'E' => 4, 'F' => 5, 'G' => 6, 'H' => 7, 'I' => 8, 'J' => 9, 'K' => 10, 'L' => 11, 'M' => 12, 'N' => 13, 'O' => 14, 'P' => 15, 'Q' => 16, 'R' => 17, 'S' => 18, 'T' => 19, 'U' => 20, 'V' => 21, 'W' => 22, 'X' => 23, 'Y' => 24, 'Z' => 25);

    /**
     * Weight odd char
     * @var unknown_type
     */
    private $listOddChar = array('0' => 1, '1' => 0, '2' => 5, '3' => 7, '4' => 9, '5' => 13, '6' => 15, '7' => 17, '8' => 19, '9' => 21, 'A' => 1, 'B' => 0, 'C' => 5, 'D' => 7, 'E' => 9, 'F' => 13, 'G' => 15, 'H' => 17, 'I' => 19, 'J' => 21, 'K' => 2, 'L' => 4, 'M' => 18, 'N' => 20, 'O' => 11, 'P' => 3, 'Q' => 6, 'R' => 8, 'S' => 12, 'T' => 14, 'U' => 16, 'V' => 10, 'W' => 22, 'X' => 25, 'Y' => 24, 'Z' => 23);

    /**
     * Control code (char 16)
     * @var array
     */
    private $listCtrlCode = array(0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D', 4 => 'E', 5 => 'F', 6 => 'G', 7 => 'H', 8 => 'I', 9 => 'J', 10 => 'K', 11 => 'L', 12 => 'M', 13 => 'N', 14 => 'O', 15 => 'P', 16 => 'Q', 17 => 'R', 18 => 'S', 19 => 'T', 20 => 'U', 21 => 'V', 22 => 'W', 23 => 'X', 24 => 'Y', 25 => 'Z');

    /**
     * Month code
     * @var array
     */
    private $listDecMonth = array('A' => '01', 'B' => '02', 'C' => '03', 'D' => '04', 'E' => '05', 'H' => '06', 'L' => '07', 'M' => '08', 'P' => '09', 'R' => '10', 'S' => '11', 'T' => '12');

    /**
     * Error list
     * @var unknown_type
     */
    private $listError = array(0 => 'Empty code', 1 => 'Len error', 2 => 'Code with wrong char', 3 => 'Code with wrong char in omocodia', 4 => 'Wrong code');


    /**
     * Getter isValid
     * @return boolean
     */
    public function getIsValid()
    {
        return $this->isValid;
    }


    /**
     * Getter Error
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }


    /**
     * Getter Sex
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }


    /**
     * Getter CountryBirth
     * @return integer
     */
    public function getCountryBirth()
    {
        return $this->countryBirth;
    }


    /**
     * Getter YearBirth
     * @return integer
     */
    public function getYearBirth()
    {
        return $this->yearBirth;
    }


    /**
     * Getter MonthBirth
     * @return integer
     */
    public function getMonthBirth()
    {
        return $this->monthBirth;
    }


    /**
     * Getter DayBirth
     * @return integer
     */
    public function getDayBirth()
    {
        return $this->dayBirth;
    }


    /**
     * Check Codice Fiscale
     * @param string $codiceFiscale
     * @return boolean
     */
    public function isFormallyCorrect($codiceFiscale)
    {
        $this->resetProperties();

        try {
            // check empty
            if (empty($codiceFiscale)) {
                $this->raiseException(0);
            }

            // Vcheck len
            if (strlen($codiceFiscale) !== 16) {
                $this->raiseException(1);
            }

            // Check regex
            if (!preg_match(self::REGEX_CODICEFISCALE, $codiceFiscale)) {
                $this->raiseException(2);
            }

            $codiceFiscale = strtoupper($codiceFiscale);
            $cFCharList = str_split($codiceFiscale);

            // check omocodia
            for ($i = 0; $i < count($this->listSostOmocodia); $i++) {
                if (!is_numeric($cFCharList[$this->listSostOmocodia[$i]])) {
                    if ($this->listDecOmocodia[$cFCharList[$this->listSostOmocodia[$i]]] === '!') {
                        $this->raiseException(3);
                    }
                }
            }

            $pari = 0;
            $dispari = $this->listOddChar[$cFCharList[14]];

            // loop first 14 char, step 2
            for ($i = 0; $i < 13; $i += 2) {
                $dispari = $dispari + $this->listOddChar[$cFCharList[$i]];
                $pari = $pari + $this->listEvenChar[$cFCharList[$i + 1]];
            }

            // verify first 15 char with checksum char (char 16)
            if (!($this->listCtrlCode[($pari + $dispari) % 26] === $cFCharList[15])) {
                $this->raiseException(4);
            }

            // replace "omocodie"
            for ($i = 0; $i < count($this->listSostOmocodia); $i++) {
                if (!is_numeric($cFCharList[$this->listSostOmocodia[$i]])) {
                    $CFCharList[$this->listSostOmocodia[$i]] = $this->listDecOmocodia[$cFCharList[$this->listSostOmocodia[$i]]];
                }
            }

            $codiceFiscaleAdattato = implode($cFCharList);

            // get fiscal code data
            $this->sex = ((int)(substr($codiceFiscaleAdattato, 9, 2) > 40) ? self::CHR_WOMEN : self::CHR_MALE);
            $this->countryBirth = substr($codiceFiscaleAdattato, 11, 4);
            $this->yearBirth = substr($codiceFiscaleAdattato, 6, 2);
            $this->dayBirth = substr($codiceFiscaleAdattato, 9, 2);
            $this->monthBirth = $this->listDecMonth[substr($codiceFiscaleAdattato, 8, 1)];

            // get day birth if sex is women
            if ($this->sex == self::CHR_WOMEN) {
                $this->dayBirth = $this->dayBirth - 40;

                if (strlen($this->dayBirth) === 1) {
                    $this->dayBirth = '0' . $this->dayBirth;
                }
            }

            // End verify
            $this->isValid = true;
            $this->error = null;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            $this->isValid = false;
        }

        return $this->isValid;
    }


    /**
     * Reset Class Properties
     * @return void
     */
    private function resetProperties()
    {
        $this->isValid = false;
        $this->sex = null;
        $this->countryBirth = null;
        $this->dayBirth = null;
        $this->monthBirth = null;
        $this->yearBirth = null;
        $this->error = null;
    }


    /**
     * Raise Exception
     * @param integer $errorNum
     * @throws \Exception
     * @return void
     */
    private function raiseException($errorNum)
    {
        $errMessage = isset($this->listError[$errorNum]) ? $this->listError[$errorNum] : 'Unknown Exception';

        throw new \Exception($errMessage, $errorNum);
    }
}
