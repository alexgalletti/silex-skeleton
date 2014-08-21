<?php

use Silex\Application;

$app['controllers']->value('locale', 'en');

$app->match('{locale}', function (Application $app) {
    return $app['twig']->render('index.twig');
});
