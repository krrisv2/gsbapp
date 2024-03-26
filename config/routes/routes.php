<?php

use App\Controller\AppartementsController;
use App\Controller\ConnexionController;
use App\Controller\HomeController;
use App\Controller\ProfileController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes): void {
    $routes->add('default', ' ')
    ->controller([HomeController::class, 'home']);

    $routes->add('home', '/home')
    ->controller([HomeController::class, 'home']);

    $routes->add('appartements', '/appartements')
    ->controller([AppartementsController::class, 'index']);

    $routes->add('appartementsvisite', '/appartements/visite')
    ->controller([AppartementsController::class, 'visite']);

    $routes->add('connexionpage', '/connexion')
    ->controller([ConnexionController::class, 'index']);

    $routes->add('inscriptionpage', '/connexion/inscription/{type}')
    ->controller([ConnexionController::class, 'inscription'])
    ->defaults(['type' => "locataire"]);

    $routes->add('forgotpassword', '/connexion/forgotpassword')
    ->controller([ConnexionController::class, 'inscription']);

    $routes->add('profile', '/profile')
    ->controller([ProfileController::class, 'index']);

    $routes->add('logout', '/profile/logout')
    ->controller([ProfileController::class, 'logout']);

    $routes->add('gestion_appartements', '/profile/gestion')
    ->controller([ProfileController::class, 'gestion']);

    $routes->add('modif_appartements', '/profile/gestion/modif/{numappart}')
    ->controller([ProfileController::class, 'modifappart']);

    $routes->add('profile_visites', '/profile/visites}')
    ->controller([ProfileController::class, 'mesvisites']);

    $routes->add('visiter_appartements', '/appartements/visite/{appartId}')
    ->controller([AppartementsController::class, 'visiteappart']);

    $routes->add('ajout_appartements', '/profile/gestion/ajout')
    ->controller([ProfileController::class, 'ajout']);
;
};

