<?php

use App\Model\Model;
use Core\SQLConnection;

require_once 'db.php';

function parser(array $params)
{
    $db = new SQLConnection;
    $model = new Model($db);

    $metaData = [
        'meta' => [
            'currentPage' => isset($params['page']) ? $params['page'] : null,
            'totalItems' => $model->mealsRowCount(),
            'itemsPerPage' => isset($params['per_page']) ? $params['per_page'] : null,
            'totalPages' => rand(1, 10),
        ]
    ];
    return $metaData;
}
