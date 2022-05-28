<?php

/******************************************
Asisten Pemrogaman 11
 ******************************************/

class TabelPasien extends DB
{
	function getPasien()
	{
		// Query mysql select data pasien
		$query = "SELECT * FROM pasien";
		// Mengeksekusi query
		return $this->execute($query);
	}
	// get spesific pasien
	function findPasien($id) {
		// query
		$query = "SELECT * FROM pasien WHERE id='$id'";

		// execute the query
		return $this->execute($query);
	}

	// insert pasien
	function createPasien($data) {
		// make query
		$query = "INSERT INTO pasien VALUES (null, '" . $data->getNik() . "', '" . $data->getNama() . "', '" . $data->getTempat() . "', '" . $data->getTl() . "', '" . $data->getGender() . "', '" . $data->getEmail() . "', '" . $data->getTelp() . "')";

		// execute the query
		return $this->execute($query);
	}

	// update pasien
	function updatePasien($data) {
		// make query
		$query = "UPDATE pasien SET nik='" . $data->getNik() . "', nama='" . $data->getNama() . "', tempat='" . $data->getTempat() . "', tl='" . $data->getTl() . "', gender='" . $data->getGender() . "', email='" . $data->getEmail() . "', telp='" . $data->getTelp() . "' WHERE id='" . $data->getId() . "'";

		// execute the query
		return $this->execute($query);
	}

	// delete pasien
	function deletePasien($id) {
		// make query
		$query = "DELETE FROM pasien WHERE id='$id'";

		// execute the query
		return $this->execute($query);
	}
}
