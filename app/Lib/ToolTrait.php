<?php

namespace App\Lib;

use Fresh\Transliteration\UkrainianToLatin;

trait ToolTrait {

    /**
     * Метод для транслітерації українських текстів.
     * @param string $textUkr
     * @return string $textLatin
     */
    public static function trns(string $textUkr): string
    {
        return UkrainianToLatin::transliterate($textUkr);
    }

    /**
     * Метод для транслітерації українських текстів для посилань.
     * @param string $textUkr
     * @return string $textLatin
     */
    public static function trnsSlug(string $textUkr): string
    {
        $textLatin = UkrainianToLatin::transliterate($textUkr);
        $textLatin = trim($textLatin);
        $textLatin = preg_replace("#\s+#si", "_", $textLatin);
        // $textLatin = preg_replace("#[^\w\d\_]+#si", "", $textLatin);
        $textLatin = preg_replace("#[^\w\d\_]+#si", "", $textLatin);
        return $textLatin;
    }

    /**
     * Метод перетворює рядок із не цілим числовим
     * коректне значення для запису в бд.
     * @param string  $floatString - вхідний рядок із нецілим числом.
     * @param int  $round - округлення, за замовчування 2-ві цифри після коми.
     * @return float - неціле число
     */
    public function getCorrectFloatFromString(string $floatString, int $round = 2): float
    {
        $floatString = preg_replace('#[\,]#si', '.', $floatString);
        $floatString = preg_replace('#[^\d\.]#si', '', $floatString);
        $floatString = (float)$floatString;
        return round($floatString, $round);
    }

    /**
     * Метод для перевірки дати яка передаєтся аргументо, перевіряє чи дата
     * не більше ніж поточна, перевірка по днях!
     * @param string $dateString - рядок дати коректни для функції strtotime()
     * @return bool
     */
    public function isPastDate(string $dateString):bool
    {
        $a = (int)date('Ymd');
        $b = (int)date('Ymd', strtotime($dateString));
        return $b > $a;
    }
}
