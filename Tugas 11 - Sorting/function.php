<?php
//error_reporting(E_ALL ^ E_NOTICE || E_WARNING);
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "mahasiswa");

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data)
{
	//ambil data dari tiap elemen dalam form\
	//htmlspecialchars untuk seleksi div
	global $conn; // connect database
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jk = htmlspecialchars($data["jk"]);
	$tempatLahir = htmlspecialchars($data["tempat-lahir"]);
	$tglLahir = htmlspecialchars($data["tgl-lahir"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$fakultas = htmlspecialchars($data["fakultas"]);

	// query insert data
	$query = "INSERT INTO mahasiswa(idMhs,nim,nama,jenisKelamin,tempatLahir,tglLahir,alamat,email,fakultas)
				VALUES
			('', '$nim', '$nama', '$jk', '$tempatLahir', '$tglLahir', '$alamat', '$email', '$fakultas')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE idMhs = $id");

	return mysqli_affected_rows($conn);
}

function ubah($data)
{
	global $conn; // connect database

	$id = $data["idMhs"];
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jk = htmlspecialchars($data["jk"]);
	$tempatLahir = htmlspecialchars($data["tempat-lahir"]);
	$tglLahir = htmlspecialchars($data["tgl-lahir"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$fakultas = htmlspecialchars($data["fakultas"]);

	// query insert data
	$query = "UPDATE mahasiswa SET
	nim = '$nim',
	nama = '$nama',
	email = '$email',
	jenisKelamin = '$jk',
	tempatLahir = '$tempatLahir',
	tglLahir = '$tglLahir',
	alamat = '$alamat',
	fakultas = '$fakultas'
	WHERE idMhs = $id
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari($keyword)
{
	$query = "SELECT * FROM mahasiswa WHERE
	nama LIKE '%$keyword%' OR
	nim LIKE '%$keyword%' OR
	email LIKE '%$keyword%' OR
	jurusan LIKE '%$keyword%' OR
	fakultas LIKE '%$keyword%'
	";
	return query($query);
}
