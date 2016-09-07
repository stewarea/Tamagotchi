<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Pet.php";

    session_start();

    if (empty($_SESSION['pet_record'])) {
        $_SESSION['pet_record'] = "";
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('start.html.twig');
    });

    $app->post("/new_pet", function() use ($app) {
        $pet = new Pet($_POST['petName']);
        $pet->petSave();
        return $app['twig']->render('status.html.twig', array('yourPet' => $pet));
    });

    $app->post("/feed", function() use ($app) {
        $pet = $_SESSION['pet_record'];
        $pet->petFeed();
        $pet->petDegrade();
        return $app['twig']->render('status.html.twig', array('yourPet' => $pet));
    });

    $app->post("/rest", function() use ($app) {
        $pet = $_SESSION['pet_record'];
        $pet->petRest();
        $pet->petDegrade();
        return $app['twig']->render('status.html.twig', array('yourPet' => $pet));
    });

    $app->post("/play", function() use ($app) {
        $pet = $_SESSION['pet_record'];
        $pet->petPlay();
        $pet->petDegrade();
        return $app['twig']->render('status.html.twig', array('yourPet' => $pet));
    });

    return $app;
 ?>
