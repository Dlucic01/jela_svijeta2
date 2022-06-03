<?php
/*
namespace Core;

require_once "db.php";

use PDO;

class SelectCategory
{

    protected $dbConnInterface;

    public function __construct(DBConnInterface $dBConnInterface)
    {
        $this->dbConnInterface = $dBConnInterface;
    }

    public function selectCategory(): string
    {
        $random = rand(0, 2);

        if ($random > 0) {
            $category_id = rand(1, 6);
            $sql = "SELECT id FROM jela_svijeta.category WHERE `id`=" . $category_id;
            $pdo = $this->dbConnInterface->connect();
            $stmt = $pdo->prepare($sql);
            #echo $sql;

            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $category = $row[0]["id"];
            # echo $row[0]["id"];
            //   echo json_encode($row, json_pretty_print);
            echo ("<pre>" . print_r($category, true) . "</pre>");
            echo $category;
            return $category;
        } else {
            echo "null";
            $category = "null";
            return $category;
        }
    }
}


class SelectMeals
{
    protected $dbConnInterface;

    public function __construct(DBConnInterface $dBConnInterface)
    {
        $this->dbConnInterface = $dBConnInterface;
    }
    public function selectMeals()
    {

        $meals_id = rand(1, 10);
        $sql = "SELECT * FROM jela_svijeta.meals WHERE `id`=" . $meals_id;
        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);

        #echo $sql;

        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $row[0]["id"];

        // echo json_encode($row, JSON_PRETTY_PRINT);
    }
}


$db = new SQLConnection;
$select = new SelectCategory($db);
$select->selectCategory();
echo ("<pre>" . print_r($select, true) . "</pre>");

$select_meal = new SelectMeals($db);
$select_meal->selectMeals();






















class SelectTags
{
    protected $dbConnInterface;

    public function __construct(DBConnInterface $dBConnInterface)
    {
        $this->dbConnInterface = $dBConnInterface;
    }
    public function selectTags(array $params)
    {
        $random = rand(1, 3);

        for ($i = 0; $i < $random; $i++) {
            $category_id = rand(1, 6);
            $table = $params[1];
            $sql = "SELECT * FROM jela_svijeta." . $table . " WHERE `id`=" . $category_id;
            $pdo = $this->dbConnInterface->connect();
            $stmt = $pdo->prepare($sql);

            #echo $sql;

            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            # echo json_encode($row, JSON_PRETTY_PRINT);
        }
    }
}
