<?php

namespace App\Model;


require_once '../../Core/db.php';

use Core\SQLConnection;
use Core\DBConnInterface;
use PDO;
use App\Controller\ValidUrl;

class Model
{
    protected $dbConnInterface;

    public function __construct(DBConnInterface $dbConnInterface)
    {
        $this->dbConnInterface = $dbConnInterface;
    }

    public function returnMeals(array $params)
    {


        $sql = "SELECT * FROM " . $params["table"];

        #echo $sql;
        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
        echo json_encode($row, JSON_PRETTY_PRINT);
    }


    public function returnCTI(array $params)
    {



        $sql = "SELECT " . $params["cti"] . "_" . $params["lang"] . ".id, " . $params["cti"] . "_" . $params["lang"] . ".title, " . $params["cti"] . "_" . $params["lang"] . ".slug
FROM ((" .  $params["table"] . " INNER JOIN jela_svijeta.meals_" . $params["cti"] . " ON meals_" . $params["lang"] . ".id = meals_" . $params["cti"] . ".meals_id)
INNER JOIN jela_svijeta." . $params["cti"] . "_" . $params["lang"] . "
ON meals_" . $params["cti"] . "." . $params["cti"] . "_id = " . $params["cti"] . "_" . $params["lang"] . ".id)
WHERE " . $params["cti"] . "_" . $params["lang"] . ".id = " . $params['id'];

        # echo $sql;
        #" WHERE ID=1";
        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
        echo json_encode($row, JSON_PRETTY_PRINT);
    }



    public function returnCMeals(array $params)
    {


        $table = $params['table'];
        $cti = $params['cti'];
        $lang = $params["lang"];
        $id = $params["id"];
        //Replace string category -> $params["cti"];

        # $sql = "SELECT " .  $mealsTable . ".id, " . $mealsTable . ".title, " . $mealsTable . ".description, " . $mealsTable . ".status, " . $categoryTable . ".title AS categoryTitle "
        #     . " FROM " . $mealsTable . "
        #         INNER JOIN jela_svijeta.meals_category
        #         ON " . $mealsTable . ".id" . " = jela_svijeta.meals_category.meals_id "
        # . "INNER JOIN " . $categoryTable . "
        #     ON " . $categoryTable . ".id = jela_svijeta.meals_category.category_id
        #     WHERE jela_svijeta.meals_category.category_id " .   $id;


        #        $sql = "SELECT  meals_" . $params["lang"] . ".id,  meals_" . $params["lang"] . ".title,  meals_" . $params["lang"] . ".description,  meals_" . $params["lang"] . ".status, . " . $params['cti'] . "_" . $params['lang'] . ".title AS categoryTitle
        #FROM " .  $params["table"] . " INNER JOIN jela_svijeta.meals_" . $params["cti"] . " ON meals_" . $params["lang"] . ".id = jela_svijeta,meals_" . $params["cti"] . ".meals_id
        #INNER JOIN jela_svijeta." . $params['cti'] . "_" . $params['lang'] . " ON " . $params['cti'] . "_" . $params['lang'] . ".id = jela_svijeta.meals_category.category_id WHERE jela_svijeta.meals_category.category_id " . $params['id'];

        $sql = "SELECT " . $table . ".id, " . $table . ".title, " .  $table . ".description," .  $table . ".status
FROM " .  $table . "
INNER JOIN jela_svijeta.meals_" . $cti . "
ON meals_" . $lang . ".id = meals_" . $cti . ".meals_id
 WHERE jela_svijeta.meals_category.category_id " . $id;


        # echo $sql;
        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }


    public function returnCMealsNull(array $params)
    {
        $lang = $params["lang"];

        $sql = "SELECT meals_" . $lang . ".* " .
            "FROM  jela_svijeta.meals_" . $lang .
            " INNER JOIN jela_svijeta.meals_category ON  jela_svijeta.meals_category.meals_id = meals_" . $lang . ".id" .
            " WHERE  jela_svijeta.meals_category.category_id IS NULL";


        # echo $sql;
        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }




    public function returnTMeals(array $params)
    {

        $lang = $params["lang"];
        $id = $_GET['tags'];
        $idCount = preg_match_all('!\d+!', $id);

        //Replace string category -> $params["cti"];


        $sql = "SELECT meals_" . $lang . ".id, meals_" . $lang . ".title, meals_" . $lang . ".description
FROM jela_svijeta.meals_" . $lang . "
INNER JOIN jela_svijeta.meals_tags
ON jela_svijeta.meals_" . $lang . ".id = jela_svijeta.meals_tags.meals_id
WHERE meals_tags.tags_id IN (" . $id . ")
GROUP BY meals_" . $lang . ".id, meals_" . $lang . ".title, jela_svijeta.meals_" . $lang . ".description
HAVING COUNT(meals_tags.meals_id) =" . $idCount; // . "+1";

        #echo $sql;
        #" WHERE ID=1";
        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
        #echo json_encode($row, JSON_PRETTY_PRINT);
    }





    //Return all meals with requested tags
    public function selectTags(array $params)
    {
        $lang = $params["lang"];

        $cti  = $params["cti"];



        $sql = "SELECT  tags_" . $lang . ".id,  tags_" . $lang . ".title,  tags_" . $lang . ".slug
FROM ((" .  $params["table"] . " INNER JOIN jela_svijeta.meals_" . $cti . " ON meals_" . $lang . ".id = meals_" . $cti . ".meals_id)
INNER JOIN jela_svijeta." . $cti . "_" . $lang . "
ON meals_" . $cti . "." . $cti . "_id = " . $cti . "_" . $lang . ".id)
WHERE tags_" . $lang . ".id = " . $params['id']; // . "+1";



        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }








