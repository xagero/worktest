<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date   16.11.2016 18:24
 */


$modules = [
    'Zend\Cache',
    'Zend\Router',
    'Zend\Mvc\Console',
];

$path = dirname(__FILE__) . '/../module';
foreach (new DirectoryIterator($path) as $dir) {
    if ($dir->isDot() or !$dir->isDir()) {
        continue;
    }

    $modules[] = $dir->getFilename();
}

/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */
return $modules;