<?php

namespace Core;

use Faker;
use PDO;
use PDOException;
use PDOStatement;

//namespace DB
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

interface DBConnInterface
{
    public function connect();
}

class SQLConnection implements DBConnInterface
{
    protected $pdo;

    public function connect()
    {
        $dbc = 'mysql:host=localhost;$dbname=;charset=UTF8';

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
        0 => ['jela_svijeta.category', 'jela_svijeta.category_eng', 'jela_svijeta.category_fr'],
        1 => ['jela_svijeta.tags', 'jela_svijeta.tags_eng', 'jela_svijeta.tags_fr'],
        2 => ['jela_svijeta.ingredients', 'jela_svijeta.ingredients_eng', 'jela_svijeta.ingredients_fr'],
        3 => ['jela_svijeta.meals', 'jela_svijeta.meals_eng', 'jela_svijeta.meals_fr']
    ];
}




class MealColumns
{
    public static $value = [
        0 => "title",
        1 => "description",
        2 => "category",
        3 => "ingredients",
        4 => "tags"
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
    public static $faker_lang = [
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


        echo $sql;

        $stmt = $pdo->prepare($sql);
        // insert  CTIinto sql
        foreach ($params["column"] as $column_value) {

            // Upitnik - Potencijalno greška (ISP)
            if ($column_value == "slug") {
                $params["param"] = $params["slug"];
            }

            // Upitnik - Potencijalno greška (ISP)
            # if ($column_value == "title") { //   && $column_count > 3
            #     $params["param"] = $params["title"];  #:welf::slugMaker($params["param"]);
            # }


            if ($column_value == "description") {
                $params["param"] = $params["description"];  #self::slugMaker($params["param"]);
            }
            if ($column_value == "category") {
                $params["param"] = $params["category"];  #self::slugMaker($params["param"]);
            }
            if ($column_value == "ingredients") {
                $params["param"] = $params["ingredients"];  #self::slugMaker($params["param"]);
            }
            if ($column_value == "tags") {
                $params["param"] = $params["tags"];  #self::slugMaker($params["param"]);
            }


            $stmt->bindValue($column_value, $params["param"]);
        }
        $stmt->execute();
        $pdo = null;



        #            if ($column_value == "slug") {
        #                $params["param"] = self::slugMaker($params["param"]);
        #            }
        #
    }


    /*public function insertM(array $params)
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


        echo $sql;

        $stmt = $pdo->prepare($sql);

        foreach ($params["column"] as $column_value) {

            // Upitnik - Potencijalno greška (ISP)
            if ($column_value == "title") {
                $params["param"] = $params["title"];  #self::slugMaker($params["param"]);
            }
            if ($column_value == "description") {
                $params["param"] = $params["description"];  #self::slugMaker($params["param"]);
            }
            if ($column_value == "category") {
                $params["param"] = $params["category"];  #self::slugMaker($params["param"]);
            }
            if ($column_value == "ingredients") {
                $params["param"] = $params["ingredients"];  #self::slugMaker($params["param"]);
            }
            if ($column_value == "tags") {
                $params["param"] = $params["tags"];  #self::slugMaker($params["param"]);
            }


            $stmt->bindValue($column_value, $params["param"]);
        }



        $stmt->execute();
        $pdo = null;



        #            if ($column_value == "slug") {
        #                $params["param"] = self::slugMaker($params["param"]);
        #            }
        #
    }
    */
}



/*
$lang_counter = count(Lang::$faker_lang);
echo $lang_counter;



$db = new SQLConnection;
$user = new Upload($db);

for ($k = 0; $k < $lang_counter; $k++) {
    $faker_lang = Lang::$faker_lang[$k];
    $faker = Faker\Factory::create($faker_lang);

    //Generate Faker Titles
    $faker_category = $faker->streetName;
    $faker_tags = $faker->company;
    $faker_ingredients = $faker->name;

    $faker_cat[] = $faker_category;
    $faker_tag[] = $faker_tags;
    $faker_ing[] = $faker_ingredients;

    $faker_val = [
        0 => $faker_cat,
        1 => $faker_tag,
        2 => $faker_ing
    ];


    // Generate Faker Slugs
    if ($k == 0) {
        $slug = [
            0 => Upload::slugMaker($faker_cat[0]),
            1 => Upload::slugMaker($faker_tag[0]),
            2 => Upload::slugMaker($faker_ing[0])

        ];
    }
}

# $faker = Faker\Factory::create($faker_lang[$k]);
for ($i = 0; $i < $lang_counter; $i++) {
    for ($j = 0; $j < $lang_counter; $j++) {

        $user->insert(array(
            "table" => Table::$value[$i][$j],

            "column" => CTI::$value,
            "param" => $faker_val[$i][$j],
            "slug" => $slug[$i]
        ));
    }
}
////////////////////////////////////////////

/*
$faker_meal = $faker->company;
$faker_meal_desc = $faker->paragraph(3, true);


$meal_values = [
    "title" => $faker_meal,
    "description" => $faker_meal_desc,
    "category" => $slug[0],
    "ingredients" => $slug[1],
    "tags" => $slug[2]
];


echo ("<pre>" . print_r($meal_values, true) . "</pre>");
*/
