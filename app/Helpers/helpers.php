<?php
require_once '_url.php';
require_once '_custom-fields.php';
require_once '_products.php';
require_once '_date-time.php';
require_once '_settings.php';

if (! function_exists('_getPageTemplate')) {
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
}

if (! function_exists('_validateGoogleCaptcha')) {
    function _validateGoogleCaptcha($response = null)
    {
        $secret = env('RECAPTCHA_SECRET_KEY');
        if (!$response || !$secret) {
            return false;
        }

        $result = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response));
        return $result->success;
    }
}

if (! function_exists('_sendEmail')) {
    function _sendEmail($view, $subject, $data, $to = [], $cc = [], $bcc = [])
    {
        return \Mail::send($view, $data, function ($message) use ($subject, $to, $cc, $bcc) {
            foreach ($to as $key => $row) {
                $message->to($row['email'], $row['name'])->subject($subject);
            }
            foreach ($cc as $key => $row) {
                $message->cc($row['email'], $row['name'])->subject($subject);
            }
            foreach ($bcc as $key => $row) {
                $message->bcc($row['email'], $row['name'])->subject($subject);
            }
        });
    }
}

if (! function_exists('_stripTags')) {
    function _stripTags($data, $allowTags = '<p><a><br><br/><b><strong>')
    {
        if (!is_array($data)) {
            return strip_tags($data, $allowTags);
        }
        foreach ($data as $key => $row) {
            $data[$key] = strip_tags($row, $allowTags);
        }
        return $data;
    }
}