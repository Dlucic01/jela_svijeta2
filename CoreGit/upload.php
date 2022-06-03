<?php

namespace Core;

require_once "db.php";

use Faker;



class Category
{

    protected $db;
    protected $upload;

    public function __construct(DBConnInterface $db, Upload $upload)
    {
        $this->db = $db;
        $this->upload = $upload;
    }


    function insertCategory()
    {

        #$db = new SQLConnection;
        #$user = new Upload($db);


        $lang_counter = count(Lang::$faker_lang);





        for ($i = 0; $i < $lang_counter; $i++) {
            $faker_lang = Lang::$faker_lang[$i];
            $faker = Faker\Factory::create($faker_lang);

            //Generate Faker Titles
            $faker_category = $faker->streetName;

            $faker_cat[] = $faker_category;

            $faker_val = [
                0 => $faker_cat,
            ];


            // Generate Faker Slugs
            if ($i == 0) {
                $slug = [
                    0 => Upload::slugMaker($faker_cat[0]),

                ];
            }
        }

        # $faker = Faker\Factory::create($faker_lang[$k]);
        for ($j = 0; $j < $lang_counter; $j++) {

            $this->upload->insert(array(
                "table" => Table::$value[0][$j],

                "column" => CTI::$value,
                "param" => $faker_val[0][$j],
                "slug" => $slug[0]
            ));
        }
    }
}



class Tags
{
    protected $db;
    protected $upload;

    public function __construct(DBConnInterface $db, Upload $upload)
    {
        $this->db = $db;
        $this->upload = $upload;
    }


    function insertTags()
    {

        #$db = new SQLConnection;
        #$user = new Upload($db);


        $lang_counter = count(Lang::$faker_lang);





        for ($k = 0; $k < $lang_counter; $k++) {
            $faker_lang = Lang::$faker_lang[$k];
            $faker = Faker\Factory::create($faker_lang);

            //Generate Faker Titles
            $faker_tags = $faker->company;

            $faker_tag[] = $faker_tags;

            $faker_val = [
                0 => $faker_tag,
            ];


            // Generate Faker Slugs
            if ($k == 0) {
                $slug = [
                    0 => Upload::slugMaker($faker_tag[0]),

                ];
            }
        }

        # $faker = Faker\Factory::create($faker_lang[$k]);
        for ($j = 0; $j < $lang_counter; $j++) {

            $this->upload->insert(array(
                "table" => Table::$value[1][$j],

                "column" => CTI::$value,
                "param" => $faker_val[0][$j],
                "slug" => $slug[0]
            ));
        }
    }
}

class Ingredients
{
    protected $db;
    protected $upload;

    public function __construct(DBConnInterface $db, Upload $upload)
    {
        $this->db = $db;
        $this->upload = $upload;
    }


    function insertIngredients()
    {



        $lang_counter = count(Lang::$faker_lang);




        for ($k = 0; $k < $lang_counter; $k++) {
            $faker_lang = Lang::$faker_lang[$k];
            $faker = Faker\Factory::create($faker_lang);

            //Generate Faker Titles
            $faker_tags = $faker->name;

            $faker_tag[] = $faker_tags;

            $faker_val = [
                0 => $faker_tag,
            ];


            // Generate Faker Slugs
            if ($k == 0) {
                $slug = [
                    0 => Upload::slugMaker($faker_tag[0]),

                ];
            }
        }

        # $faker = Faker\Factory::create($faker_lang[$k]);
        for ($j = 0; $j < $lang_counter; $j++) {

            $this->upload->insert(array(
                "table" => Table::$value[2][$j],

                "column" => CTI::$value,
                "param" => $faker_val[0][$j],
                "slug" => $slug[0]
            ));
        }
    }
}


class Meals
{
    protected $db;
    protected $upload;

    public function __construct(DBConnInterface $db, Upload $upload)
    {
        $this->db = $db;
        $this->upload = $upload;
    }


