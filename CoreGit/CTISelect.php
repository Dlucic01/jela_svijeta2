<?php
/*
namespace Core;

require_once "db.php";

use PDO;

class CTISelect
{

    protected $dbConnInterface;

    public function __construct(DBConnInterface $dBConnInterface)
    {
        $this->dbConnInterface = $dBConnInterface;
    }

    public function selectAll(array $params)
    {
        $table = $params[1];
        $sql = "SELECT * FROM jela_svijeta." . $table ;

        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($row, JSON_PRETTY_PRINT);
    }
}

$db = new SQLConnection;
$select = new CTISelect($db);
$select->selectAll($argv);
*/
