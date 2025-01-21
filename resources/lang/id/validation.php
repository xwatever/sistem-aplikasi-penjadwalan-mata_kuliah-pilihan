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

    'accepted' => ':attribute harus diterima.',
    'active_url' => ':attribute bukan merupakan URL yang valid.',
    'after' => ':attribute harus berada pada tanggal setelah tanggal :date.',
    'after_or_equal' => ':attribute harus berada pada tanggal setelah atau sama dengan tanggal :date.',
    'alpha' => ':attribute harus memiliki huruf-huruf.',
    'alpha_dash' => ':attribute harus hanya memiliki huruf-huruf, angka, garis strip, dan garis bawah.',
    'alpha_num' => ':attribute harus hanya memiliki huruf-huruf, dan angka.',
    'array' => ':attribute harus merupakan suatu array.',
    'before' => ':attribute harus berada pada tanggal sebelum tanggal :date.',
    'before_or_equal' => ':attribute harus berada pada tanggal sebelum atau sama dengan tanggal :date.',
    'between' => [
        'numeric' => ':attribute harus berada diantara :min dan :max.',
        'file' => ':attribute harus berada diantara :min dan :max banyak kilobyte.',
        'string' => 'attribute harus berada diantara :min dan :max banyak karakter.',
        'array' => 'attribute harus berada diantara :min dan :max banyak item.',
    ],
    'boolean' => ':attribute harus bernilai "true" atau "false".',
    'confirmed' => 'konfirmasi :attribute tidak cocok.',
    'date' => ':attribute bukan merupakan tanggal yang valid.',
    'date_equals' => ':attribute harus merupakan sebuah tanggal yang sama seperti :date.',
    'date_Format' => ':attribute tidak sama dengan Format tanggal seperti :Format.',
    'different' => ':attribute dan :other harus berbeda.',
    'digits' => ':attribute harus berdigit :digits.',
    'digits_between' => ':attribute harus berada diantara :min dan :max banyak digit.',
    'dimensions' => ':attribute mempunyai dimensi gambar yang tidak valid.',
    'distinct' => ':attribute mempunyai nilai yang sama dengan yang lain.',
    'email' => ':attribute harus merupakan address email yang valid.',
    'ends_with' => ':attribute harus diakhiri dengan salah satu bentuk seperti: :values.',
    'exists' => ':attribute yang dimaksud tidak valid.',
    'file' => ':attribute harus sebuah file.',
    'filled' => ':attribute harus memiliki sebuah nilai.',
    'gt' => [
        'numeric' => ':attribute harus bernilai lebih dari :value.',
        'file' => ':attribute harus memiliki kilobyte lebih dari :value.',
        'string' => ':attribute harus memiliki panjang karakter lebih dari :value.',
        'array' => ':attribute harus memiliki item yang lebih dari :value.',
    ],
    'gte' => [
        'numeric' => ':attribute harus bernilai lebih dari atau sama dengan :value.',
        'file' => ':attribute harus memiliki kilobyte lebih dari atau sama dengan :value.',
        'string' => ':attribute harus memiliki panjang karakter lebih dari atau sama dengan :value.',
        'array' => ':attribute harus memiliki item yang lebih dari atau sama dengan :value.',
    ],
    'image' => ':attribute harus sebuah gambar.',
    'in' => ':attribute yang dimaksud tidak valid.',
    'in_array' => ':attribute tidak ditemukan di :other.',
    'integer' => ':attribute harus sebuah angka.',
    'ip' => ':attribute harus merupakan address IP yang valid.',
    'ipv4' => ':attribute harus merupakan address IPv4 yang valid.',
    'ipv6' => ':attribute harus merupakan address IPv6 yang valid.',
    'json' => ':attribute harus merupakan string JSON yang valid.',
    'lt' => [
        'numeric' => ':attribute harus bernilai kurang dari :value.',
        'file' => ':attribute harus memiliki kilobyte kurang dari :value.',
        'string' => ':attribute harus memiliki panjang karakter kurang dari :value.',
        'array' => ':attribute harus memiliki item yang kurang dari :value.',
    ],
    'lte' => [
        'numeric' => ':attribute harus bernilai kurang dari atau sama dengan :value.',
        'file' => ':attribute harus memiliki kilobyte yang kurang dari atau sama dengan :value.',
        'string' => ':attribute harus memiliki panjang karakter kurang dari atau sama dengan :value.',
        'array' => ':attribute harus memiliki item yang kurang dari atau sama dengan :value.',
    ],
    'max' => [
        'numeric' => ':attribute harus bernilai tidak lebih besar dari :max.',
        'file' => ':attribute harus memiliki kilobyte tidak lebih besar dari :max.',
        'string' => ':attribute harus memiliki panjang karakter tidak lebih besar dari :max.',
        'array' => ':attribute harus memiliki item yang tidak lebih besar dari :max.',
    ],
    'mimes' => ':attribute harus tipe dari sebuah file, seperti: :values.',
    'mimetypes' => ':attribute harus tipe dari sebuah file, seperti :values.',
    'min' => [
        'numeric' => ':attribute harus bernilai setidaknya :min atau lebih besar lagi.',
        'file' => ':attribute harus memiliki kilobyte setidaknya :min atau lebih besar lagi.',
        'string' => ':attribute harus memiliki panjang karakter setidaknya :min atau lebih besar lagi.',
        'array' => ':attribute harus memiliki item yang setidaknya :min atau lebih besar lagi.',
    ],
    'not_in' => ':attribute yang dipilih tidak valid.',
    'not_regex' => 'Format dari :attribute tidak valid.',
    'numeric' => ':attribute harus berupa sebuah angka.',
    'password' => 'password yang dimasukkan salah.',
    'present' => ':attribute harus diterima, tidak boleh kosong.',
    'regex' => 'Format dari :attribute tidak valid.',
    'required' => ':attribute diperlukan, tidak boleh kosong.',
    'required_if' => ':attribute diperlukan ketika :other bernilai sama dengan :value.',
    'required_unless' => ':attribute diperlukan ketika :other bernilai sama didalam :values.',
    'required_with' => ':attribute diperlukan ketika :values diterima.',
    'required_with_all' => ':attribute diperlukan ketika :values diterima.',
    'required_without' => ':attribute diperlukan ketika :values kosong atau tidak diterima.',
    'required_without_all' => ':attribute diperlukan ketika :values kosong atau tidak diterima.',
    'same' => ':attribute dan :other harus cocok',
    'size' => [
        'numeric' => ':attribute harus bernilai :size.',
        'file' => ':attribute harus memiliki kilobyte sebesar :size.',
        'string' => ':attribute harus memiliki panjang karakter sebesar :size.',
        'array' => ':attribute  harus memiliki item sebesar :size.',
    ],
    'starts_with' => ':attribute harus diawali dengan salah satu dari yang bisa diterima, yaitu: :values.',
    'string' => ':attribute harus bernilai kalimat atau teks.',
    'timezone' => ':attribute harus merupakan zona waktu yang valid.',
    'unique' => ':attribute sudah digunakan.',
    'unique_with' => 'Kombinasi dari :fields sudah ada.',
    'uploaded' => ':attribute gagal untuk diupload.',
    'url' => 'Format dari :attribute harus valid.',
    'uuid' => 'UUID dari :attribute harus valid.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
