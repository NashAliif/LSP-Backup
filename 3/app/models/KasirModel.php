<?php

class KasirModel
{
    private static $table = 'kasir';

    public static function login($data)
    {
        $username = $data['username'];
        $password = $data['password'];

        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table . " WHERE username = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password === $row['password']) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['id_kasir'] = $row['id_kasir'];
                $_SESSION['username'] = $row['username'];
                return true;
            }
        }

        return false;
    }

    public static function getAllKasir()
    {
        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table;
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getKasirById($id)
    {
        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table . ' WHERE id = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function create($data)
    {
        $id_kasir = $data['id_kasir'];
        $username = $data['username'];
        $password = $data['password'];
        $namaKasir = $data['nama_kasir'];
        $alamat = $data['alamat'];
        $nomorHP = $data['nomor_hp'];
        $nomorKTP = $data['nomor_ktp'];

        $conn = Database::getConnection();
        $query = "INSERT INTO " . self::$table . " (username, password, nama_kasir, alamat, nomor_hp, nomor_ktp, id_kasir) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssssi', $username, $password, $namaKasir, $alamat, $nomorHP, $nomorKTP, $id_kasir);
        return $stmt->execute();
    }

    public static function updateKasir($data)
    {
        $id_kasir = $data['id_kasir'];
        $username = $data['username'];
        $password = $data['password'];
        $namaKasir = $data['nama_kasir'];
        $alamat = $data['alamat'];
        $nomorHP = $data['nomor_hp'];
        $nomorKTP = $data['nomor_ktp'];

        $conn = Database::getConnection();
        $query = "UPDATE " . self::$table . " SET username = ?, password = ?, nama_kasir = ?, alamat = ?, nomor_hp = ?, nomor_ktp = ? WHERE id_kasir = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssssi', $username, $password, $namaKasir, $alamat, $nomorHP, $nomorKTP, $id_kasir);
        return $stmt->execute();
    }

    public static function deleteKasir($id)
    {
        $conn = Database::getConnection();
        $query = "DELETE FROM " . self::$table . " WHERE id_kasir = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public static function search($data)
    {
        $keyword = "%" . $data['keyword'] . "%";
        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table . " WHERE username LIKE ? OR role LIKE ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $keyword, $keyword);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}