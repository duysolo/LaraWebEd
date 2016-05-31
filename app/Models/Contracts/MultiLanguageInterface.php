<?php
namespace App\Models\Contracts;

interface MultiLanguageInterface
{
    public static function getWithContent();

    public static function getById($id, $languageId);

    public static function getContentById($id, $languageId);

    public function createItem($languageId, $data);

    public function updateItem($id, $data);

    public function updateItemContent($id, $languageId, $data);

    public static function deleteItem($id);
}
