<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Pet.php";

    session_start();

    if (empty($_SESSION['pet_record'])) {
        $_SESSION['pet_record'] = "";
    }
    if (empty($_SESSION['turn_counter'])) {
        $_SESSION['turn_counter'] = 0;
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('start.html.twig');
    });

    $app->post("/new_pet", function() use ($app) {
        $numberOfTurns = 0;
        $pet = new Pet($_POST['petName']);
        $pet->petSave();
        return $app['twig']->render('status.html.twig', array('yourPet' => $pet));
    });

    $app->post("/feed", function() use ($app) {
        $pet = $_SESSION['pet_record'];
        $pet->petFeed();
        $pet->petDegrade();
        if ($pet->petStatus()) {
            return $app['twig']->render('status.html.twig', array('yourPet' => $pet));
        } else {
            return $app['twig']->render('retired.html.twig', array('yourPet' => $pet, 'turns' => $_SESSION['turn_counter']));
        }
    });

    $app->post("/rest", function() use ($app) {
        $pet = $_SESSION['pet_record'];
        $pet->petRest();
        $pet->petDegrade();
        if ($pet->petStatus()) {
            return $app['twig']->render('status.html.twig', array('yourPet' => $pet));
        } else {
            return $app['twig']->render('retired.html.twig', array('yourPet' => $pet, 'turns' => $_SESSION['turn_counter']));
        }
    });

    $app->post("/play", function() use ($app) {
        $pet = $_SESSION['pet_record'];
        $pet->petPlay();
        $pet->petDegrade();
        if ($pet->petStatus()) {
            return $app['twig']->render('status.html.twig', array('yourPet' => $pet));
        } else {
            return $app['twig']->render('retired.html.twig', array('yourPet' => $pet, 'turns' => $_SESSION['turn_counter']));
        }
    });

    $app->get("/reset", function() use ($app) {
        $pet = $_SESSION['pet_record'];
        $pet->resetPet();
        return $app['twig']->render('start.html.twig');
    });

    return $app;
 ?>