    public function selectCategoryTags(array $params)
    {
        $lang = $params["lang"];


        $categoryID = $params['categoryID'];

        $tagsID = $_GET['tags'];
        $tagsIDCount = preg_match_all('!\d+!', $tagsID);

        $sql = "SELECT meals_" . $lang . ".id, meals_" . $lang . ".title, meals_" . $lang . ".description, meals_" . $lang . ".status" .
            " FROM jela_svijeta.meals_" . $lang . " " .
            "INNER JOIN jela_svijeta.meals_category " .
            "ON jela_svijeta.meals_" . $lang . ".id = meals_category.meals_id " .
            "INNER JOIN jela_svijeta.meals_tags " .
            "ON jela_svijeta.meals_" . $lang . ".id = meals_tags.meals_id " .
            "WHERE jela_svijeta.meals_category.category_id " . $categoryID . " " .
            "AND meals_tags.tags_id IN (" . $tagsID . ")" .
            "GROUP BY meals_" . $lang . ".id, meals_" . $lang . ".title, meals_" . $lang . ".description, meals_" . $lang . ".status " .
            "HAVING COUNT(meals_tags.meals_id) = " . $tagsIDCount;

        echo $sql;

        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }








    public function selectWith(array $params)
    {
        $lang = $params['lang'];
        $valueCTI = $params['cti'];
        $tableCTI = $valueCTI . "_" . $lang;

        $mealsTable = $params['table'];
        $tableCTI = $valueCTI . "_" . $lang; //returns i.e ingredients_fr


        $sql = "SELECT " . $tableCTI . ".id, " . $tableCTI . ".title, " . $tableCTI . ".slug " .
            "FROM " . $mealsTable . " " .
            "INNER JOIN jela_svijeta.meals_" . $valueCTI . " " .
            "ON " . $mealsTable . ".id = meals_" . $valueCTI . "." . "meals_id " .
            "INNER JOIN jela_svijeta." . $tableCTI . " " .
            "ON jela_svijeta.meals_" . $valueCTI . "." . $valueCTI . "_id = " . $tableCTI . ".id " .
            "WHERE " . $mealsTable . ".id = " . $params['id'];

        #echo $sql;

        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

























    public function returnCategoryTest(array $params)
    {
        //Replace string category -> $params["cti"];
        $sql = "SELECT " . $params["cti"] . "_" . $params["lang"] . ".id, " . $params["cti"] . "_" . $params["lang"] . ".title, " . $params["cti"] . "_" . $params["lang"] . ".slug
FROM ((" .  $params["table"] . " INNER JOIN jela_svijeta.meals_" . $params["cti"] . " ON meals_" . $params["lang"] . ".id = meals_" . $params["cti"] . ".meals_id)
INNER JOIN jela_svijeta." . $params["cti"] . "_" . $params["lang"] . "
ON meals_" . $params["cti"] . "." . $params["cti"] . "_id = " . $params["cti"] . "_" . $params["lang"] . ".id)
WHERE category_" . $params["lang"] . ".id = " . $params['id']; // !!! +1 is here because there is and offset by one in GET WITH PARAMS !!!


        #  echo $sql;
        #" WHERE ID=1";
        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
        echo json_encode($row, JSON_PRETTY_PRINT);
    }



    public function returnCategoryMealsTest(array $params)
    {
        //Replace string category -> $params["cti"];
        $sql = "SELECT  meals_" . $params["lang"] . ".id,  meals_" . $params["lang"] . ".title,  meals_" . $params["lang"] . ".description,  meals_" . $params["lang"] . ".status
FROM ((" .  $params["table"] . " INNER JOIN jela_svijeta.meals_" . $params["cti"] . " ON meals_" . $params["lang"] . ".id = meals_" . $params["cti"] . ".meals_id)
INNER JOIN jela_svijeta." . $params["cti"] . "_" . $params["lang"] . "
ON meals_" . $params["cti"] . "." . $params["cti"] . "_id = " . $params["cti"] . "_" . $params["lang"] . ".id)
 WHERE " . $params["cti"] . "_" . $params["lang"] . ".id = " . $params['id']; // !!! +1 is here because there is and offset by one in GET WITH PARAMS !!!

        #echo $sql;
        #" WHERE ID=1";
        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
        echo json_encode($row, JSON_PRETTY_PRINT);
    }



    public function returnTagsMeals(array $params)
    {
        //Replace string category -> $params["cti"];
        $sql = "SELECT  meals_" . $params["lang"] . ".id,  meals_" . $params["lang"] . ".title,  meals_" . $params["lang"] . ".description,  meals_" . $params["lang"] . ".status
FROM ((" .  $params["table"] . " INNER JOIN jela_svijeta.meals_" . $params["cti"] . " ON meals_" . $params["lang"] . ".id = meals_" . $params["cti"] . ".meals_id)
INNER JOIN jela_svijeta." . $params["cti"] . "_" . $params["lang"] . "
ON meals_" . $params["cti"] . "." . $params["cti"] . "_id = " . $params["cti"] . "_" . $params["lang"] . ".id)
 WHERE " . $params["cti"] . "_" . $params["lang"] . ".id = " . $params['id'] . " && " . $params["cti"] . "_" . $params["lang"] . ".id = " . $params['idt']; // !!! +1 is here because there is and offset by one in GET WITH PARAMS !!!

        #echo $sql;
        #" WHERE ID=1";
        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
        echo json_encode($row, JSON_PRETTY_PRINT);
    }



    public function mealsRowCount()
    {
        $sql = "SELECT title FROM jela_svijeta.meals_hr";

        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $row = $stmt->rowCount();
        return $row;
    }
}
