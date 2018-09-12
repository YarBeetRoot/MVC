<?php

return [
    'news/([a-zA-Z]+)/([0-9]+)' => 'news/detail/$2',
    'news/([a-zA-Z]+)' => 'news/index/$1',
    'news' => 'news/index',
    'addcomment/([0-9]+)' => 'comments/addcomment/$1',
    'search' => 'search/index',
    'contacts/sendMail' => 'contacts/sendMail',
    'contacts' => 'contacts/index',
    '^\s*$' => 'home/index',
];