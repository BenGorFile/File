<?php

/*
 * This file is part of the BenGorFile package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BenGorFile\File\Domain\Model;

use Ramsey\Uuid\Uuid;

/**
 * File name domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class FileName
{
    /**
     * The name.
     *
     * @var string
     */
    private $name;

    /**
     * Constructor.
     *
     * @param string|null $aName The name
     */
    public function __construct($aName = null)
    {
        $this->name = null === $aName ? Uuid::uuid4()->toString() : $this->sanitize($aName);
    }

    /**
     * Gets the name.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Method that checks if the name given is equal to the current.
     *
     * @param FileName $aName
     *
     * @return bool
     */
    public function equals(FileName $aName)
    {
        return $this->name() === $aName->name();
    }

    /**
     * Magic method that represents the file name in string format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name();
    }

    /**
     * Sanitizes the given file name.
     *
     * @param string $aName The file name
     *
     * @return string
     */
    private function sanitize($aName)
    {
        $characters = [
            // Latin
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
            'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
            'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O',
            'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 'Ø' => 'O',
            'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U',
            'Ũ' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 'ß' => 'ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
            'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
            'ï' => 'i', 'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
            'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 'ø' => 'o',
            'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u',
            'ũ' => 'u', 'ý' => 'y', 'þ' => 'th', 'ÿ' => 'y',
            // Croatian
            'Đ' => 'D', 'đ' => 'd',
            // Czech
            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R',
            'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 'Ž' => 'Z', 'č' => 'c',
            'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's',
            'ť' => 't', 'ů' => 'u', 'ž' => 'z',
            // Esperanto
            'Ĉ' => 'C', 'ĉ' => 'c', 'Ĝ' => 'G', 'ĝ' => 'g', 'Ĥ' => 'H',
            'ĥ' => 'h', 'Ĵ' => 'J', 'ĵ' => 'j', 'Ŝ' => 'S', 'ŝ' => 's',
            'Ŭ' => 'U', 'ŭ' => 'u',
            // Greek
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E',
            'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8', 'Ι' => 'I', 'Κ' => 'K',
            'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O',
            'Π' => 'P', 'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y',
            'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W', 'Ά' => 'A',
            'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H',
            'Ώ' => 'W', 'Ϊ' => 'I', 'Ϋ' => 'Y', 'α' => 'a', 'β' => 'b',
            'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h',
            'θ' => '8', 'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm',
            'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p', 'ρ' => 'r',
            'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x',
            'ψ' => 'ps', 'ω' => 'w', 'ά' => 'a', 'έ' => 'e', 'ί' => 'i',
            'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
            // Latvian
            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i',
            'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 'Š' => 'S', 'Ū' => 'u',
            'Ž' => 'Z', 'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g',
            'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n', 'Ŗ' => 'R',
            'ŗ' => 'r', 'š' => 's', 'ū' => 'u', 'ž' => 'z', 'Ō' => 'O',
            'ō' => 'o',
            // Lithuanian
            'Ė' => 'E', 'ė' => 'e', 'Ĩ' => 'I', 'ĩ' => 'i', 'Į' => 'I',
            'į' => 'i', 'Ų' => 'U', 'ų' => 'u',
            // Maltese
            'Ċ' => 'C', 'ċ' => 'c', 'Ġ' => 'G', 'ġ' => 'g', 'Ħ' => 'H',
            'ħ' => 'h',
            // Polish
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N',
            'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 'Ż' => 'Z', 'ą' => 'a',
            'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o',
            'ś' => 's', 'ź' => 'z', 'ż' => 'z',
            // Romanian
            'Ă' => 'A', 'ă' => 'a', 'ș' => 'S', 'ș' => 's', 'Ț' => 'T',
            'ț' => 't', 'Ţ' => 't', 'ţ' => 't',
            // Russian
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
            'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
            'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
            'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch',
            'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya', 'а' => 'a', 'б' => 'b',
            'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
            'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p',
            'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f',
            'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh',
            'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',
            // Sami
            'Ŋ' => 'N', 'ŋ' => 'n', 'Ŧ' => 'T', 'ŧ' => 't', 'Ǧ' => 'G',
            'ǧ' => 'g', 'Ǩ' => 'K', 'ǩ' => 'k', 'Ʒ' => 'Z', 'ʒ' => 'z',
            'Ǯ' => 'Z', 'ǯ' => 'z',
            // Slovak
            'Ľ' => 'L', 'ľ' => 'l', 'Ĺ' => 'L', 'ĺ' => 'l', 'Ŕ' => 'R',
            'ŕ' => 'r',
            // Turkish
            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O',
            'Ğ' => 'G', 'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u',
            'ö' => 'o', 'ğ' => 'g',
            // Ukrainian
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G', 'є' => 'ye',
            'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        ];

        $normalized = strtolower(strtr($aName, $characters));
        $cleaned = preg_replace($unwantedChars = '/([^a-z0-9]|-)+/', '-', $normalized);

        return trim($cleaned, '-');
    }
}
