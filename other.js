// Возвращает форму слова в зависимости от колличества $number.
// Пример: declOfNum(5, ['секунда', 'секунды', 'секунд']) 

function declOfNum(number, titles)
{  
    cases = [2, 0, 1, 1, 1, 2];  
    return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
}  
