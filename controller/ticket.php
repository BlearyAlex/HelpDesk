<?php
require_once("../config/conexion.php");
require_once("../models/Ticket.php");

$ticket = new Ticket();

switch ($_GET["op"]) {
    case "insert":
        $ticket->insert_ticket($_POST["usu_id"], $_POST["cat_id"], $_POST["tick_titulo"], $_POST["tick_desc"],);
        break;

    case "listar_ticket_usuario":
        $datos = $ticket->listar_ticket_usuario($_POST["usu_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["tick_id"];
            $sub_array[] = $row["cat_nom"];
            $sub_array[] = $row["tick_titulo"];
            if ($row["tick_estado"] == 'Abierto') {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            } else {

                $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
            }
            $sub_array[] =  date("d/m/Y H:i:s", strtotime($row["fecha_create"]));
            $sub_array[] = '<button type="button" onClick="ver(' . $row["tick_id"] . ');"  id="' . $row["tick_id"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case "listar":
        $datos = $ticket->listar_ticket();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["tick_id"];
            $sub_array[] = $row["cat_nom"];
            $sub_array[] = $row["tick_titulo"];

            if ($row["tick_estado"] == 'Abierto') {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            } else {

                $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
            }

            $sub_array[] =  date("d/m/Y H:i:s", strtotime($row["fecha_create"]));
            $sub_array[] = '<button type="button" onClick="ver(' . $row["tick_id"] . ');"  id="' . $row["tick_id"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;
}
