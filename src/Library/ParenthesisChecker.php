<?php

namespace Library;

class ParenthesisChecker
{
    /**
     * Символы, разрешенные для использования
     * во входящей строке
     */
    const ALLOWED_SYMBOLS = [
        ")", "(", " ", "\n", "\t", "\r"
    ];

    /**
     * Проверка корректности круглых скобок в строке
     *
     * @param $string
     * @return bool
     */
    public function check($string)
    {
        if (!$this->isValid($string)) {
            throw new \InvalidArgumentException(
                "Присутствуют символы иные, чем " . join(",", self::ALLOWED_SYMBOLS)
            );
        }


        $stack = [];
        for ($i = 0; $i < mb_strlen($string); $i++) {
            $symbol = mb_substr($string, $i, 1);
            if ($symbol == '(') {
                array_push($stack, '(');
            } elseif ($symbol == ')') {
                $popSymbol = array_pop($stack);
                if ($popSymbol != '(') {
                    return false;
                }
            }
        }

        return count($stack) == 0;
    }

    /**
     * Является ли строка валидной для дальнейшей
     * обработки
     *
     * @param $string
     * @return bool
     */
    public function isValid($string)
    {
        return (boolean)preg_match("/^[" . join(self::ALLOWED_SYMBOLS) . "]+$/", $string);
    }
}