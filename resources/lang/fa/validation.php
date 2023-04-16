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

    'accepted' => 'فیلد :attribute باید پذیرفته شود.',
    'accepted_if' => 'اگر :other برابر :value باشد، آنگاه باید :attribute را بپذیرید.',
    'active_url' => 'فیلد :attribute باید از جنس آدرس باشد.',
    'after' => 'فیلد :attribute باید پس از تاریخ :date باشد.',
    'after_or_equal' => 'فیلد :attribute باید پس از تاریخ :date باشد.',
    'alpha' => 'فیلد :attribute باید از جنس حروف باشد.',
    'alpha_dash' => 'فیلد :attribute باید از جنس حروف یا اعداد یا خط تیره باشد.',
    'alpha_num' => 'فیلد :attribute باید از جنس حروف یا اعداد باشد.',
    'array' => 'فیلد :attribute باید از جنس آرایه باشد.',
    'before' => 'فیلد :attribute باید پیش از تاریخ :date باشد.',
    'before_or_equal' => 'فیلد :attribute باید پیش از تاریخ :date باشد.',
    'between' => [
        'array' => 'فیلد :attribute میتواند :min تا :max عضو داشته باشد.',
        'file' => 'حجم فایل :attribute باید بین :min تا :max کیلوبایت باشد.',
        'numeric' => 'عدد :attribute باید مابین :min و :max باشد.',
        'string' => 'طول رشته :attribute حداقل :min و حداکثر :max کاراکتر میتواند باشد.',
    ],
    'boolean' => 'فیلد :attribute باید از جنس بولین باشد.',
    'confirmed' => 'فیلد :attribute مورد پذیرش واقع نشده است.',
    'current_password' => 'رمز عبور نامعتبر است.',
    'date' => 'فیلد :attribute باید از جنس تاریخ باشد.',
    'date_equals' => 'فیلد :attribute با تاریخ :date تطابق ندارد.',
    'date_format' => 'فیلد :attribute باید به فرمت :format ارسال شود.',
    'declined' => 'فیلد :attribute باید رد شود.',
    'declined_if' => 'اگر :other برابر :value باشد، آنگاه باید فیلد :attribute را رد کنید.',
    'different' => 'فیلد :attribute و :other با یکدیگر تطابق ندارند.',
    'digits' => 'فیلد :attribute باید از بین اعداد :digits انتخاب شود.',
    'digits_between' => 'فیلد :attribute باید مابین اعداد :min و :max باشد.',
    'dimensions' => 'فیلد :attribute دارای ابعاد نامعتبر است.',
    'distinct' => 'فیلد :attribute دارای مقدار تکراری است.',
    'doesnt_end_with' => 'فیلد :attribute باید با یکی از مقادیر :values خاتمه یابد.',
    'doesnt_start_with' => 'فیلد :attribute باید با یکی از مقادیر :values شروع شود.',
    'email' => 'فیلد :attribute باید یک آدرس ایمیل معتبر باشد.',
    'ends_with' => 'فیلد :attribute باید با یکی از مقادیر :values خاتمه یابد.',
    'enum' => 'فیلد :attribute نامعتبر است.',
    'exists' => 'فیلد :attribute نامعتبر است.',
    'file' => 'فیلد :attribute باید یک فایل باشد.',
    'filled' => 'فیلد :attribute باید پر شود.',
    'gt' => [
        'array' => 'تعداد اعضای فیلد :attribute باید بیشتر از :value باشد.',
        'file' => 'حجم فایل :attribute باید بیشتر از :value کیلوبایت باشد.',
        'numeric' => 'عدد :attribute باید بزرگتر از :value باشد.',
        'string' => 'طول رشته :attribute باید بلندتر از :value کاراکتر باشد.',
    ],
    'gte' => [
        'array' => 'تعداد اعضای فیلد :attribute باید بیشتر از :value باشد.',
        'file' => 'حجم فایل :attribute باید بیشتر از :value کیلوبایت باشد.',
        'numeric' => 'عدد :attribute باید بزرگتر از :value باشد.',
        'string' => 'طول رشته :attribute باید بلندتر از :value کاراکتر باشد.',
    ],
    'image' => 'فایل :attribute باید یک تصویر باشد.',
    'in' => 'فیلد :attribute نامعتبر است.',
    'in_array' => 'فیلد :attribute باید از بین :other انتخاب شود.',
    'integer' => 'فیلد :attribute باید عدد باشد.',
    'ip' => 'فیلد :attribute باید آدرس IP باشد.',
    'ipv4' => 'فیلد :attribute باید آدرس IPv4 باشد.',
    'ipv6' => 'فیلد :attribute باید آدرس IPv6 باشد.',
    'json' => 'فیلد :attribute باید JSON باشد.',
    'lowercase' => 'فیلد :attribute باید با حروف کوچک ارسال شود.',
    'lt' => [
        'array' => 'تعداد اعضای فیلد :attribute باید کمتر از :value باشد.',
        'file' => 'حجم فایل :attribute باید کمتر از :value کیلوبایت باشد.',
        'numeric' => 'عدد :attribute باید کوچکتر از :value باشد.',
        'string' => 'طول رشته :attribute باید کوتاهتر از :value کاراکتر باشد.',
    ],
    'lte' => [
        'array' => 'تعداد اعضای فیلد :attribute باید کمتر از :value باشد.',
        'file' => 'حجم فایل :attribute باید کمتر از :value کیلوبایت باشد.',
        'numeric' => 'عدد :attribute باید کوچکتر از :value باشد.',
        'string' => 'طول رشته :attribute باید کوتاهتر از :value کاراکتر باشد.',
    ],
    'mac_address' => 'فیلد :attribute باید MAC آدرس باشد.',
    'max' => [
        'array' => 'فیلد :attribute حداکثر :max عضو را میپذیرد.',
        'file' => 'حجم فایل :attribute حداکثر :max کیلوبایت میتواند باشد.',
        'numeric' => 'فیلد :attribute حداکثر میتواند :max باشد.',
        'string' => 'طول رشته :attribute حداکثر میتواند :max کاراکتر باشد.',
    ],
    'max_digits' => 'فیلد :attribute حداکثر میتواند عدد :max را بپذیرید.',
    'mimes' => 'فایل :attribute فرمت های :values را میپذیرد.',
    'mimetypes' => 'فایل :attribute فرمت های :values را میپذیرد.',
    'min' => [
        'array' => 'فیلد :attribute حداقل :min عضو را میپذیرد.',
        'file' => 'حجم فایل :attribute حداقل :min کیلوبایت میتواند باشد.',
        'numeric' => 'فیلد :attribute حداقل میتواند :min باشد.',
        'string' => 'طول رشته :attribute حداقل میتواند :min کاراکتر باشد.',
    ],
    'min_digits' => 'فیلد :attribute حداقل میتواند عدد :min باشد.',
    'multiple_of' => 'فیلد :attribute باید مضرب :value باشد.',
    'not_in' => 'فیلد :attribute نامعتبر است.',
    'not_regex' => 'فیلد :attribute نامعتبر است.',
    'numeric' => 'فیلد :attribute باید عدد باشد.',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'فیلد :attribute باید ارسال شود.',
    'prohibited' => 'فیلد :attribute ممنوع است.',
    'prohibited_if' => 'اگر :other برابر :value باشد، آنگاه فیلد :attribute ممنوع است.',
    'prohibited_unless' => 'فیلد :attribute تنها در حالتی مجاز است که :other یکی از مقادیر :values باشد.',
    'prohibits' => 'فیلد :attribute حضور :other را ممنوع می کند.',
    'regex' => 'فیلد :attribute نامعتبر است.',
    'required' => 'فیلد :attribute اجباری است.',
    'required_array_keys' => 'فیلد :attribute باید حاوی کلیدهای :values باشد.',
    'required_if' => 'اگر :other برابر :value باشد، آنگاه فیلد :attribute اجباری است.',
    'required_if_accepted' => 'اگر :other پذیرفته شده باشد، آنگاه فیلد :attribute اجباری است.',
    'required_unless' => 'اگر فیلد :other یکی از مقادیر :values نباشد، آنگاه فیلد :attribute اجباری است.',
    'required_with' => 'هرگاه یکی از فیلدهای :values ارسال شود، فیلد :attribute هم باید ارسال شود.',
    'required_with_all' => 'هرگاه همه فیلدهای :values ارسال میشوند، فیلد :attribute هم باید ارسال شود.',
    'required_without' => 'هرگاه یکی از فیلدهای :values ارسال نشود، فیلد :attribute باید ارسال شود.',
    'required_without_all' => 'هرگاه هیچ کدام از :values ارسال نشود، فیلد :attribute باید ارسال شود.',
    'same' => 'فیلد :attribute و :other تطابق ندارند.',
    'size' => [
        'array' => 'آرایه :attribute باید :size عضو داشته باشد.',
        'file' => 'فایل :attribute باید :size کیلوبایت باشد.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'رشته :attribute باید :size کاراکتر داشته باشد.',
    ],
    'starts_with' => 'فیلد :attribute باید با :values آغاز شود.',
    'string' => 'فیلد :attribute باید از جنس رشته باشد.',
    'timezone' => 'فیلد :attribute باید یک timezone معتبر باشد.',
    'unique' => 'فیلد :attribute قبلا ثبت شده است.',
    'uploaded' => 'The :attribute failed to upload.',
    'uppercase' => 'فیلد :attribute باید با حروف بزرگ ارسال شود.',
    'url' => 'فیلد :attribute باید یک آدرس معتبر باشد.',
    'uuid' => 'The :attribute must be a valid UUID.',

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
    'invalid' => 'فیلد :attribute نامعتبر است.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
