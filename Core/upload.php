#!/usr/bin/env php
<?php

namespace Core;

require_once "db.php";

use Faker;


class ValidInput
{
    public static array $error;

    public static function validateValues(): bool
    {
        global $argc;
        global $argv;

        $validTables = [
            'meals',
            'tags',
            'ingredients',
            'category',
            'meals_category',
            'meals_tags',
            'meals_ingredients'
        ];

        $tableCount = count($validTables);

        $usageMsg = "\n\n Create new fake table: " . '\n"' .
            "php upload.php [meals][category][tags][ingredients]" . '"\n\n' .
            "Create new join: " . '\n"' .
            "php upload.php [meals_category][meals_tags][meals_ingredients] + [meal_id] + [C/T/I_id]\n\n";


        if ($argc == 1) {
            echo self::$error[] = "Usage: php upload.php |table_name|" . PHP_EOL;
            return false;
        }

        if ($argc <= 1) {
            echo self::$error[] = "ERROR!!! Too few arguments." . PHP_EOL;
            return false;
        }


        if ($argc >= 4) {
            echo self::$error[] = "ERROR!!! Too many arguments." . PHP_EOL;
            return false;
        }

        for ($i = 0; $i < $tableCount; $i++) {
            if (!in_array($argv[1], $validTables)) {
                echo self::$error[] = "ERROR!!! Table you provided does not exist";
                return false;
            }
        }

        if (empty(self::$error)) {
            return true;
        }
    }
}

class Upload
{
    private $dbConnection;

    public function __construct(DBConnInterface $dbConnInterface)
    {
        $this->dbConnection = $dbConnInterface;
    }


    /**
     *@method slugMaker creates a slug for Categories, Tags and Ingredients
     */


    public static function slugMaker($slug)
    {
        $slug = str_replace(" ", "-", $slug);
        $slug = strtolower($slug);
        return $slug;
    }





    /**
     *@method insert generates mysql statement and inserts values into database
     */

    public function insert(array $params)
    {



        $pdo = $this->dbConnection->connect();

        $sql = "INSERT INTO " . $params["table"] . " (";


        # Create column names

        foreach ($params["column"] as $columns) {
            $sql .= $columns . ", ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= ") VALUES (";

        # Create sql column values
        foreach ($params["column"] as $bind_values) {
            $sql .= ":" . $bind_values . ", ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= ")";


        echo $sql . "\n\n\n";

        $stmt = $pdo->prepare($sql);

        # insert  CTI into sql
        foreach ($params["column"] as $column_value) {


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


class CTIInsert
{
    protected $db;
    protected $upload;

    public function __construct(DBConnInterface $db, Upload $upload)
    {
        $this->db = $db;
        $this->upload = $upload;
    }



    /**
     *
     *@method inserts fake Category, Tags or Ingredients
     *
     */


    function insertCTI(array $params)
    {
        if (ValidInput::validateValues() == true) {
            $lang_counter = count(Lang::$fakerLang);
            $table_name = $params[1];

            for ($i = 0; $i < $lang_counter; $i++) {
                $fakerLang = Lang::$fakerLang[$i];
                $faker = Faker\Factory::create($fakerLang);

                //Generate Faker Titles
                if ($table_name == "category") {
                    $faker_category = $faker->streetName;
                }
                if ($table_name == "tags") {
                    $faker_category = $faker->company;
                }

                if ($table_name == "ingredients") {
                    $faker_category = $faker->name;
                }


                $faker_cat[] = $faker_category;


                # Generate Faker Slugs
                if ($i == 0) {
                    $slug = [
                        0 => Upload::slugMaker($faker_cat[0]),

                    ];
                }
            }




            for ($j = 0; $j < $lang_counter; $j++) {

                $this->upload->insert(array(
                    "table" => Table::$value[$table_name][$j],

                    "column" => CTI::$value,
                    "param" => $faker_cat[$j],
                    "slug" => $slug[0]
                ));
            }
        }
    }
}

class Meals
{
    protected $db;
    protected $upload;
    protected $select_category;

    public function __construct(DBConnInterface $db, Upload $upload)
    {
        $this->db = $db;
        $this->upload = $upload;
    }


    /**
     *@method insertMeals Inserts fake meals into database
     */

    function insertMeals()
    {
        if (ValidInput::validateValues() == true) {


            $lang_counter = count(Lang::$fakerLang);


            for ($i = 0; $i < $lang_counter; $i++) {
                $fakerLang = Lang::$fakerLang[$i];
                $faker = Faker\Factory::create($fakerLang);
                $meal_title = $faker->lastName;
                $meal_tit[] = $meal_title;
            }

            for ($j = 0; $j < $lang_counter; $j++) {
                $fakerLang = Lang::$fakerLang[$j];
                $faker = Faker\Factory::create($fakerLang);
                $meal_desc = $faker->country;
                $meal_des[] = $meal_desc;
            }



            $meal_values = [
                0 => $meal_tit,
                1 => $meal_des,
            ];

            for ($j = 0; $j < $lang_counter; $j++) {
                $this->upload->insert(array(

                    "table" => Table::$value["meals"][$j],
                    "column" => MealColumns::$value,
                    "param" => $meal_values[0][$j],
                    "description" => $meal_values[1][$j]
                ));
            }
        }
    }
}


class InsertJoin
{
    protected $dbConnInterface;
    protected $upload;

    public function __construct(DBConnInterface $dBConnInterface, Upload $upload)
    {
        $this->dbConnInterface = $dBConnInterface;
        $this->upload = $upload;
    }




    /**
     *@method insertValues Inputs join int values to database
     */

    public function insertValues(array $params)
    {
        $table = $params[2];
        $idValues = [
            0 => $params[3],
            1 => $params[4]
        ];

        $dbTable = Table::$value['joins'];
        $upload = $this->upload;

        switch ($table) {
            case "meals_category":
                $upload->insert([
                    "table" => $dbTable[0],

                    "column" => JoinColumns::$category,
                    "param" => $idValues[0],
                    "cti_id" => $idValues[1]

                ]);
                break;

            case "meals_tags":
                $upload->insert([
                    "table" => $dbTable[1],
                    "column" => JoinColumns::$tags,
                    "param" => $idValues[0],
                    "cti_id" => $idValues[1]


                ]);
                break;

            case "meals_ingredients":
                $upload->insert([
                    "table" => $dbTable[2],
                    "column" => JoinColumns::$ingredients,
                    "param" => $idValues[0],
                    "cti_id" => $idValues[1]
                ]);
                break;

            default:
                echo "Provide a valid table name" . PHP_EOL;
        }
    }
}



if (isset($argc)) {
    $sql_conn = new SQLConnection;
    $upload_v = new Upload($sql_conn);


    if ($argv[1] == "category") {
        $cti_v = new CTIInsert($sql_conn, $upload_v);
        $cti_v->insertCTI($argv);
    }
    if ($argv[1] == "tags") {
        $cti_v = new CTIInsert($sql_conn, $upload_v);
        $cti_v->insertCTI($argv);
    }
    if ($argv[1] == "ingredients") {
        $cti_v = new CTIInsert($sql_conn, $upload_v);
        $cti_v->insertCTI($argv);
    }
    if ($argv[1] == "meals") {
        $cti_v = new Meals($sql_conn, $upload_v);
        $cti_v->insertMeals();
    }
    if ($argv[1] == "join") {
        $cti_v = new InsertJoin($sql_conn, $upload_v);
        $cti_v->insertValues($argv);
    }
} else {
    echo "ERROR!!! Invalide number of arguments. Expected 1 argument named (category, tags, ingredients, meals)\n\n";
}
