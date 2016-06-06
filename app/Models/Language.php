<?php
namespace App\Models;

use App\Models;
use App\Models\AbstractModel;

class Language extends AbstractModel
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'languages';

    protected $primaryKey = 'id';

    protected $rules = [
        'language_name' => 'required|max:255',
        'language_code' => 'required|unique:languages',
        'status' => 'integer|required|between:0,1',
    ];

    protected $editableFields = [
        'language_name',
        'language_code',
        'status',
        'default_locale',
        'currency',
    ];

    public static function getAllLanguages($status = 1)
    {
        return static::where('status', '=', $status)->get();
    }

    public static function getAllLanguageCodes()
    {
        $languages = static::getBy([
            'status' => 1,
        ], null, true);

        $results = [];
        foreach ($languages as $key => $row) {
            array_push($results, $row->language_code);
        }
        return $results;
    }

    public static function getDefaultLanguage()
    {
        $defaultLanguage = Setting::getBy([
            'option_key' => 'default_language',
        ]);
        $languageId = (int) $defaultLanguage->option_value;

        $language = static::find($languageId);
        return $language;
    }

    public static function getLanguageByCode($languageCode, $status = 1)
    {
        $language = static::getBy([
            'language_code' => $languageCode,
            'status' => $status,
        ]);
        return $language;
    }

    public static function getLanguageById($languageId, $status = 1)
    {
        $language = static::getBy([
            'id' => $languageId,
            'status' => $status,
        ]);
        return $language;
    }

    public static function getLanguageByLocale($locale, $status = 1)
    {
        $language = static::getBy([
            'default_locale' => $locale,
            'status' => $status,
        ]);
        return $language;
    }
}
