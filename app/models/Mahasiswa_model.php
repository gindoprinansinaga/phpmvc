<?php

class Mahasiswa_model
{
    // databse handler
    private $dbh;
    private $stmt;

    public function __construct()
    {
        // data source name
        $dsn = 'mysql:host=localhost;dbname=phpmvc';

        try {
            $this->dbh = new PDO($dsn, 'root', '');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // private $mhs = [
    //     [
    //         "nama" => "Gindo Prinando Sinaga",
    //         "nim" => "30210309",
    //         "email" => "tester@gindops.com",
    //         "jurusan" => "Teknik Komputer"
    //     ],
    //     [
    //         "nama" => "John Doe",
    //         "nim" => "30220308",
    //         "email" => "johndoe@gindops.com",
    //         "jurusan" => "Teknik Mesin"
    //     ],
    //     [
    //         "nama" => "Fulan",
    //         "nim" => "30230389",
    //         "email" => "fulan@gindops.com",
    //         "jurusan" => "Teknik Kimia"
    //     ]
    // ];

    public function getAllMahasiswa()
    {
        $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
