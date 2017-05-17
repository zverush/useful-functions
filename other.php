<?php

/**
 * Возвращает форму слова в зависимости от колличества $number.
 *
 * @param int $number <p>число элементов</p>
 * @param array $forms <p>Формы слова для количества 1, 2 и 5, пример {носок,носка,носков}</p>
 * @return string
 */
function get_word_form( $number,$forms ) {
    $cases = array (2, 0, 1, 1, 1, 2);
    return $forms[ ($number%100 >4 && $number%100< 20)? 2 : $cases[min($number%10, 5)] ];
}
