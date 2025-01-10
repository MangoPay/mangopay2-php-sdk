<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__.'/MangoPay')
    ->in(__DIR__.'/tests')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'fully_qualified_strict_types' => true,
        'array_syntax' => ['syntax' => 'short'],
        'visibility_required' => [
            'elements' => ['property', 'method'], // 'const' is removed for old PHP compat
        ],
    ])
    ->setFinder($finder)
;
