# jela_svijeta



<h3>Directory Structure</h3>

Core directory holds all core files such as:

db.php - holds information for mysql, table and column names and languages
upload.php/upload - used for uploading fake Meals, Categories, Tags, Ingredients and for adding joins
meta_parser.php - generates Metadata


src directory contains Model and Controller

<hr>
<br>

<h3>Basic Usage</h3>

<p>In Core/db.php please fulfill mysql username and password</p>
<p>Database name Must be "jela_svijeta"</p>
<hr>

<p>To upload a new fake Meal, Category, Tag or Ingredient:</p>
<p>use "php upload.php" or "chmod u+x upload"</p>

<p>and add meals, category, tags, ingredients like:</p>

        ./upload meals
   
<p>To join a Meal with a Category:</p>

        ./upload join meals_category "meal_id" "category_id"

<p>For other joins replace all mentions of category in line above with "tags" or "ingredients"</p>

<hr>
<br>

<p>diff_time parameter is not supported</p>
