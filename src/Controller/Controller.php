<?php

namespace App\Controller;

use Core\SQLConnection;
use App\Model\Model;
use Core\Languages;
use Core\MetaParser;

require '../Model/Model.php';
require '../../Core/meta_parser.php';
header('Content-Type: application/json');


class ValidUrl
{
    public static function validate(string $url): string
    {
        $url = trim($url);
        $url = htmlspecialchars($url);

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
        'page'
    ];

    # if requested url params are valid return true, if not 404
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



class MealsController
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }



    /**
     *@method getMealData Returns all meals
     */


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


        return $response;
    }
}


class TagsController
{


    protected $model;
    protected $mealData;
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->mealData = new MealsController($model);
    }


    /**
     *@method getTMeals Returns meals data with implemented tags
     */

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




    /**
     *
     *@method getCMeals Returns meals data with implemented categories
     *
     */


    public function getCMeals(array $params)
    {



        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }

        $language = ValidUrl::validate($params['lang']);
        $meals = $this->model;



        # Returns all meals that have categories "NULL"

        if ($_GET['category'] == "null") {
            $response = $meals->returnCMealsNull([
                'lang' => $language,
                'cti' => "category",
                'category_table' => $params['category'],
                'id' => "IS NULL"
            ]);
        }



        # Returns all meals that have categories not null

        if ($_GET['category'] == "!null") {
            $response = $meals->returnCMeals([
                'lang' => $language,
                'category_table' => $params['category'],

                'table' => "jela_svijeta.meals_" . $language,
                'cti' => "category",
                'id' => "IS NOT NULL"
            ]);
        }



        # Returns all meals that have id of $params['category']

        if ($_GET['category'] != "null" && $_GET['category'] != "!null") {
            $response = $meals->returnCMeals([
                'table' => "jela_svijeta.meals_" . $language,
                'lang' => $language,
                'cti' => "category",
                'id' => "=" . $params['category']
            ]);
        }

        return $response;
    }
}

class WithController
{




    protected $model;
    protected $mealsData;
    protected $mealsCategory;
    protected $mealsTags;

    public function __construct(Model $model, MealsController $mealsData, CategoryController $mealsCategory, TagsController $mealsTags)
    {
        $this->model = $model;
        $this->mealsData = $mealsData;
        $this->mealsCategory = $mealsCategory;
        $this->mealsTags = $mealsTags;
    }



    /**
     *@method setWith Can generate Categories, Tags, Ingredients of a required meal
     */


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

        if (empty($response)) {
            $response = "null";
        }

        $response = [$values => $response];


        return $response;
    }




    /**
     *
     *@method getWith Merges Categories, Tags, Ingredients of a required meal
     *
     */




    public function getWith(array $params, $meals_id)
    {

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }

        $params = $_GET;

        $api = [];




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
        }

        return $api;
    }
}

