<?php

namespace Core;

use App\Model\Model;
use Core\SQLConnection;
use App\Controller\ValidUrl;

require_once 'db.php';


class MetaParser
{
    public static function parser(int $totalItems)
    {
        $totalItems = (string)($totalItems);
        $totalItems = ValidUrl::validate($totalItems);

        $page = isset($_GET['page']) ? ValidUrl::validate($_GET['page']) : 1;

        $perPage = isset($_GET['per_page']) ? ValidUrl::validate($_GET['per_page']) : $totalItems;

        $totalPages = ceil($totalItems / $perPage);
        //Page can't be negative
        if ($page < 1) {
            $page = 1;
        }

        $metaData = [
            'meta' => [
                'currentPage' => $page,
                'totalItems' => $totalItems,
                'itemsPerPage' => $perPage,
                'totalPages' => $totalPages,
            ]
        ];
        return $metaData;
    }

    public static function getLinks(int $totalItems)
    {
        $totalItems = (string) ($totalItems);
        $totalItems = ValidUrl::validate($totalItems);

        $page = isset($_GET['page']) ? ValidUrl::validate($_GET['page']) : 1;
        $perPage = isset($_GET['per_page']) ? ValidUrl::validate($_GET['per_page']) : $totalItems;
        $totalPages = ceil($totalItems / $perPage);

        $linksArr[] = explode("&page=" . $page, $_SERVER["REQUEST_URI"]);
        $fullLink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $link = "http://$_SERVER[HTTP_HOST]" . $linksArr[0][0] . $linksArr[0][1] . "&page=";

        //Generating links
        $linkNull = "null";

        if ($page >= $totalPages && $totalPages == 1) {
            $links = [
                'links' => [
                    'previous' => $linkNull, #$link . ($page - 1),
                    'self' => $fullLink,
                    'next' => $linkNull,
                ]
            ];
        } elseif ($page > $totalPages) {
            $links = [
                'links' => [
                    'previous' => $linkNull,
                    'self' => $fullLink,
                    'next' => $linkNull
                ]
            ];
        } elseif ($page == $totalPages) {
            $links = [
                'links' => [
                    'previous' => $link . ($page - 1),
                    'self' => $fullLink,
                    'next' => $linkNull,
                ]
            ];
        } elseif ($page == 1) {
            $links = [
                'links' => [
                    'previous' => $linkNull,
                    'self' => $fullLink,
                    'next' => $link . ($page + 1),
                ]
            ];
        } elseif ($page <= 0) {
            $links = [
                'links' => [
                    'previous' => $linkNull,
                    'self' => $link . ($page = 1),
                    'next' => $linkNull,  #$link . ($page + 1),
                ]
            ];
        } else {
            $links = [
                'links' => [
                    'previous' => $link . ($page - 1),
                    'self' => $fullLink,
                    'next' => $link . ($page + 1),
                ]
            ];
        }

        return $links;
    }
}
