<?php

namespace App\Controller;

use Core\SQLConnection;
use App\Model\Model;
use Core\CTIInsert;
use Core\Languages;

//require_once '../../Core/db.php';
require_once '../Model/Model.php';
require '../../Core/meta_parser.php';
header('Content-Type: application/json');


class ValidUrl
{
    public static function validate(string $url): string
    {
        $url = trim($url);
        $url = htmlspecialchars($url);
        # $url = filter_var($_SERVER["REQUEST_URI"], FILTER_VALIDATE_URL);

        return $url;
    }
}


class UrlParameterController
{
    public static array $validParameters = [
        'lang',
        'category',
        'tags',
        'with',
        'per_page',
        'page',
    ];

    //if requested url params are valid return true, if not 404
    public static function areValidParams(): bool
    {
        foreach ($_GET as $key => $v) {
            if (!in_array($key, self::$validParameters)) {
                header("HTTP/1.0 404 Not Found");
                die("404 Not Found");
                return false;
            }
        }
        return true;
    }

    public static function isValidUrl(): bool
    {
        for ($i = 0; $i < count(Languages::$value); $i++) {
            if (self::areValidParams() && in_array($_GET['lang'], Languages::$value)) {
                return true;
            }
            return false;
        }
    }
}

class Parser
{
    public static function parseMetaData()
    {
        $val = parser($_GET);

        return $val;
    }
}


class MealsController
{


    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }




    public function getMealData()
    {


        $params = $_GET;

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }
        $language = ValidUrl::validate($params['lang']);
        $meals = $this->model;


        $values = [
            'table' => "jela_svijeta.meals_" . $language,
        ];

        $response = $meals->returnMeals($values);

        $response = ['data' => $response];
        $val = Parser::parseMetaData();
        $metaArray = array_merge($val, $response);

        return $metaArray;

        echo json_encode($metaArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
    }
}


class TagsControl
{


    protected $model;
    protected $mealData;
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->mealData = new MealsController($model);
    }




    public function getTMeals(array $params)
    {


        $params = $_GET;
        $id = $params['tags'];

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }

        $language = ValidUrl::validate($params['lang']);
        $meals = $this->model;

        $response = $meals->returnTMeals([
            'table' => "jela_svijeta.meals_" . $language,
            'lang' => $language,
            'cti' => "tags",
            'id' => $id
        ]);

        return $response;
    }

    public function getTags($id, $mealID)
    {


        $params = $_GET;

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }

        $language = ValidUrl::validate($params['lang']);
        $meals = $this->model;

        $response = $meals->selectTags([
            'table' => "jela_svijeta.meals_" . $language,
            'lang' => $language,
            'cti' => "tags",
            'id' => $id,
            'mealID' => $mealID
        ]);
        $response = ["Tags" => $response];

        return $response;
    }



    public function getMealsWithTags()
    {
        $params = $_GET;
        $meals = $this->getTMeals($params['tags']);
        $allCategory = array();
        $allCombine = [];
        foreach ($meals["meals"] as $meal) {
            # echo $meal['id'];
            $category = $this->getTags($params['tags'], $meal['id']);

            $allCategory[] = $category;
            $combine = array_merge($meal, $category);
            $allCombine[] = $combine;
        }

        #echo $combine;
        # echo json_encode($allCombine, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
        echo json_encode($meals["meals"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
        # echo json_encode($category, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
    }
}

class CategoryController
{


    protected $model;
    protected $mealData;
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->mealData = new MealsController($model);
    }




    public function getCMeals(array $params)
    {


        #$params = $_GET;

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }

        $language = ValidUrl::validate($params['lang']);
        $meals = $this->model;
        if ($_GET['category'] == "null") {
            $response = $meals->returnCMealsNull([
                'lang' => $language,
                'cti' => "category",
                'category_table' => $params['category'],
                'id' => "IS NULL"
            ]);

            #    $response = ["meals" => $response];
        }

        if ($_GET['category'] == "!null") {
            $response = $meals->returnCMeals([
                'lang' => $language,
                'category_table' => $params['category'],

                'table' => "jela_svijeta.meals_" . $language,
                'cti' => "category",
                'id' => "IS NOT NULL"
            ]);

            #     $response = ["meals" => $response];
        }

        $response = $meals->returnCMeals([
            'table' => "jela_svijeta.meals_" . $language,
            'lang' => $language,
            'cti' => "category",
            'id' => "=" . $params['category']
        ]);
        # $response = ["meals" => $response];


        return $response;
    }
}

class WithController
{
    protected $model;
    protected $mealsData;
    protected $mealsCategory;
    protected $mealsTags;

