<?php

/**
 * Get template for Page, Post, Category, ProductCategory
 * @return array
 **/
function _getPageTemplate($type = 'Page')
{
    $content = file_get_contents(app_path('Http/Controllers/Front/' . $type . 'Controller.php'));
    $arrTmp = explode('Template Name:', $content);
    $arrTemplate = [];
    if (count($arrTmp) > 1) {
        foreach ($arrTmp as $key => $value) {
            if ($key > 0) {
                $arrValue = explode('*/', $value);
                $arrValue = explode('-', $arrValue[0]);
                array_push($arrTemplate, trim($arrValue[0]));
            }
        }
    }
    return $arrTemplate;
}

function _getField($fields, $key) {
    if(is_array($fields) && isset($fields[$key])) return $fields[$key];
    return null;
}

function _getRepeaterField($rawField)
{
    $meta = (array)json_decode($rawField);
    return $meta;
}

function _getSubField($parentMeta, $key)
{
    if (!is_array($parentMeta)) $parentMeta = json_decode($parentMeta);
    foreach ($parentMeta as $row) {
        if ($row->slug == $key)
            return $row->field_value;
    }
    return '';
}

function _validateGoogleCaptcha($secret, $response = null)
{
    if (!$response) return false;
    $result = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response));
    return $result->success;
}

function _sendEmail($view, $data, $to = [], $cc = [], $bcc = [])
{
    return \Mail::send($view, $data, function ($message) use ($to, $cc, $bcc) {
        foreach ($to as $key => $row) {
            $message->to($row['email'], $row['name']);
        }
        foreach ($cc as $key => $row) {
            $message->cc($row['email'], $row['name']);
        }
        foreach ($bcc as $key => $row) {
            $message->bcc($row['email'], $row['name']);
        }
    });
}

function _getPostLink($currentLanguageCode, $post)
{
    return '/'.$currentLanguageCode.'/'.trans('url.post').'/'.$post->slug;
}

function _getProductLink($currentLanguageCode, $product)
{
    return '/'.$currentLanguageCode.'/'.trans('url.product').'/'.$product->slug;
}