    function insertMeals()
    {

        // Random Category
        $random_cat = rand(0, 1);

        if ($random_cat == 0) {
            $meal_category = "null";
        }
        if ($random_cat == 1) {
            $meal_category = "Category";
        }

        $random_ing = rand(0, 1);
        if ($random_ing == 0) {
            $meal_ingredients = "null";
        }
        if ($random_ing == 1) {
            $meal_ingredients = "Ingredient";
        }

        $random_tag = rand(0, 1);
        if ($random_tag == 0) {
            $meal_tags = "null";
        }
        if ($random_tag == 1) {
            $meal_tags = "Tag";
        }
        $lang_counter = count(Lang::$faker_lang);


        for ($i = 0; $i < $lang_counter; $i++) {
            $faker_lang = Lang::$faker_lang[$i];
            $faker = Faker\Factory::create($faker_lang);
            $meal_title = $faker->lastName;
            $meal_tit[] = $meal_title;
        }

        for ($j = 0; $j < $lang_counter; $j++) {
            $faker_lang = Lang::$faker_lang[$j];
            $faker = Faker\Factory::create($faker_lang);
            $meal_desc = $faker->country;
            $meal_des[] = $meal_desc;
        }



        $meal_values = [
            0 => $meal_tit,
            1 => $meal_des,
            2 => $meal_category,
            3 => $meal_ingredients,
            4 => $meal_tags
        ];

        for ($j = 0; $j < $lang_counter; $j++) {

            $this->upload->insert(array(
                "table" => Table::$value[3][$j],


                "column" => MealColumns::$value,
                "param" => $meal_values[0][$j],               // #[$j][$j]
                "title" => $meal_values[0][$j],
                "description" => $meal_values[1][$j],
                "category" => $meal_values[2],
                "tags" => $meal_values[3],
                "ingredients" => $meal_values[4]
            ));
            #   }
        }
        #        echo "------------------------\n";
        #        echo ("<pre>" . print_r($meal_tit, true) . "</pre>");
        #        echo "------------------------\n";
        #        echo "!!!!!!!!!!!!!!!!!!!!!!!!\n";
        #        echo ("<pre>" . print_r($meal_values, true) . "</pre>");
        #        echo "!!!!!!!!!!!!!!!!!!!!!!!!\n";
        #        echo "????????????????????????\n";
        #        echo ("<pre>" . print_r($meal_des, true) . "</pre>");
        #        echo "????????????????????????\n";

        #for ($j = 0; $j < $lang_counter; $j++) {

        #   $this->upload->insert(array(
        #      "table" => Table::$value[2][$j],

        # ));
        #}
    }
}





if (isset($argc) && $argc < 3 && $argc > 1) {
    $sql_conn = new SQLConnection;
    $upload_v = new Upload($sql_conn);

    if ($argv[1] == "category") {
        $cti_v = new Category($sql_conn, $upload_v);
        $cti_v->insertCategory();
    }

    if ($argv[1] == "tags") {
        $cti_v = new Tags($sql_conn, $upload_v);
        $cti_v->insertTags();
    }

    if ($argv[1] == "ingredients") {
        $cti_v = new Ingredients($sql_conn, $upload_v);
        $cti_v->insertIngredients();
    }
    if ($argv[1] == "meal") {
        $cti_v = new Meals($sql_conn, $upload_v);
        $cti_v->insertMeals();
    }
} else {
    echo "ERROR!!! Invalide number of arguments. Expected 1 argument named (category, tags, ingredients, meals)\n\n";
}
#$sql_upload = new Upload($sql_conn);
#$new_category = new Category($sql_conn, $sql_upload);
#echo ("<pre>" . print_r($sql_upload, true) . "</pre>");

/*
if ($sql_conn = new SQLConnection) {

    if ($upload = new Upload($sql_conn)) {

        if ($new_category = new Category($sql_conn, $upload)); {
            echo "cool";
        }
        echo "cool 2";
    }
    echo "cool 3";
    echo ("<pre>" . print_r($upload, true) . "</pre>");
}
*/
