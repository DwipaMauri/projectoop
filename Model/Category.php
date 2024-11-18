<?php
require(__DIR__ . '/../Config/init.php');

class Category extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('categories');
    }

    // Ambil semua kategori
    public function getAllCategories()
    {
        return $this->db->selectData($this->tableName, null);
    }

    // Ambil kategori berdasarkan ID
    public function getCategoryById($id)
    {
        return $this->db->selectData($this->tableName, ['id' => $id]);
    }

    // Buat kategori baru
    public function createCategory($data)
    {
        return $this->db->insertData($this->tableName, $data);
    }

    // Update kategori
    public function updateCategory($id, $data)
    {
        return $this->db->updateData($this->tableName, $id, $data);
    }

    // Hapus kategori
    public function destroy($id)
    {
        return $this->db->deleteRecord($this->tableName, $id);
    }

    // Restore kategori
    public function restoreCategory($id)
    {
        return $this->db->restoreRecord($this->tableName, $id);
    }
}
