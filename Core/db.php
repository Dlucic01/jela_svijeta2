<?php

namespace Core;

use PDO;
use PDOException;

//namespace DB
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

class Languages
{
    public static $value = [
        0 => "lang"
    ];
}
class CTI
{
    public static $value = [
        0 => "title",
        1 => "slug"
    ];
}

class Lang
{
    public static $fakerLang = [
        0 => "hr_HR",
        1 => "eng_US",
        2 => "fr_FR"
    ];
}



class Upload
{
    private $dbConnection;

    public function __construct(DBConnInterface $dbConnInterface)
    {
        $this->dbConnection = $dbConnInterface;
    }

    public static function slugMaker($slug)
    {
        $slug = str_replace(" ", "-", $slug);
        $slug = strtolower($slug);
        return $slug;
    }


    public function insert(array $params)
    {


        # echo ("<pre>" . print_r($params, true) . "</pre>");

        $pdo = $this->dbConnection->connect();

        $sql = "INSERT INTO " . $params["table"] . " (";


        // Create column names

        foreach ($params["column"] as $columns) {
            $sql .= $columns . ", ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= ") VALUES (";

        // Create sql column values
        foreach ($params["column"] as $bind_values) {
            $sql .= ":" . $bind_values . ", ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= ")";


        echo $sql . "\n\n\n";

        $stmt = $pdo->prepare($sql);
        // insert  CTIinto sql
        foreach ($params["column"] as $column_value) {

            // Upitnik - Potencijalno greška (ISP)
            if ($column_value == "slug") {
                $params["param"] = $params["slug"];
            }

            if ($column_value == "description") {
                $params["param"] = $params["description"];
            }
            if ($column_value == "category_id") {
                $params["param"] = $params["cti_id"];
            }
            if ($column_value == "tags_id") {
                $params["param"] = $params["cti_id"];
            }
            if ($column_value == "ingredients_id") {
                $params["param"] = $params["cti_id"];
            }



            $stmt->bindValue($column_value, $params["param"]);
        }
        $stmt->execute();
        $pdo = null;
    }
}
