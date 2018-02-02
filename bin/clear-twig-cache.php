<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

chdir(__DIR__ . '/../');

require 'vendor/autoload.php';

$config = include 'config/config.php';

if ($handle = opendir($config['twig']['cache_dir'])) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            unlink($config['twig']['cache_dir'].DIRECTORY_SEPARATOR.$file);
        }
    }
    closedir($handle);
}

printf(
    "Clear cache twig in '%s'%s",
    $config['twig']['cache_dir'],
    PHP_EOL
);
exit(0);