
<?php

require(__DIR__ . '/../Config/init.php');

class Cake extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('cakes');
    }

    public function getAllCakes()
    {
        return $this->db->selectData($this->tableName, null);
    }

    public function getCakeById($id)
    {
        return $this->db->selectData($this->tableName, $id);
    }

    public function createCake($data)
    {
        $cakeData = [
            'cake_name' => $data['cake_name'],
            'category_id' => $data['category_id'], // Foreign key
            'price' => $data['price'],
            'stock' => $data['stock'], // Include stock
            'isDeleted' => 0 // Assuming new products are not deleted
        ];
        return $this->db->insertData($this->tableName, $cakeData);
    }

    public function updateCake($id, $data)
    {
        $cakeData = [
            'cake_name' => $data['cake_name'],
            'category_id' => $data['category_id'], // Foreign key
            'price' => $data['price'],
            'stock' => $data['stock'] // Include stock
        ];
        return $this->db->updateData($this->tableName, $id, $cakeData);
    }

    public function deleteCake($id)
    {
        return $this->db->deleteRecord($this->tableName, $id);
    }

    public function restoreCake($id)
    {
        return $this->db->restoreRecord($this->tableName, $id);
    }
}
