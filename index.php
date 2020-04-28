<?php
require 'vendor/autoload.php';
require 'MonExtension.php';

// Routing
$page = 'home';
if (isset($_GET['p'])) {
    $page = $_GET['p'];
}

// Récupère les derniers tutoriels
// function tutoriels () {
//     $pdo = new PDO('mysql:dbname=grafikart_dev;host=localhost', 'root', 'root');
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//     $tutoriels = $pdo->query('SELECT * FROM tutoriels ORDER BY id DESC LIMIT 10');
//     return $tutoriels;
// }

// Rendu du template
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, [
    'cache' => __DIR__ . '/tmp',
    'debug' => true
]);

$twig->addExtension(new MonExtension());
$twig->addExtension(new Twig_Extension_Debug());
// $twig->addExtension(new Twig_Extensions_Extension_Text());
$twig->addGlobal('current_page', $page);

switch ($page) {
    case 'contact':
        echo $twig->render('contact.twig', ['name' => 'Marc', 'email' => 'demo@demo.fr']);
      break;
      case 'home':
        echo $twig->render('main.twig');
        // echo $twig->render('home.twig', ['tutoriels' => tutoriels()]);
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');
        break;
}
