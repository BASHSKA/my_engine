<?php
/**
 * Created by PhpStorm.
 * User: bashska
 * Date: 20.08.18
 * Time: 19:26
 */

/**
 *
 * @class EcngineClass = main class for work
 *
 **/

$vars = [
    '$USER_NAME$'=>'Войти',
    '$USER_CHANGE$'=>'Зарегестрироваться'
];

class EngineClass
{
    /**
     *
     * @function initTpl() = returns templates directory;
     *
     * @function initPage($object) = returns page for render WHERE $object = page name;
     *
     * @function renderPage() = returns rendered page;
     *
     *
     *
     **/

    public static function initTpl()
    {
        return array_slice(scandir('/var/www/bash.inc/templates/'), 2);
    }

    public static function initPage($object)
    {
        return file_get_contents('/var/www/bash.inc/pages/' . $object, true);
    }


    public static function renderPage($tpl, $object)
    {

        $search = null;
        $file = null;

        foreach ($tpl as $value) {

            $file = file_get_contents('/var/www/bash.inc/templates/' . $value);
            $search = '{{' . substr($value, 0, -4) . '}}';
            $object = str_replace($search, $file, $object);

        }

        return $object;

    }
/**
 *
 * @function sqlQuery($query)  = returns matrix ($array[0][x]), $query - SQL query in '';
 *
 **/
    public static function sqlQuery($query)
    {

        $mysqli = mysqli_connect('localhost', 'phpmyadmin', 'Gukiru55', 'bash.inc') or die();

        $result = mysqli_query($mysqli, "SET NAMES 'utf8'");

        $result = mysqli_query($mysqli, $query);

        $result = mysqli_fetch_all($result);

        mysqli_close($mysqli);

        return $result;

    }

    /**
     *
     * @function signUp - user registration (auto)
     *
     **/

    public static function signUp($name, $email, $pass)
    {
        $result = self::sqlQuery('SELECT * FROM `users` WHERE Email = "' . $email . '" ');

        $result2 = self::sqlQuery('SELECT * FROM `users` WHERE Name = "' . $name . '" ');

        if (empty($result) && empty($result2)) {
            self::sqlQuery('INSERT INTO `users` (Name, Pass, Email) VALUE ("'. $name .'", "'. $pass .'", "'. $email .'")');
            return 'Вы успешно зарегестрированы!';
        } else {
            return 'Пользователь с таким именем и/или Email уже существует';
        }

    }

    /**
     *
     * @function getAllShortNews - render all news (auto)
     *
     **/

    public static function getAllShortNews()
    {

        $query = self::sqlQuery('SELECT * FROM `content`');

        $fullcontent = null;

        $search = ['$idx$', '$short$', '$img$', '$category$', '$full$'];

        foreach ($query as $insertArray) {

            $content = file_get_contents('/var/www/bash.inc/templates/shortnew.tpl', true);

            $content = str_replace($search, $insertArray, $content);

            $fullcontent .= $content;
        }

        return $fullcontent;


    }


}

/**
 *
 * @function render($object) = returns rendered page;
 * This function need for init in *.php files
 *
 * @variable $object = page for render
 *
 **/


function render($object, $vars)
{

    $subject = new EngineClass();

    $tpl = $subject::initTpl();

    $page = $subject::initPage($object);

    $renderPage = $subject::renderPage($tpl, $page);

    $news = $subject::getAllShortNews();

    $renderPage = str_replace('$ALL_NEWS$', $news, $renderPage);

    foreach ($vars as $key => $value) {
        $renderPage = str_replace($key, $value, $renderPage);
    }

    return $renderPage;

}
/**
 *
 * @function signUp - user registration;
 *
 **/
function signUp($name, $email, $pass)
{
    $subject = new EngineClass();

    return $subject::signUp($name, $email, $pass);
}