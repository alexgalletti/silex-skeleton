<?php

use Silex\Application;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Response;

/**
 * Example of using Swiftmailer
 */
$app->match('/swiftmailer', function (Application $app) {
    $message = \Swift_Message::newInstance()
        ->setSubject('[YourSite] Feedback')
        ->setFrom(['noreply@yoursite.com'])
        ->setTo(['feedback@yoursite.com'])
        ->setBody('Some feedback...');

    if ($app['mailer']->send($message)) {
        return $app->json(['sent' => true]);
    }

    $app->abort(500, 'There was an error sending the email');
});

/**
 * Basic validation example
 */
$app->match('/validate', function (Application $app) {
    $book = [
        'title' => 'My Book',
        'author' => [
            'first_name' => 'Fabien',
            'last_name'  => 'Potencier',
        ],
    ];

    $constraint = new Assert\Collection([
        'title' => new Assert\Length(['min' => 5]),
        'author' => new Assert\Collection([
            'first_name' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 10])
            ],
            'last_name'  => new Assert\Length(['min' => 10]),
        ]),
    ]);

    $errors = $app['validator']->validateValue($book, $constraint);

    $messages = [];

    foreach ($errors as $error) {
        $messages[] = $error->getPropertyPath().' '.$error->getMessage();
    }

    return $app->json($messages);
});

/**
 * Basic authentication login with session support
 */
$app->get('/login', function () use ($app) {
    $username = $app['request']->server->get('PHP_AUTH_USER', false);
    $password = $app['request']->server->get('PHP_AUTH_PW');

    if ('username' === $username && 'password' === $password) {
        $app['session']->set('user', array('username' => $username));
        return $app->redirect('account');
    }

    $response = new Response();
    $response->headers->set('WWW-Authenticate', sprintf('Basic realm="%s"', 'Protected Area'));
    $response->setStatusCode(401, 'Please sign in.');
    return $response;
});

$app->get('/account', function () use ($app) {
    if (null === $user = $app['session']->get('user')) {
        return $app->redirect('login');
    }

    return sprintf('Welcome %s!', $user['username']);
});

/**
 * Simple Twig template example with URL parameter
 */
$app->match('/{name}', function (Application $app) {
    return $app['twig']->render('index.twig', ['name' => $app['request']->get('name')]);
})->value('name', 'World');
