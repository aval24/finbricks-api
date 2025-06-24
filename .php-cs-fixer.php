<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__ . '/src') // Укажите путь к папке, которую нужно анализировать
    ->name('*.php')        // Фильтруем только PHP файлы
    ->notName('*.blade.php') // Игнорируем файлы Blade
    ->exclude('vendor')    // Исключаем папку vendor
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new Config();
return $config
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setFinder($finder)
    ->setRiskyAllowed(true) // Разрешить использование "рискованных" правил
    ->setRules([
        '@PSR12' => true, // Применяем стандарт PSR-12
        'array_syntax' => ['syntax' => 'short'], // Используем короткий синтаксис массивов
        'no_unused_imports' => true, // Удаляем неиспользуемые импорты
        'ordered_imports' => ['sort_algorithm' => 'alpha'], // Упорядочиваем импорты
        'single_quote' => true, // Преобразуем строки в одинарные кавычки
        'trailing_comma_in_multiline' => ['elements' => ['arrays']], // Добавляем завершающую запятую в многострочных массивах
    ]);
