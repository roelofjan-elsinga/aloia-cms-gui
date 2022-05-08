<?php
$finder = PhpCsFixer\Finder::create()
    ->exclude(['vendor'])
    ->in(__DIR__)
;
return (new PhpCsFixer\Config)
    ->setRules([
        '@PSR2' => true
    ])
    ->setFinder($finder)
    ->setUsingCache(false)
;
