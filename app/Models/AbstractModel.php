<?php
namespace App\Models;

use App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

abstract class AbstractModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $errors = null, $editableFields = [], $rules = array();

    protected function getEditableFields()
    {
        return $this->editableFields;
    }

    /**
     * Validate data when update or create.
     * @param $data: ['field_1' => 'value_1', 'field_2' => 'value_2'].
     * @param $rules: the rules to validate.
     * @param $justUpdateSomeFields: if true, just validate items that exists in $data.
     * @return bool
     **/
    public function validateData($data, $rules = null, $justUpdateSomeFields = false)
    {
        if(!$rules) $rules = $this->rules;
        $result = Validator::make($data, $rules);
        if($result->fails())
        {
            $this->errors = $result->messages()->toArray();
            if($justUpdateSomeFields == true)
            {
                $messages = [];
                foreach($data as $key => $row)
                {
                    if(array_key_exists($key, $this->errors))
                    {
                        $messages[$key] = $this->errors[$key];
                    }
                }
                $this->errors = $messages;
                if(sizeof($this->errors) > 0) return false;
                return true;
            }
            return false;
        }
        return true;
    }

    /**
     * Get all validate errors, no key.
     * @return array
     **/
    public function getErrors()
    {
        $messages = [];
        foreach($this->errors as $key => $row)
        {
            foreach($row as $keyRow => $valueRow)
            {
                array_push($messages, $valueRow);
            }
        }
        return $messages;
    }

    /**
     * Get all validate errors, with the key of errors.
     * @return array
     **/
    public function getErrorsWithKey()
    {
        return $this->errors;
    }

    /**
     * Get all validate errors, with error state and http response code.
     * @return array
     **/
    public function getErrorsWithResponse($code = 500)
    {
        $result = [
            'error' => false,
            'response_code' => 200
        ];
        $message = $this->getErrors();
        if($message)
        {
            $result['error'] = true;
            $result['response_code'] = $code;
            $result['message'] = $message;
        }
        return $result;
    }

    public function getMessagesWithResponse($message, $code = 200)
    {
        $result = [
            'error' => false,
            'response_code' => $code,
            'message' => $message
        ];
        return $result;
    }

    /**
     * Check if when user try to update db, but values are not changed
     * @return bool
     **/
    public function checkValueNotChange($object, $data)
    {
        $error = $this->getErrorsWithKey();
        foreach ($data as $key => $row)
        {
            if($data[$key] && $object->{$key} == $data[$key] && array_key_exists($key, $error))
            {
                return true;
            }
        }
        return false;
    }

    public static function findByFieldsOrCreate($options)
    {
        $obj = static::where($options)->first();
        return $obj ?: new static;
    }

    public static function getAll($order = null, $perPage = 0)
    {
        $query = new static;
        if($order && is_array($order))
        {
            foreach ($order as $key => $value)
            {
                $query = $query->orderBy($key, $value);
            }
        }
        if($perPage < 1)
        {
            return $query->get();
        }
        return $query->paginate($perPage);
    }

    public static function getBy($fields, $order = null, $multiple = false, $perPage = 0, $select = null)
    {
        $obj = new static;
        $searchBy = [];
        foreach($fields as $key => $row)
        {
            $current = [
                'compare' => '=',
                'value' => $row
            ];
            $searchBy[$key] = $current;
        }
        return $obj->searchBy($searchBy, $order, $multiple, $perPage, $select);
    }

    public static function searchBy($fields, $order = null, $multiple = false, $perPage = 0, $select = null)
    {
        $obj = new static;
        if($fields && is_array($fields))
        {
            foreach($fields as $key => $row)
            {
                $obj = $obj->where(function($q) use ($key, $row){

                    if($row['compare'] == 'LIKE')
                    {
                        $q->where($key, $row['compare'], '%'.$row['value'].'%');
                    }
                    else
                    {
                        $q->where($key, $row['compare'], $row['value']);
                    }
                });
            }
        }
        if($order && is_array($order))
        {
            foreach ($order as $key => $value)
            {
                $obj = $obj->orderBy($key, $value);
            }
        }

        if($select && sizeof($select) > 0)
        {
            $obj = $obj->select($select);
        }

        if($multiple)
        {
            if ($perPage > 0) return $obj->paginate($perPage);
            return $obj->get();
        }
        return $obj->first();
    }

    public function fastEdit($data, $allowCreateNew = false, $justUpdateSomeFields = false)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!'
        ];

        if(!isset($data['id']) || !$data['id']) $data['id'] = 0;
        if($allowCreateNew != true)
        {
            $item = static::find($data['id']);
            if(!$item)
            {
                $result['response_code'] = 404;
                $result['message'] = 'Item not exists with id '.$data['id'];
                return $result;
            }
        }
        else
        {
            $item = static::findOrNew($data['id']);
        }
        $validate = $this->validateData($data, null, $justUpdateSomeFields);
        if(!$validate && !$this->checkValueNotChange($item, $data))
        {
            return $this->getErrorsWithResponse();
        }

        foreach($data as $key => $row)
        {
            if(in_array($key, $this->getEditableFields()))
            {
                $item->$key = $row;
            }
        }

        if($item->save())
        {
            $result = $this->getMessagesWithResponse('Update content completed!', 200);
            $result['object'] = $item;
        }

        return $result;
    }

    public function updateMultiple($ids, $data, $justUpdateSomeFields = false)
    {
        $validate = $this->validateData($data, null, $justUpdateSomeFields);
        if(!$validate)
        {
            return $this->getErrorsWithResponse();
        }

        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!'
        ];
        foreach($data as $key => $row)
        {
            if(!in_array($key, $this->editableFields))
            {
                unset($data[$key]);
            }
        }

        $items = static::whereIn('id', $ids);
        if($items->update($data))
        {
            $result['error'] = false;
            $result['response_code'] = 200;
            $result['message'] = [
                'Update content completed!'
            ];
        }

        return $result;
    }

    public function updateMultipleGetByFields($fields, $data, $justUpdateSomeFields = false)
    {
        $validate = $this->validateData($data, null, $justUpdateSomeFields);
        if(!$validate)
        {
            return $this->getErrorsWithResponse();
        }

        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!'
        ];
        foreach($data as $key => $row)
        {
            if(!in_array($key, $this->editableFields))
            {
                unset($data[$key]);
            }
        }

        $items = static::where($fields);
        if($items->update($data))
        {
            $result['error'] = false;
            $result['response_code'] = 200;
            $result['message'] = [
                'Update content completed!'
            ];
        }

        return $result;
    }
}