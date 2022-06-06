<?php

namespace App\Model;


require_once '../../Core/db.php';

use App\Controller\ValidUrl;
use Core\DBConnInterface;
use PDO;


class MetaData
{

    public static function getPerPage()
    {
        if (isset($_GET['per_page'])) {
            $perPage = ValidUrl::validate($_GET['per_page']);
            return $perPage;
        }
    }

    public static function showRows()
    {
        if (isset($_GET['page'])) {
            $page = ValidUrl::validate($_GET['page']);
            $firstPage = ($page - 1) * self::getPerPage();

            return $firstPage;
        }
        return $firstPage = 0;
    }
}

class Model
{
    protected $dbConnInterface;

    public function __construct(DBConnInterface $dbConnInterface)
    {
        $this->dbConnInterface = $dbConnInterface;
    }




    /**
     *@method returnMeals returns all meals except when per_page is set
     */

    public function returnMeals(array $params)
    {


        $sql = "SELECT * FROM " . $params["table"];

        if (isset($_GET['per_page'])) {
            $sql .= " LIMIT " . MetaData::showRows() . "," . MetaData::getPerPage();
        }


        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
        echo json_encode($row, JSON_PRETTY_PRINT);
    }




    public function returnCMeals(array $params)
    {

        # Returns Meals with a category passed as a parameter


        $table = $params['table'];
        $cti = $params['cti'];
        $lang = $params["lang"];
        $id = $params["id"];


        $sql = "SELECT " . $table . ".id, " . $table . ".title, " .  $table . ".description," .  $table . ".status
FROM " .  $table . "
INNER JOIN jela_svijeta.meals_" . $cti . "
ON meals_" . $lang . ".id = meals_" . $cti . ".meals_id
 WHERE jela_svijeta.meals_category.category_id " . $id;

        if (isset($_GET['per_page'])) {
            $sql .= " LIMIT " . MetaData::showRows() . "," . MetaData::getPerPage();
        }


        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }


    /**
     *@method returnCMealsNull returns all meals with category NULL
     **/

    public function returnCMealsNull(array $params)
    {
        $lang = $params["lang"];

        $sql = "SELECT meals_" . $lang . ".*
            FROM  jela_svijeta.meals_" . $lang .
            " INNER JOIN jela_svijeta.meals_category ON jela_svijeta.meals_category.meals_id = meals_" . $lang . ".id
             WHERE  jela_svijeta.meals_category.category_id IS NULL";

        if (isset($_GET['per_page'])) {
            $sql .= " LIMIT " . MetaData::showRows() . "," . MetaData::getPerPage();
        }


        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }




    /**
     *@method returnTMeals returns all meals with int $params['tags']
     **/


    public function returnTMeals(array $params)
    {

        $lang = $params["lang"];
        $id = $_GET['tags'];
        $idCount = preg_match_all('!\d+!', $id);



        $sql = "SELECT meals_" . $lang . ".id, meals_" . $lang . ".title, meals_" . $lang . ".description
FROM jela_svijeta.meals_" . $lang . "
INNER JOIN jela_svijeta.meals_tags
ON jela_svijeta.meals_" . $lang . ".id = jela_svijeta.meals_tags.meals_id
WHERE meals_tags.tags_id IN (" . $id . ")
GROUP BY meals_" . $lang . ".id, meals_" . $lang . ".title, jela_svijeta.meals_" . $lang . ".description
HAVING COUNT(meals_tags.meals_id) =" . $idCount;

        if (isset($_GET['per_page'])) {
            $sql .= " LIMIT " . MetaData::showRows() . "," . MetaData::getPerPage();
        }

        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }





    /**
     *@method selectCategoryTags returns all meals with int $params['category'] && int $params['tags']
     **/

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
        if (isset($_GET['per_page'])) {
            $sql .= " LIMIT " . MetaData::showRows() . "," . MetaData::getPerPage();
        }




        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }



    /**
     *@method selectWith returns Category, Tags and Ingredients values based on $params['with']
     **/

    public function selectWith(array $params)
    {
        $lang = $params['lang'];
        $valueCTI = $params['cti'];
        $tableCTI = $valueCTI . "_" . $lang;

        $mealsTable = $params['table'];
        $tableCTI = $valueCTI . "_" . $lang;


        $sql = "SELECT " . $tableCTI . ".id, " . $tableCTI . ".title, " . $tableCTI . ".slug
            FROM " . $mealsTable . "
            INNER JOIN jela_svijeta.meals_" . $valueCTI .
            " ON " . $mealsTable . ".id = meals_" . $valueCTI . "." . "meals_id
             INNER JOIN jela_svijeta." . $tableCTI .
            " ON jela_svijeta.meals_" . $valueCTI . "." . $valueCTI . "_id = " . $tableCTI . ".id " .
            " WHERE " . $mealsTable . ".id = " . $params['id'];




        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }



    /**
     *@method tagsRowCount returns int of meals used with specific Tags
     **/

    public function tagsRowCount(): int
    {
        $lang = ValidUrl::validate($_GET['lang']);
        $id = ValidUrl::validate($_GET['tags']);

        $idCount = preg_match_all('!\d+!', $id);


        $sql = "SELECT meals_" . $lang . ".id, meals_" . $lang . ".title, meals_" . $lang . ".description
             FROM jela_svijeta.meals_" . $lang .
            " INNER JOIN jela_svijeta.meals_tags
             ON meals_" . $lang . ".id = meals_tags.meals_id
             WHERE meals_tags.tags_id IN (" . $id . ")
             GROUP BY jela_svijeta.meals_" . $lang . ".id, meals_" . $lang . ".title, meals_" . $lang . ".description
             HAVING COUNT(meals_tags.meals_id) = " . $idCount;


        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->rowCount();
        return $row;
    }




    /**
     *@method categoryRowCount returns int of meals used with specific Category
     **/

    public function categoryRowCount(): int
    {
        $lang = ValidUrl::validate($_GET['lang']);
        $categoryID = ValidUrl::validate($_GET['category']);
        # $perPage = ValidateUrlValue::validate($_GET['per_page']);


        $sql = "SELECT meals_" .  $lang . ".id, meals_" . $lang . ".title, meals_" . $lang . ".description, meals_" . $lang . ".status
            FROM jela_svijeta.meals_" . $lang .
            " INNER JOIN jela_svijeta.meals_category ON meals_" . $lang . ".id  = jela_svijeta.meals_category.meals_id
            WHERE jela_svijeta.meals_category.category_id ";


        if ($categoryID === "NULL") {
            $sql .= "IS NULL";
        } elseif ($categoryID === "!NULL") {
            $sql .= "IS NOT NULL";
        } else {
            $sql .= "=" . $categoryID;
        }


        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->rowCount();
        return $row;
    }





    /**
     *@method categoryTagsCount returns int of meals used with specific Category and Tags
     **/

    public function categoryTagsCount()
    {
        $lang = ValidUrl::validate($_GET['lang']);
        $categoryID = ValidUrl::validate($_GET['category']);
        $tagsID = ValidUrl::validate($_GET['tags']);
        $tagsIDCount = preg_match_all('!\d+!', $tagsID);

        $sql = "SELECT meals_" . $lang . ".id, meals_" . $lang . ".title, meals_" . $lang . ".description, meals_" . $lang . ".status
             FROM jela_svijeta.meals_" . $lang .
            " INNER JOIN jela_svijeta.meals_category
            ON jela_svijeta.meals_" . $lang . ".id = meals_category.meals_id
            INNER JOIN jela_svijeta.meals_tags
            ON jela_svijeta.meals_" . $lang . ".id = meals_tags.meals_id
            WHERE meals_category.category_id  ";

        $sql1 = " AND  meals_tags.tags_id IN (" . $tagsID . ") " .
            "GROUP BY meals_" . $lang . ".id, meals_" . $lang . ".title, meals_" . $lang . ".description, meals_" . $lang . ".status " .
            "HAVING COUNT(meals_tags.meals_id) = " . $tagsIDCount;

        if ($_GET['category'] === "NULL") {
            $sql .= "IS NULL " . $sql1;
        } else if ($_GET['category'] === "!NULL") {
            $sql .= "IS NOT NULL " . $sql1;
        } else {
            $sql .= "= " . $categoryID . $sql1;
        }


        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->rowCount(PDO::FETCH_ASSOC);
        return $row;
    }





    /**
     *@method mealsRowCount returns int of meals based on language
     **/

    public function mealsRowCount()
    {
        $lang = ValidUrl::validate($_GET['lang']);


        $sql = "SELECT title FROM jela_svijeta.meals_" . $lang;

        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $row = $stmt->rowCount();
        return $row;
    }
}