    public function __construct(Model $model, MealsController $mealsData, CategoryController $mealsCategory, TagsControl $mealsTags)
    {
        $this->model = $model;
        $this->mealsData = $mealsData;
        $this->mealsCategory = $mealsCategory;
        $this->mealsTags = $mealsTags;
    }


    public function setWith($values, int $id)
    {


        $params = $_GET;

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }

        $language = ValidUrl::validate($params['lang']);
        $meals = $this->model;

        $response = $meals->selectWith([
            'table' => "jela_svijeta.meals_" . $language,
            'lang' => $language,
            'id' => $id,
            'cti' => $values
        ]);

        $response = [$values => $response];

        return $response;
    }

    public function getWith(array $params, $meals_id)
    {

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }

        $model = $this->model;
        $params = $_GET;

        $api = [];


        #$meal = $this->mealData->getMealData();


        $with_params[] = explode(',', $params['with']);


        $with_count = count($with_params[0]);

        $meals_id_count = count($meals_id);

        for ($i = 0; $i < $meals_id_count; $i++) {

            if ($with_count == 1) {

                $with_one = self::setWith($with_params[0][0], $meals_id[$i]['id']);

                $with = $with_one;
            }

            if ($with_count == 2) {
                $with_one = self::setWith($with_params[0][0], $meals_id[$i]['id']);

                $with_two = self::setWith($with_params[0][1], $meals_id[$i]['id']);

                $with = array_merge($with_one, $with_two);
            }
            if ($with_count == 3) {
                $with_one = self::setWith($with_params[0][0], $meals_id[$i]['id']);

                $with_two = self::setWith($with_params[0][1], $meals_id[$i]['id']);

                $with_three = self::setWith($with_params[0][2], $meals_id[$i]['id']);

                $with = array_merge($with_one, $with_two, $with_three);
            }

            $response = array_merge($meals_id[$i], $with);
            $api[] = $response;
            # echo "\n-----------------------------------------------------\n";
            # echo ("<pre>" . print_r($with, true) . "</pre>");

            #echo "\n-----------------------------------------------------\n";
        }

        return $api;

        # echo ("<pre>" . print_r($api, true) . "</pre>");
    }
}

class CategoryTagsController
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getCategoryTags(array $params)
    {
        $model = $this->model;
        $lang = $params["lang"];
        $categoryID = $params["category"];
        $tagsID = $params["tags"];

        if ($params['category'] == "null") {
            $response = $model->selectCategoryTags([
                'lang' => $lang,
                'categoryID' => 'IS NULL',
                'tagsID' => $tagsID
            ]);

            return $response;
        }

        if ($params['category'] == "!null") {
            $response = $model->selectCategoryTags([
                'lang' => $lang,
                "categoryID" => "IS NOT NULL",
                "tagsID" => $tagsID
            ]);

            return $response;
        }

        $response = $model->selectCategoryTags([
            'lang' => $lang,
            'categoryID' => "=" . $categoryID,
            'tagsID' => $tagsID
        ]);
        return $response;
    }
}


class PerPage
{



    public function perPage()
    {
        $params = $_GET;

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }
        if (isset($params['per_page'])) {
            $per_page = $params['per_page'];
        } else {
            $per_page = null;
        }
        return $per_page;
    }
}


class SearchEngine
{

    protected $model;

    private $mealsController;
    private $categoryController;

    private $tagsController;
    private $withController;
    private $categoryTagsController;

    public $count;
    public array $searchParams = ["lang", "category", "tags", "with"];

    public function __construct(Model $model)
    {
        $this->mealsController = new MealsController($model);
        $this->categoryController = new CategoryController($model);

        $this->tagsController = new TagsControl($model);
        $this->withController = new WithController($model, $this->mealsController, $this->categoryController, $this->tagsController);
        $this->categoryTagsController = new CategoryTagsController($model);
    }

    //Searches trough searchParams array and return count of elements located in url
    public function getParameterCount(array $params)
    {
        foreach ($params as $key => $val) {
            if (in_array($key, $this->searchParams)) {
                $this->count += 1;
            }
        }
        return $this->count;
    }

    //loop trogh get parameters, if any of them is in searchParams array, store it
    public function getSearchParams()
    {
        $paramsHolder = [];

        foreach ($_GET as $key => $val) {
            if (in_array($key, $this->searchParams)) {
                $paramsHolder[] = $key;
            }
        }

        //unset lang because it is required
        for ($i = 0; $i < count($paramsHolder); $i++) {
            if ($paramsHolder[$i] == 'lang') {
                unset($paramsHolder[$i]);
            }
        }
        return $paramsHolder;
    }

