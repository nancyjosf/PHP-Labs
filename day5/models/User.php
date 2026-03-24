<?php

namespace App\Models;

use Config\Database;
use PDO;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data)
    {
        $query = "INSERT INTO users (name, first_name, last_name, address, country, gender, skills, username, password, email, profile_picture)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);
        return $stmt->execute(array_values($data));
    }

    public function emailExists($email)
    {
        $stmt = $this->db->prepare("SELECT 1 FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        return (bool) $stmt->fetchColumn();
    }

    public function emailExistsForOtherUser($email, $id)
    {
        $stmt = $this->db->prepare("SELECT 1 FROM users WHERE email = ? AND id != ? LIMIT 1");
        $stmt->execute([$email, $id]);
        return (bool) $stmt->fetchColumn();
    }

    public function existsByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT 1 FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        return (bool) $stmt->fetchColumn();
    }

    public function getAll($search = null)
    {
        if ($search) {
            $term = "%$search%";
            $query = "SELECT * FROM users
                      WHERE name LIKE ? OR email LIKE ? OR username LIKE ?
                      ORDER BY id DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$term, $term, $term]);
        } else {
            $stmt = $this->db->query("SELECT * FROM users ORDER BY id DESC");
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $fields = [];
        $values = [];

        foreach ($data as $column => $value) {
            $fields[] = "$column = ?";
            $values[] = $value;
        }

        $values[] = $id;
        $query = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
        return $this->db->prepare($query)->execute($values);
    }

    public function delete($id)
    {
        return $this->db->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
    }

    public function findByEmailAndPassword($email, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1");
        $stmt->execute([$email, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}