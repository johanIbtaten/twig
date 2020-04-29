<?php

/* On crée une classe MonExtension qui étend la classe Twig_Extension */
class MonExtension extends Twig_Extension
{

    // On déclare les filters
    public function getFilters()
    {
        return [
            /* Le filter twig aura pour nom markdownFilter, il utilise la
            méthode markdownParse() pour retourner le résultat du filtre.
            Le résultat html ne sera pas échappé par twig grâce à l'option
            ['is_safe' => ['html'] */
            new Twig_SimpleFilter('markdownFilter', [$this, 'markdownParse'], ['is_safe' => ['html']])
        ];
    }

    // On déclare les fonctions
    public function getFunctions()
    {
        return [
            /* Le fonction twig aura pour nom markdownFunction, elle utilise
            la méthode markdownParse() pour retourner le résultat */
            new Twig_SimpleFunction('markdownFunction', [$this, 'markdownParse'], ['is_safe' => ['html']]),
            /* Le fonction twig aura pour nom activeClass, elle utilise
            la méthode activeClass() pour retourner le résultat.
            La méthode aura accès en paramètre au context du template 
            qui l'appelle */
            new Twig_SimpleFunction('activeClass', [$this, 'activeClass'], ['needs_context' => true])
        ];
    }

    public function markdownParse($value)
    {
        /* On retrourne la string transformé par la méthode du package 
        \Michelf\MarkdownExtra::defaultTransform() */
        return \Michelf\MarkdownExtra::defaultTransform($value);
    }

    public function activeClass(array $context, $page) {
        /* Si la variable globale current_page existe et que sa valeur
        est égale à la valeur définit dans le lien */
        if (isset($context['current_page']) && $context['current_page'] === $page) {
          /* Alors on retourne la classe active */  
          return ' active ';
        }
    }
}