class CategoryTagsControllerler
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }




    /**
     *
     *@method getCategoryTags Returns meals data with implemented Categories and Tags
     *
     */


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


    /**
     *@method perPage sets per_page request
     */


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
    private $categoryTagsControllerler;

    public $count;
    public array $searchParams = ["lang", "category", "tags", "with"];

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->mealsController = new MealsController($model);
        $this->categoryController = new CategoryController($model);

        $this->tagsController = new TagsController($model);
        $this->withController = new WithController($model, $this->mealsController, $this->categoryController, $this->tagsController);
        $this->categoryTagsControllerler = new CategoryTagsControllerler($model);
    }



    /**
     *
     *@method perParameterCount returns parameter count
     *
     */

    public function getParameterCount(array $params)
    {
        foreach ($params as $key => $val) {
            if (in_array($key, $this->searchParams)) {
                $this->count += 1;
            }
        }
        return $this->count;
    }



    /**
     *
     *@method getSearchParams returns an array of parameters
     *
     */


    public function getSearchParams()
    {
        $paramsHolder = [];

        foreach ($_GET as $key => $val) {
            if (in_array($key, $this->searchParams)) {
                $paramsHolder[] = $key;
            }
        }

        for ($i = 0; $i < count($paramsHolder); $i++) {
            if ($paramsHolder[$i] == 'lang') {
                unset($paramsHolder[$i]);
            }
        }
        return $paramsHolder;
    }




    /**
     *
     *@method returnResponse returns a response based on all parameters
     *
     */

    public function returnResponse(array $params)
    {
        $count = $this->getParameterCount($params);
        $searchParams = $this->getSearchParams();


        for ($i = 1; $i < $this->getParameterCount($params); $i++) {
            if ($count == 1) {
                $response = $this->mealsController->getMealData($_GET);
                $meta = MetaParser::parser($this->model->mealsRowCount());
                $links = MetaParser::getLinks($this->model->mealsRowCount());
                $response = ['data' => $response];
                $response = array_merge($meta, $response, $links);
            }

            if ($count == 2 && $searchParams[$i] == "tags") {
                $response = $this->tagsController->getTMeals($_GET);
                $meta = MetaParser::parser($this->model->tagsRowCount());
                $links = MetaParser::getLinks($this->model->tagsRowCount());
                $response = ['data' => $response];
                $response = array_merge($meta, $response);
            }

            if ($count == 2 && $searchParams[$i] == "category") {

                $response = $this->categoryController->getCMeals($_GET);
                $meta = MetaParser::parser($this->model->categoryRowCount());
                $links = MetaParser::getLinks($this->model->categoryRowCount());
                $response = ['data' => $response];

                $response = array_merge($meta, $response, $links);
            }

            if ($count == 2 && $searchParams[$i] == "with") {
                $response = $this->withController->getWith($_GET, $this->mealsController->getMealData($_GET));
                $meta = MetaParser::parser($this->model->mealsRowCount());
                $links = MetaParser::getLinks($this->model->mealsRowCount());
                $response = ['data' => $response];

                $response = array_merge($meta, $response, $links);
            }

            if ($count == 3 && isset($params['category']) && isset($params['tags'])) {
                $response = $this->categoryTagsControllerler->getCategoryTags($_GET);
                $meta = MetaParser::parser($this->model->categoryTagsCount());
                $links = MetaParser::getLinks($this->model->categoryTagsCount());

                $response = array_merge($meta, $response, $links);
            }

            if ($count == 3 && isset($params['category']) && isset($params['with'])) {
                $response = $this->withController->getWith($_GET, $this->categoryController->getCMeals($_GET));
                $meta = MetaParser::parser($this->model->categoryRowCount());
                $links = MetaParser::getLinks($this->model->categoryRowCount());
                $response = ['data' => $response];

                $response = array_merge($meta, $response, $links);
            }

            if ($count == 3 && isset($params['tags']) && isset($params['with'])) {
                $response = $this->withController->getWith($_GET, $this->tagsController->getTMeals($_GET));
                $meta = MetaParser::parser($this->model->tagsRowCount());
                $links = MetaParser::getLinks($this->model->tagsRowCount());
                $response = ['data' => $response];

                $response = array_merge($meta, $response, $links);
            }

            if ($count == 4) {
                $response = $this->withController->getWith($_GET, $this->categoryTagsControllerler->getCategoryTags($_GET));
                $meta = MetaParser::parser($this->model->categoryTagsCount());
                $links = MetaParser::getLinks($this->model->categoryTagsCount());
                $response = ['data' => $response];

                $response = array_merge($meta, $response, $links);
            }

            return $response;
        }
    }
}
$db = new SQLConnection;
$model = new Model($db);

$searchEngine = new SearchEngine($model);

$fullLink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (!filter_var($fullLink, FILTER_VALIDATE_URL)) {
    echo "ERROR!";
    return;
}
$response = $searchEngine->returnResponse($_GET);
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR);
