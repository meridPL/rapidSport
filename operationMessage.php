<?php
    require('../DBConnect.php');

    // print_r($_POST);
    $operation = $_POST['operation'];
    $text = isset($_POST['text']) ? $_POST['text'] : null;
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $turn = isset($_POST['turn']) ? $_POST['turn'] : null;
    $tab = Array();

    switch($operation){
        case 'save':
            $sql = "
                UPDATE message SET
                    zawartosc = $2,
                    turn = $3
                WHERE nazwa = $1
                RETURNING 'save' AS update
            ";
            array_push($tab, $name, $text, $turn);
            break;
        case 'get':
            $sql = "
                SELECT zawartosc AS text, turn::int
                FROM message
                WHERE nazwa = $1
            ";
            array_push($tab, $name);
            break;
        default:
            $sql = null;
    }

    if($sql != null){
        $result = pg_query_params($sql, $tab);
        $zwroc = pg_fetch_assoc($result);
        $zwroc['error'] = 'OK';
    }else{
        $zwroc['error'] = 'NOK';
    }
    echo json_encode($zwroc);
?>