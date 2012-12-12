<?php

/**
 * Возвращает форму слова в зависимости от колличества $count.
 * 
 * @param int $count <p>число элементов</p>
 * @param array $forms <p>Формы слова для количества 1, 2 и 5, пример {носок,носка,носков}</p>
 */
function GetWordForms($count,$forms)
{
    $cases = array (2, 0, 1, 1, 1, 2);
    return $forms[ ($number%100 >4 && $number%100< 20)? 2 : $cases[min($number%10, 5)] ];
};

?>
