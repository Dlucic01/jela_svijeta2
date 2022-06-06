# jela_svijeta


<h3>Directory Structure</h3>

Core directory holds all core files such as:

db.php - holds information for mysql, table and column names and languages
upload.php/upload - used for uploading fake Meals, Categories, Tags, Ingredients and for adding joins
meta_parser.php - generates Metadata


src directory contains Model and Controller

<hr>

<h3>Upload</h3>

To upload a new fake Meal, Category, Tag or Ingredient:
use php upload.php / or chmod u+x upload

and add meals, category, tags, ingredients like:
    ./upload meals
    
To join a Meal with a Category:
    ./upload join meals_category "meal_id" "category_id"
    
For other joins replace all mentions of category in line above with "tags" or "ingredients"
