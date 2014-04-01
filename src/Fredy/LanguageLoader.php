<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 27.03.14
 * Time: 13:39
 */

namespace Fredy;


class LanguageLoader
{
    private $defaultLanguage;
    private $activeLanguage;
    private $languageArray;
    private $languageDirectory;

    function __construct($defaultLanguage, $languageArray, $languageDirectory, $acceptLanguage)
    {
        $this->defaultLanguage = $defaultLanguage;
        $this->activeLanguage = $this->setUserLanguage($acceptLanguage, $defaultLanguage);
        $this->languageArray = $languageArray;
        $this->languageDirectory = $languageDirectory;
    }

    function loadLanguageFile($languageFile)
    {
        if (file_exists($this->languageDirectory . $languageFile . '_' . $this->activeLanguage . '.json')) {
            return new LanguageContainer(json_decode(file_get_contents($this->languageDirectory . $languageFile . '_' . $this->activeLanguage . '.json'), true));
        } else {
            return new LanguageContainer(json_decode(file_get_contents($this->languageDirectory . $languageFile . '_' . $this->defaultLanguage . '.json'), true));
        }
    }

    function setUserLanguage($acceptLanguage, $defaultLanguage)
    {
        if (isset($acceptLanguage) && strlen($acceptLanguage) > 1) {
            # Split possible languages into array
            $x = explode(",", $acceptLanguage);
            foreach ($x as $val) {
                #check for q-value and create associative array. No q-value means 1 by rule
                if (preg_match("/(.*);q=([0-1]{0,1}\.\d{0,4})/i", $val, $matches))
                    $lang[$matches[1]] = (float)$matches[2];
                else
                    $lang[$val] = 1.0;
            }

            #return default language (highest q-value)
            $qval = 0.0;
            foreach ($lang as $key => $value) {
                if ($value > $qval) {
                    $qval = (float)$value;
                    $defaultLanguage = $key;
                }
            }
        }
        return strtolower($defaultLanguage);
    }


} 