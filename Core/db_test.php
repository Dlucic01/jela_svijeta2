<?php
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
        $dbc = 'mysql:host=localhost;$dbname=jela_svijeta;charset=UTF8';

        try {
            $pdo = new PDO($dbc, 'exof', 'Mumija12');
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


    // Slug Maker
    public static function slugMaker($slug)
    {
        $slug = str_replace(" ", "-", $slug);
        $slug = strtolower($slug);
        return $slug;
    }

    // Insert
    public function insert(array $params)
    {

        // Sql query
        echo ("<pre>" . print_r($params, true) . "</pre>");
        $pdo = $this->dbConnection->connect();
        $sql = "INSERT INTO " . $params["table"] . " (title, slug) VALUES (:title, :slug)";
        $stmt = $pdo->prepare($sql);

        // insert into sql

        foreach ($params["column"] as $column_value) {

            // Upitnik - Potencijalno greška (ISP)
            if ($column_value == "slug") {
                $params["param"] = $params["slug"];  #self::slugMaker($params["param"]);
            }


            $stmt->bindValue($column_value, $params["param"]);
        }
        $stmt->execute();
        $pdo = null;
    }
}




function generateFaker()
{
    $db = new SQLConnection;
    $user = new Upload($db);
    // Faker Titles
    $faker_cat = [];
    $faker_tag = [];
    $faker_ing = [];

    // Title Slugs

    for ($k = 0; $k <= 2; $k++) {

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
        echo "<h2>!!!</h2>";
        echo ("<pre>" . print_r($faker_val, true) . "</pre>");
        echo "<h2>!!!</h2>";
    }
    for ($i = 0; $i <= 2; $i++) {
        for ($j = 0; $j <= 2; $j++) {
            #            echo $faker_val[$i][$j] . "<br>";


            $user->insert(array(
                "table" => Table::$value[$i][$j],

                "column" => CTI::$value,
                "param" => $faker_val[$i][$j],
                "slug" => $slug[$i]
            ));
        }
    }
    echo "<h1>Faker cat</h1>";
    echo ("<pre>" . print_r($faker_cat, true) . "</pre>");
    echo "<h1>Faker tag</h1>";
    echo ("<pre>" . print_r($faker_tag, true) . "</pre>");
    echo "<h1>Faker ing</h1>";
    echo ("<pre>" . print_r($faker_ing, true) . "</pre>");
    echo "<h1>Slug</h1>";
    echo ("<pre>" . print_r($slug, true) . "</pre>");
    echo "<h1>Param</h1>";
    echo ("<pre>" . print_r($faker_val, true) . "</pre>");
}
generateFaker();



/*
$db = new SQLConnection;

/*
for ($loop = 0; $loop <= 2; $loop++) {
    $faker_lang = Lang::$faker_lang[$loop];
    $faker = Faker\Factory::create($faker_lang);


    // Faker Value type

    $faker_values = [
        0 => $faker_category = $faker->streetName,
        1 => $faker_tags = $faker->company,
        2 => $faker_ingredients = $faker->name
    ];

    if ($loop == 0) {


        // Create Slugs
        $slug = [
            0 => $slug_category =  Upload::slugMaker($faker_values[0]),
            1 => $slug_ingredients =  Upload::slugMaker($faker_values[1]),
            2 => $slug_tags =  Upload::slugMaker($faker_values[2])
        ];

        $param = [
            0 => $faker_v_category = $faker_values[0],
            1 => $faker_v_category = $faker_values[1],
            2 => $faker_v_category = $faker_values[2]
        ];
    }

for ($db_loop = 0; $db_loop <= 2; $db_loop++) {

    $user = new Upload($db);
    $user->insert(array(
        "table" => Table::$value[$loop][$db_loop],
        "column" => CTI::$value,
        "param" => $faker_values[$loop],
        "slug" => $slug[$loop]
    ));
}
*/
