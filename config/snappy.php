<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => 'C:/wkhtmltopdf/bin/wkhtmltopdf.exe',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => base_path('vendor\fishmad\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf.exe'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
