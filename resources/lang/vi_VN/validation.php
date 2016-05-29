<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Trường :attribute phải được đồng ý.',
    'active_url'           => 'Trường :attribute không phải là một URL hợp lệ.',
    'after'                => 'Trường :attribute phải là một ngày sau ngày :date.',
    'alpha'                => 'Trường :attribute chỉ được phép chứa ký tự chữ.',
    'alpha_dash'           => 'Trường :attribute chỉ được phép chứa ký tự chữ, số, và dấu gạch dưới.',
    'alpha_num'            => 'Trường :attribute chỉ được phép chứa ký tự chữ và số.',
    'array'                => 'Trường :attribute phải là một mảng.',
    'before'               => 'Trường :attribute phải là một ngày trước ngày :date.',
    'between'              => [
        'numeric' => 'Trường :attribute phải nằm giữa :min và :max.',
        'file'    => 'Trường :attribute phải nằm giữa :min và :max kilobytes.',
        'string'  => 'Trường :attribute phải nằm giữa :min và :max characters.',
        'array'   => 'Trường :attribute phải có ít nhất :min và nhiều nhất :max mục.',
    ],
    'boolean'              => 'Trường :attribute chỉ được nhận giá trị true hoặc false.',
    'confirmed'            => 'Trường :attribute chưa được xác nhận trùng khớp.',
    'date'                 => 'Trường :attribute không phải là một ngày hợp lệ.',
    'date_format'          => 'Trường :attribute phải theo đúng format :format.',
    'different'            => 'Trường :attribute và :other phải khác nhau.',
    'digits'               => 'Trường :attribute phải là :digits số.',
    'digits_between'       => 'Trường :attribute phải có ít nhất :min số và :max số.',
    'email'                => 'Trường :attribute phải là một địa chỉ email hợp lê.',
    'exists'               => 'Trường đã chọn :attribute không đúng.',
    'filled'               => 'Trường :attribute là bắt buộc.',
    'image'                => 'Trường :attribute phải là hình.',
    'in'                   => 'Trường đã chọn :attribute không đúng.',
    'integer'              => 'Trường :attribute phải là một số nguyên.',
    'ip'                   => 'Trường :attribute phải là một địa chỉ IP hợp lệ.',
    'json'                 => 'Trường :attribute phải là một chuối JSON hợp lệ.',
    'max'                  => [
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'file'    => 'Trường :attribute không được lớn hơn :max kilobytes.',
        'string'  => 'Trường :attribute không được lớn hơn :max ký tự.',
        'array'   => 'Trường :attribute không được chứa nhiều hơn :max mục.',
    ],
    'mimes'                => 'Trường :attribute phải là một file với đuôi: :values.',
    'min'                  => [
        'numeric' => 'Trường :attribute phải ít nhất là :min.',
        'file'    => 'Trường :attribute phải ít nhất là :min kilobytes.',
        'string'  => 'Trường :attribute phải ít nhất là :min ký tự.',
        'array'   => 'Trường :attribute phải có ít nhất :min mục.',
    ],
    'not_in'               => 'Trường :attribute đã chọn không đúng.',
    'numeric'              => 'Trường :attribute phải là một số.',
    'regex'                => 'Trường :attribute không đúng format.',
    'required'             => 'Trường :attribute là bắt buộc.',
    'required_if'          => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_unless'      => 'Trường :attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with'        => 'Trường :attribute là bắt buộc khi :values hiện diện.',
    'required_with_all'    => 'Trường :attribute là bắt buộc khi :values hiện diện.',
    'required_without'     => 'Trường :attribute là bắt buộc khi :values không hiện diện.',
    'required_without_all' => 'Trường :attribute là bắt buộc khi không có giá trị nào của :values hiện diện.',
    'same'                 => 'Trường :attribute và :other phải trùng khớp.',
    'size'                 => [
        'numeric' => 'Trường :attribute phải bằng :size.',
        'file'    => 'Trường :attribute phải bằng :size kilobytes.',
        'string'  => 'Trường :attribute phải bằng :size ký tự.',
        'array'   => 'Trường :attribute phải chứa :size mục.',
    ],
    'string'               => 'Trường :attribute phải là một chuối.',
    'timezone'             => 'Trường :attribute phải là một múi giờ hợp lệ.',
    'unique'               => 'Trường :attribute đã tồn tại.',
    'unique_multiple'      => 'Trường :attribute đã tồn tại.',
    'url'                  => 'Trường :attribute format không đúng.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
