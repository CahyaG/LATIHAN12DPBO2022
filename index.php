<?php

/******************************************
Asisten Pemrogaman 11
 ******************************************/
require_once("config.php");
include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/TampilPasien.php");
include("view/CreatePasien.php");
include("view/EditPasien.php");
require_once("router.php");

$router = new Router();

// index
$router->get("/", function(){
    $tp = new TampilPasien();
    $data = $tp->tampil();
});

// tampil form add
$router->get("/add", function(){
    $cp = new CreatePasien();
    $data = $cp->tampil();
});
// submit add
$router->post("/add", function(){
    $prosesPasien = new ProsesPasien();
    $prosesPasien->createPasien($_POST);
    header("location: /".constant("APP_NAME"));
});

// tambil form edit
$router->get("/edit", function(){
    $ep = new EditPasien($_GET["id"]);
    $data = $ep->tampil();
});
// submit edit
$router->post("/edit", function(){
    $prosesPasien = new ProsesPasien();
    $prosesPasien->updatePasien($_POST);
    header("location: /".constant("APP_NAME"));
});

// hapus pasien
$router->post("/delete", function(){
    $prosesPasien = new ProsesPasien();
    $prosesPasien->deletePasien($_POST["id"]);
    header("location: /".constant("APP_NAME"));
});

$router->run();

