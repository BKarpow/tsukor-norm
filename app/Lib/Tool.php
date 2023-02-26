<?

namespace App\Lib;

use Fresh\Transliteration\UkrainianToLatin;

class Tool
{
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
}
