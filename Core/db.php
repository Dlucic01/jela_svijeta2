<?php

namespace Core;

use PDO;
use PDOException;

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require '/srv/www/apache/vendor/autoload.php';

interface DBConnInterface
{
    public function connect();
}

class SQLConnection implements DBConnInterface
{
    protected $pdo;

    public function connect()
    {
        $dbc = 'mysql:host=localhost;$dbname=jela_svijeta;charset=UTF8';

        try {
            $pdo = new PDO($dbc, '', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


class Table
{

    /**
     *@var array $value Holds all tables for all languages
     *
     */


    public static $value = [
        "category" => ['jela_svijeta.category_hr', 'jela_svijeta.category_eng', 'jela_svijeta.category_fr'],
        "tags" => ['jela_svijeta.tags_hr', 'jela_svijeta.tags_eng', 'jela_svijeta.tags_fr'],
        "ingredients" => ['jela_svijeta.ingredients_hr', 'jela_svijeta.ingredients_eng', 'jela_svijeta.ingredients_fr'],
        "meals" => ['jela_svijeta.meals_hr', 'jela_svijeta.meals_eng', 'jela_svijeta.meals_fr'],
        "joins" => ['jela_svijeta.meals_category', 'jela_svijeta.meals_tags', 'jela_svijeta.meals_ingredients']
    ];
}




class MealColumns
{
    public static $value = [
        0 => "title",
        1 => "description",
    ];
}


class JoinColumns
{
    public static $category = [
        0 => "meals_id",
        1 => "category_id",
    ];

    public static $tags = [
        0 => "meals_id",
        1 => "tags_id",
    ];

    public static $ingredients = [
        0 => "meals_id",
        1 => "ingredients_id",
    ];
}


class CTI
{

    /**
     *@var array $value Holds all columns for Categories, Tags, Ingredients
     *
     */



    public static $value = [
        0 => "title",
        1 => "slug"
    ];
}

class Languages
{
    public static $value = [
        0 => "hr",
        1 => "eng",
        3 => "fr"
    ];
}


class Lang
{


    /**
     *@var array $fakerLang Holds all currently supported languages
     */

    public static $fakerLang = [
        0 => "hr_HR",
        1 => "eng_US",
        2 => "fr_FR"
    ];
}
