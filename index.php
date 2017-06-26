<?php
/**
 * Created by PhpStorm.
 * User: kkeker
 * Date: 26.06.2017
 * Time: 10:42
 */

function getDictionary($lang) //В зависимости от переданного параметра языка, ищем в папке Languages нужный файл словаря.
{
    $LangFile = "dictionary.json"; //Указываем имя файла словаря.
    if (file_exists($LangFile)) { //Проверяем существует ли файл словаря.
        $jsonDictionary = json_decode(file_get_contents($LangFile), true); //Переводим JSON в PHP Array.
        return $jsonDictionary[$lang]; //Возвращаем только содержимое нужного словаря, а не все словари.
    }
}

function examplePrint($Lang) //Получаем параметр языка и выполняем действия.
{
    if (empty($Lang)) { //Проверка. Если параметр $lang не был передан в GET, то считаем языком по умолчанию английский.
        $setLang = 'en';
    } else { //Иначе, если параметр $lang был передан методом GET, то используем его и игнорируем значение по умолчанию.
        $setLang = $Lang;
    }
    $Hello = getDictionary($setLang)['hello']; //Читаем из словаря значение параметра Hello (не слова, параметра).
    //Построчный вывод результата, где $Hello зависит от $setLang и читается из соотвествующего файла словаря.
    $Example = "Приветствие на разных языках: \n";
    $Example .= "Вы установили системный язык в режим $setLang \n";
    $Example .= "Поэтому приветствие на выбранно языке будет звучать как - $Hello \n";
    print $Example;
}

//Простое условия проверки. Есть методом GET был передан параметр $lang (http://examole.com/App.php?lang=en), то используем его, если нет,
//то станавливаем данный параметрт равным null.
if (isset($_GET['lang'])){
    examplePrint($_GET['lang']);
}else{
    examplePrint(null);
}