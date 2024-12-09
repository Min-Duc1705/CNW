<?php
require_once __DIR__ . "/../Models/NewsModel.php";

class NewsController {
    private $model;

    public function __construct($db) {
        $this->model = new NewsModel($db);
    }

    public function listNews() {
        return $this->model->getAllNews();
    }

    public function createNews($title, $content, $image, $category_id) {
        return $this->model->addNews($title, $content, $image, $category_id);
    }

    public function editNews($id, $title, $content, $image, $category_id) {
        return $this->model->updateNews($id, $title, $content, $image, $category_id);
    }

    public function removeNews($id) {
        return $this->model->deleteNews($id);
    }

    // Phương thức gọi getNewsById từ NewsModel
    public function getNewsById($id) {
        return $this->model->getNewsById($id);
    }
}
?>
