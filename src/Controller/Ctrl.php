<?php

namespace App\Controller;

use Core\SQLConnection;
use App\Model\Model;

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
        $url = filter_var($_SERVER["REQUEST_URI"], FILTER_VALIDATE_URL);

        return $url;
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

class Controller
{


    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    protected static array $validParameters = [
        'lang',
        'description',
        'tags',
        'with',
        'diff_time',
        'per_page',
        'page',
        'id',
        "category",
        "tags",
        "ingredients"

    ];





    public function areValidParams(): bool
    {
        foreach ($_GET as $key => $x) {
            if (!in_array($key, self::$validParameters)) {
                header("HTTP/1.0 404 NOT FOUND");
                die("404 NOT FOUND");
                return false;
            }
        }
        return true;
    }

    public function getMealData()
    {


        $params = $_GET;

        if ($this->areValidParams() && isset($params['lang'])) {
            $language = $params['lang'];
            $meals = $this->model;

            if (isset($params['per_page'])) {
                $per_page = $params['per_page'];
            } else {
                $per_page = null;
            }

            #if(!in_array($language, Languages::$langs))
            #{
            #    echo "Language provided does not exist" . PHP_EOL;
            #    return;
            #header("HTTP/1.0 404 Not Found");
            #die();
            #}


            $response = $meals->returnMeals([
                'table' => "jela_svijeta.meals_" . $language,
                'per_page' => $per_page
            ]);

            $response = ['data' => $response];
            $val = Parser::parseMetaData();
            $metaArray = array_merge($val, $response);

            return $metaArray;

            echo json_encode($metaArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
        }
    }

    public function getCTI($values, int $id)
    {



        $params = $_GET;

        if ($this->areValidParams() && isset($params['lang'])) {
            $language = $params['lang'];
            $meals = $this->model;

            #if(!in_array($language, Languages::$langs))
            #{
            #    echo "Language provided does not exist" . PHP_EOL;
            #    return;
            #header("HTTP/1.0 404 Not Found");
            #die();
            #}
            $meal = self::getMealData();

            $response = $meals->returnCTI([
                'table' => "jela_svijeta.meals_" . $language,
                'lang' => $language,
                'id' => $id, // ADD A VARIABLE
                'cti' => $values // !!! TRY INGREDIENTS !!! /// "category", "tags" or ingredients
            ]);
            $response = [$values => $response];
            $val = Parser::parseMetaData();
            $metaArray = array_merge($val, $response);


            $category = json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);

            #echo ("<pre>" . print_r($meals, true) . "</pre>");
            #echo $response['category'];

            # echo $category;
            return $response;
            # echo ("<pre>" . print_r($params, true) . "</pre>");
        }
    }

    public function getWithParams(int $xyz)
    {
        $params = $_GET;

        $api = [];
        if ($this->areValidParams() && isset($params['with'])) {

            $meal = self::getMealData();

            $with_params[] = explode(',', $params["with"]);
            $with_count = count($with_params[0]);
            foreach ($meal['data'] as $id => $x) {
                if ($with_count == 1) {
                    $with_one = self::getCTI($with_params[0][0], $xyz);

                    $with = $with_one;
                }

                if ($with_count == 2) {
                    $with_one = self::getCTI($with_params[0][0], $xyz);

                    $with_two = self::getCTI($with_params[0][1], $xyz);

                    $with = array_merge($with_one, $with_two);
                }
                if ($with_count == 3) {
                    $with_one = self::getCTI($with_params[0][0], $xyz);

                    $with_two = self::getCTI($with_params[0][1], $xyz);

                    $with_three = self::getCTI($with_params[0][2], $xyz);

                    $with = array_merge($with_one, $with_two, $with_three);
                }





                $api = array_merge($meal['data'][$xyz], $with);
            }
            #  echo "---------------------";

            # echo ("<pre>" . print_r($with, true) . "</pre>");
            # echo $with_count;
            #echo "---------------------";

            #  echo "!\n!!!\n";

            # echo ("<pre>" . print_r($meal, true) . "</pre>");

            #echo "\n!!!!\n";
            # $api = array_merge($api, $category);


            $response = json_encode($api, JSON_PRETTY_PRINT);

            echo $response;
        }
    }






    public function getTags()
    {

        if ($this->areValidParams() && isset($params['tags'])) {
        }
    }
}



$db = new SQLConnection;
$model = new Model($db);
$controller = new Controller($model);
#$meal = $controller->getMealData();

if (!isset($_GET['with'])) {
    $api = $controller->getMealData();

    echo json_encode($api, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
}

if (isset($_GET['with'])) {

    $meal = $controller->getMealData();
    for ($i = 0; $i < count($meal['data']); $i++) {

        #   if ($i == 0) {
        #       $api = $controller->getWithParams(0);
        #   }

        $api = $controller->getWithParams($i);
    }
}


    #$tags = $controller->getCTI($cti_loop[1]);

    #$ingredients = $controller->getCTI($cti_loop[2]);



#echo "\n-------------------------------------\n";
