<?php

include("KontrakPresenter.php");


class ProsesPasien implements KontrakPresenter
{
	private $tabelpasien;
	private $data = [];

	function __construct()
	{
		//konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_01"; // nama basis data
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); //instansi TabelPasien
			$this->data = array(); //instansi list untuk data Pasien
			//data = new ArrayList<Pasien>;//instansi list untuk data Pasien
		} catch (Exception $e) {
			echo "wiw error" . $e->getMessage();
		}
	}

	function prosesDataPasien()
	{
		try {
			//mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasien();
			while ($row = $this->tabelpasien->getResult()) {
				//ambil hasil query
				$pasien = new Pasien(); //instansiasi objek pasien untuk setiap data pasien
				$pasien->setId($row['id']); //mengisi id
				$pasien->setNik($row['nik']); //mengisi nik
				$pasien->setNama($row['nama']); //mengisi nama
				$pasien->setTempat($row['tempat']); //mengisi tempat
				$pasien->setTl($row['tl']); //mengisi tl
				$pasien->setGender($row['gender']); //mengisi gender
				$pasien->setEmail($row['email']); // mengisi email
				$pasien->setTelp($row['telp']);

				$this->data[] = $row; //tambahkan data pasien ke dalam list
			}
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error part 2" . $e->getMessage();
		}
	}
	// insert pasien
	public function createPasien($data) {
		try {
			$pasien = new Pasien();
			$pasien->setNik($data['nik']);
			$pasien->setNama($data['nama']);
			$pasien->setTempat($data['tempat']);
			$pasien->setTl($data['tl']);
			$pasien->setGender($data['gender']);
			$pasien->setEmail($data['email']);
			$pasien->setTelp($data['telp']);

			$this->tabelpasien->open();
			$this->tabelpasien->createPasien($pasien);
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//throw $e;
			echo "wiw error part 3" .$e->getMessage();
		}
	}
	// get spesific pasien
	public function findPasien($id) {
		try {
			$this->tabelpasien->open();	// open db
			$this->tabelpasien->findPasien($id); // get the record
			
			$data = $this->tabelpasien->getResult();
			//ambil hasil query
			$pasien = new Pasien(); //instansiasi objek pasien untuk setiap data pasien
			$pasien->setId($data['id']); //mengisi id
			$pasien->setNik($data['nik']); //mengisi nik
			$pasien->setNama($data['nama']); //mengisi nama
			$pasien->setTempat($data['tempat']); //mengisi tempat
			$pasien->setTl($data['tl']); //mengisi tl
			$pasien->setGender($data['gender']); //mengisi gender
			$pasien->setEmail($data['email']); // mengisi email
			$pasien->setTelp($data['telp']); // mengisi telepon

			$this->data[] = $data; //tambahkan data pasien ke dalam list

			$this->tabelpasien->close();
		} catch (Exception $e) {
			//throw $e;
			echo "wiw error part 4" .$e->getMessage();
		}
	}
	public function updatePasien($data) {
		try {
			$pasien = new Pasien();	// initialization pasien object
			$pasien->setId($data['id']); // fill id field
			$pasien->setNik($data['nik']);	// fill nik field
			$pasien->setNama($data['nama']);	// fill nama field
			$pasien->setTempat($data['tempat']); // fill tempat field
			$pasien->setTl($data['tl']);	// fill tl field
			$pasien->setGender($data['gender']); // fill gender field
			$pasien->setEmail($data['email']); // fill email field
			$pasien->setTelp($data['telp']); // fill telp field

			$this->tabelpasien->open();	// open db
			$this->tabelpasien->updatePasien($pasien); // update record
			$this->tabelpasien->close(); // close db
		} catch (Exception $e) {
			//throw $e;
			echo "wiw error part 5" . $e->getMessage();
		}
	}
	public function deletePasien($id) {
		try {
			$this->tabelpasien->open(); // open db
			$this->tabelpasien->deletePasien($id); // delete record
			$this->tabelpasien->close(); // close db
		} catch (Exception $e) {
			//throw $e;
			echo "wiw error part 6" . $e->getMessage();
		}
	}
	function getId($i)
	{
		//mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]['id'];
	}
	function getNik($i)
	{
		//mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]['nik'];
	}
	function getNama($i)
	{
		//mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]['nama'];
	}
	function getTempat($i)
	{
		//mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]['tempat'];
	}
	function getTl($i)
	{
		//mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]['tl'];
	}
	function getGender($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['gender'];
	}
	function getEmail($i)
	{
		//mengembalikan email Pasien dengan indeks ke i
		return $this->data[$i]['email'];
	}
	function getTelp($i)
	{
		//mengembalikan telepon Pasien dengan indeks ke i
		return $this->data[$i]['telp'];
	}
	function getSize()
	{
		return sizeof($this->data);
	}
}
