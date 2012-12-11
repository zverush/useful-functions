/**
 * Translate text online with google translate
 * @author http://habrahabr.ru/qa/4243/#answer_19084
 */
function translate($text) {
    $text = urlencode(win_utf8($text));
    $domain = "ajax.googleapis.com";
    $result='';
    $fp = fsockopen($domain, 80, $errno, $errstr);
    if (!$fp) {
        return exit("Ошибка соединения с сервером переводчика");
    } else {
        fputs($fp, "GET /ajax/services/language/translate?v=1.0&q=".$text."&langpair=ru%7Cen&callback=foo&context=bar  HTTP/1.0\r\n");
        fputs($fp, "Host: $domain\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        while (!feof($fp)) {
            $result.=fgets($fp, 1000);
        }
        fclose($fp);
    }
    
    preg_match('|"translatedText":"(.*?)"|is', $result, $locale);
    return $locale[1];
}