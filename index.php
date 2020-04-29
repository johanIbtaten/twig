<?php
// Indispensable pour que twig fonctionne
require 'vendor/autoload.php';

// Importe mon extension personnalisée
require 'MonExtension.php';

// Rendu du template
// Va chercher les fichiers de template dans le dossier /templates
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false, // Mettre à la place de false en production  __DIR__ . '/tmp', 
    'debug' => true
]);

// Ajoute mon extension personnalisée à twig
$twig->addExtension(new MonExtension());

// Permet d'activer le debug avec {{ dump() }} dans les templates
$twig->addExtension(new Twig_Extension_Debug());

// Après un composer require twig/extensions
// permet d'importer l'extension Text de twig
$twig->addExtension(new Twig_Extensions_Extension_Text());


// $twig->addFunction(new Twig_SimpleFunction(
//   'markdownFunction', 
//   function($value) { 
//     return \Michelf\MarkdownExtra::defaultTransform($value);
//   },
//   ['is_safe' => ['html']]
//   )
// );

// $twig->addFilter(new Twig_SimpleFilter(
//   'markdownFilter', 
//   function($value) { 
//     return \Michelf\MarkdownExtra::defaultTransform($value);
//   },
//   ['is_safe' => ['html']]
//   )
// );


// Routing
$page = 'home';
if (isset($_GET['p'])) {
    $page = $_GET['p'];
}

/* Ajoute la variable $page en global, elle devient 
disponible dans tous les templates */
$twig->addGlobal('current_page', $page);

switch ($page) {
  // Si on est sur la page contact
  case 'contact':
      // On fait le rendu de contact.twig
      echo $twig->render(
        'contact.twig',
        /* On passe des variables au template sous la forme 
        d'un tableau associatif */
        [
          'name' => 'Marc', 
          'email' => 'demo@demo.fr'
        ]
      );
    break;
  case 'home':
    echo $twig->render('home.twig', [
      'email' => '<strong>marc@gmail.com</strong>', 
      'user' => [
        'name' => 'John',
        'age' => 28
      ],
      'persons' => [
        [
          'id' => 1269,
          'name' => 'Marc',
          'age' => 35,
          'description' => 'Peter Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum possimus sapiente architecto nobis, debitis vel qui cum consectetur enim iste, natus nam reprehenderit accusantium! Fugit quos perspiciatis architecto veniam sint!'
        ],
        [
          'id' => 1268,
          'name' => 'Peter',
          'age' => 37,
          'description' => 'Peter Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum possimus sapiente architecto nobis, debitis vel qui cum consectetur enim iste, natus nam reprehenderit accusantium! Fugit quos perspiciatis architecto veniam sint!'
        ],
        [
          'id' => 1158,
          'name' => 'Ben',
          'age' => 43,
          'description' => 'Ben Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum possimus sapiente architecto nobis, debitis vel qui cum consectetur enim iste, natus nam reprehenderit accusantium! Fugit quos perspiciatis architecto veniam sint!'
        ],
        [
          'id' => 1269,
          'name' => 'Marc',
          'age' => 35,
          'description' => 'Peter Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum possimus sapiente architecto nobis, debitis vel qui cum consectetur enim iste, natus nam reprehenderit accusantium! Fugit quos perspiciatis architecto veniam sint!'
        ],
        [
          'id' => 1268,
          'name' => 'Peter',
          'age' => 37,
          'description' => 'Peter Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum possimus sapiente architecto nobis, debitis vel qui cum consectetur enim iste, natus nam reprehenderit accusantium! Fugit quos perspiciatis architecto veniam sint!'
        ],
        [
          'id' => 1158,
          'name' => 'Ben',
          'age' => 43,
          'description' => 'Ben Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum possimus sapiente architecto nobis, debitis vel qui cum consectetur enim iste, natus nam reprehenderit accusantium! Fugit quos perspiciatis architecto veniam sint!'
        ],
        [
          'id' => 1269,
          'name' => 'Marc',
          'age' => 35,
          'description' => 'Peter Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum possimus sapiente architecto nobis, debitis vel qui cum consectetur enim iste, natus nam reprehenderit accusantium! Fugit quos perspiciatis architecto veniam sint!'
        ],
        [
          'id' => 1268,
          'name' => 'Peter',
          'age' => 37,
          'description' => 'Peter Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum possimus sapiente architecto nobis, debitis vel qui cum consectetur enim iste, natus nam reprehenderit accusantium! Fugit quos perspiciatis architecto veniam sint!'
        ],
        [
          'id' => 1158,
          'name' => 'Ben',
          'age' => 43,
          'description' => 'Ben Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum possimus sapiente architecto nobis, debitis vel qui cum consectetur enim iste, natus nam reprehenderit accusantium! Fugit quos perspiciatis architecto veniam sint!'
        ]
      ]
    ]);
    
      // echo $twig->render('home.twig', ['tutoriels' => tutoriels()]);
      break;
  default:
      header('HTTP/1.0 404 Not Found');
      echo $twig->render('404.twig');
      break;
}
