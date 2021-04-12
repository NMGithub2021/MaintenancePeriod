<?php
return (function(){
        $intGT0 = '[1-9]+\d*';
        $normUrl = '[0-9aA-zZ_-]+';

        return [
            [
                'test' => '/^$/',
                'controller' => 'articles/all'
            ],
            [
                'test' => "/^remove_category\/($intGT0)\/?$/",
                'controller' => 'categories/remove',
                'params' => ['id' => 1]
            ]
        ];
    })();