    //Main part of the application, runs all other methods depending on the url parameters
    public function returnResponse(array $params)
    {
        $count = $this->getParameterCount($params);
        $searchParams = $this->getSearchParams();

        #print_r($searchParams);

        #print_r($searchParams);
        #echo $count;
        for ($i = 1; $i < $this->getParameterCount($params); $i++) {
            if ($count == 1) {
                $response = $this->mealsController->getMealData($_GET);
                $response = ['data' => $response];
                return $response;
            }

            if ($count == 2 && $searchParams[$i] == "tags") {
                $response = $this->tagsController->getTMeals($_GET);
                $response = ['data' => $response];
                return $response;
            }

            if ($count == 2 && $searchParams[$i] == "category") {
                $response = $this->categoryController->getCMeals($_GET);
                $response = ['data' => $response];
                return $response;
            }

            if ($count == 2 && $searchParams[$i] == "with") {
                $response = $this->withController->getWith($_GET, $this->mealsController->getMealData($_GET));
                $response = ['data' => $response];
                return $response;
            }

            if ($count == 3 && isset($params['category']) && isset($params['tags'])) {
                $response = $this->categoryTagsController->getCategoryTags($_GET);
                $response = ['data' => $response];
                return $response;
            }

            if ($count == 3 && isset($params['category']) && isset($params['with'])) {
                $response = $this->withController->getWith($_GET, $this->categoryController->getCMeals($_GET));
                $response = ['data' => $response];
                return $response;
            }

            if ($count == 3 && isset($params['tags']) && isset($params['with'])) {
                $response = $this->withController->getWith($_GET, $this->tagsController->getTMeals($_GET));
                $response = ['data' => $response];
                return $response;
            }

            if ($count == 4) {
                $response = $this->withController->getWith($_GET, $this->categoryTagsController->getCategoryTags($_GET));
                $response = ['data' => $response];
                return $response;
            }

            return;
        }
    }
}
$db = new SQLConnection;
$model = new Model($db);

$searchEngine = new SearchEngine($model);
#$val = $searchEngine->getParemeterCount($_GET);
#print_r($val);
#$val = $searchEngine->getSingleSearchParam();
#echo $val;
$response = $searchEngine->returnResponse($_GET);
echo json_encode($response, JSON_PRETTY_PRINT);


/*
$db = new SQLConnection;
$model = new Model($db);
$mealControl = new MealsData($model);
$withControl = new CTIControl($model);
$perPageControl = new PerPage($model);
$withTags = new TagsControl($model);


if (isset($_GET['lang']) && !isset($_GET['with'])) {

   $allMeals = $mealControl->getMealData();

    echo json_encode($allMeals, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
}

if (isset($_GET['category'])) {

    $allCategory = $withControl->getCMeals($_GET);

    echo json_encode($allCategory, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
}

if (isset($_GET['tags'])) {


    $allCategory = $withTags->getTMeals($_GET);
    echo json_encode($allCategory, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
}

$api_per = $perPageControl->perPage();

$api_response = array();
if (isset($_GET['with'])) {
    for ($i = 0; $i < $api_per; $i++) {
        $api_response[] = $api_with;
    }
    echo json_encode($api_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);

    die();
}


if (!isset($_GET['with'])) {

    //$allMeals = $mealControl->getMealData();
    $allCategory = $withControl->getCategory();

    echo json_encode($allCategory, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
}

if (isset($_GET['tags'])) {
    $api = $withControl->getMealsTags();

    echo json_encode($api, JSON_PRETTY_PRINT);
}

if (isset($_GET['category'])) {

    $api = $withControl->combineMealsCategory();

    echo json_encode($api, JSON_PRETTY_PRINT);

    #  foreach ($_GET['category'] as $data) {
    echo "\n______________________________________";

    $api = $withControl->getMealsCategory();

    echo json_encode($api, JSON_PRETTY_PRINT);

    #echo "______________________________";
    #echo ("<pre>" . print_r($api["data"][1], true) . "</pre>");
    # }
}






*/












#if (!isset($_GET['with'])) {

#}

#if (isset($_GET['with'])) {

#$meal = $controller->getMealData();
    #for ($i = 0; $i < count($meal['data']); $i++) {

        #   if ($i == 0) {
        #       $api = $controller->getWithParams(0);
        #   }

        #$api = $controller->getWithParams($i);
    #}
#}


    #$tags = $controller->getCTI($cti_loop[1]);

    #$ingredients = $controller->getCTI($cti_loop[2]);



#echo "\n-------------------------------------\n";
/*

    public function getCTI($values, int $id)
    {


        $params = $_GET;

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }

        $language = ValidUrl::validate($params['lang']);
        $meals = $this->model;

        $response = $meals->returnCTI([
            'table' => "jela_svijeta.meals_" . $language,
            'lang' => $language,
            'id' => $id,
            'cti' => $values,
            'g_tag' => 3
        ]);
        $response = [$values => $response];

        return $response;
    }






#############################################



*/
