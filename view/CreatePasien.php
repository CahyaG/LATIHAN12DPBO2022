<?php

include_once("KontrakView.php");
include_once("presenter/ProsesPasien.php");

class CreatePasien implements KontrakView {
	private $tpl;

	// constructor
    public function __construct() {
        
    }

    public function tampil() {
		// Membaca template skin.html
		$this->tpl = new Template("templates/form.html");

		// Mengganti kode Data dengan data yang sudah diproses
		$this->tpl->replace("DATA_TITLE", "Tambah");

        $action = "add";

        $this->tpl->replace("DATA_ACTION", $action);

		$this->tpl->replace("DATA_BTN", "Submit");

		// Menampilkan ke layar
		$this->tpl->write();
    }
}