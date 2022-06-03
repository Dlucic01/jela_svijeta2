<?php

namespace Core;

require_once "db.php";

use Faker;



/////////////////////////////////////////////////////7

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
        echo $lang_counter;

        $faker_types = [
            0 => "streetName",
            1 => "company",
            2 => "name"
        ];




        $faker_type = $faker_types[0];

        for ($k = 0; $k < $lang_counter; $k++) {
            $faker_lang = Lang::$faker_lang[$k];
            $faker = Faker\Factory::create($faker_lang); //Generate Faker Titles $faker_category=$faker->streetName;
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
                $this->upload->insert(array(
                    "table" => Table::$value[$i][$j],

                    "column" => CTI::$value,
                    "param" => $faker_val[$i][$j],
                    "slug" => $slug[$i]
                ));
            }
        }
    }
}
