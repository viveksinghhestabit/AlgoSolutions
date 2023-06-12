<?php
ini_set('error_reporting', 1);

class camelCasePatternMatch
{
    protected $dictionary = [
        "WelcomeGeek",
        "WelcomeToGeeksForGeeks", "GeeksForGeeks"
    ];

    protected $pattern = 'WTG';

    public function checkPatten()
    {
        $capitalizedArray = [];
        foreach ($this->dictionary as $word) {
            $check = $this->checkAvailability($word);
            if ($check)
                $capitalizedArray[] = [$word, $check];
        }

        $patternMatch = [];
        foreach ($capitalizedArray as $word) {
            $check = $this->checkPattern($this->pattern, $word[1]);
            if ($check)
                $patternMatch[] = $word[0];
        }
        print_r($patternMatch);
    }

    protected function checkAvailability($word)
    {
        $caps = $this->getCapitalsFromWord($word);
        return $caps;
    }

    protected function getCapitalsFromWord($word)
    {
        $caps = '';
        for ($i = 0; $i < strlen($word); $i++) {
            if (ctype_upper($word[$i])) {
                $caps .= $word[$i];
            }
        }
        return $caps;
    }

    protected function checkPattern($pattern, $word)
    {
        $patternLength = strlen($pattern);
        $wordLength = strlen($word);
        $iteration = $wordLength - $patternLength;
        $count = 0;
        for ($i = 0; $i < $iteration; $i++) {
            $newWord = '';
            for ($j = $i; $j < ($i + $patternLength); $j++) {
                $newWord .= $word[$j];
            }
            if ($pattern == $newWord) {
                $count++;
            }
        }
        if ($count > 0) {
            return true;
        }
        return false;
    }
}

$call = new camelCasePatternMatch();
$call->checkPatten();
