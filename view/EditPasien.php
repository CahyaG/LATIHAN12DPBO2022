<?php

include_once("KontrakView.php");
include_once("presenter/ProsesPasien.php");

class EditPasien implements KontrakView {
    private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
    private $id;
	private $tpl;

    // constructor
    public function __construct($id) {
        $this->id = $id;
        $this->prosespasien = new ProsesPasien();
    }

    public function tampil() {
        // get the record that user want to edit
        $this->prosespasien->findPasien($this->id);
		// Membaca template skin.html
		$this->tpl = new Template("templates/form.html");

		// Mengganti kode Data dengan data yang sudah diproses
		$this->tpl->replace("DATA_TITLE", "Edit");

        $action = "edit";

        $this->tpl->replace("DATA_ACTION", $action);
        $this->tpl->replace("DATA_INPUTEDIT", $this->prosespasien->getId(0));
		$this->tpl->replace("DATA_BTN", "Update");

        $this->tpl->replace("DATA_ID", $this->prosespasien->getId(0));
        $this->tpl->replace("DATA_NIK", $this->prosespasien->getNik(0));
        $this->tpl->replace("DATA_NAMA", $this->prosespasien->getNama(0));
        $this->tpl->replace("DATA_TEMPAT", $this->prosespasien->getTempat(0));
        $this->tpl->replace("DATA_TL", $this->prosespasien->getTl(0));
        $this->tpl->replace("DATA_EMAIL", $this->prosespasien->getEmail(0));
        $this->tpl->replace("DATA_TELP", $this->prosespasien->getTelp(0));
        if($this->prosespasien->getGender(0) === "Laki-laki"){
            $this->tpl->replace("DATA_JK_LK", "checked");
        }else{
            $this->tpl->replace("DATA_JK_PR", "checked");
        }

		// Menampilkan ke layar
		$this->tpl->write();
    }
}