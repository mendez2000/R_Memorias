<?php
include_once '../conexion/conexiones.php';
session_start();
session_unset();
session_destroy();
header("location:/R_Memorias/index.php");
