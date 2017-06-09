<?php
$classes = get_declared_classes();

$dirs = glob('core/*', GLOB_ONLYDIR);
foreach($dirs as $dir) {
    $files = glob($dir.'/*.php');
    foreach($files as $file) {
        require_once($file);
        unset($file);
    }
    unset($files);
    unset($dir);
}
unset($dirs);
$new_classes = array_diff_key(get_declared_classes(), $classes);
unset($classes);

$file = fopen("doc.md", "w");

foreach($new_classes as $new_class) {
    $class = new ReflectionClass($new_class);
    unset($new_class);
    fwrite($file, '# ');
    if($class->isFinal()) {
        fwrite($file, 'final ');
    }
    fwrite($file, $class->getName());
    fwrite($file, PHP_EOL);
    fwrite($file, '```');
    fwrite($file, PHP_EOL);
    fwrite($file, $class->getDocComment());
    fwrite($file, PHP_EOL);
    fwrite($file, '```');
    fwrite($file, PHP_EOL);
    $methods = $class->getMethods(); 
    foreach ($methods as $method) {
        fwrite($file, '- ');
        fwrite($file, $method->getName());
        fwrite($file, '(');
        if($method->getNumberOfParameters()) {
            $parameters = $method->getParameters();
            $first = true;
            foreach($parameters as $parameter) {
                if($first) {
                    $first = false;
                } else {
                    fwrite($file, ', ');
                }
                if($parameter->hasType()) {
                    fwrite($file, $parameter->getType());
                    fwrite($file, ' ');
                }
                fwrite($file, '$'.$parameter->getName());
            }
            unset($parameters);
        }
        fwrite($file, ')');
        fwrite($file, ': ');
        fwrite($file, $method->getReturnType());
        fwrite($file, PHP_EOL);
        fwrite($file, '```');
        fwrite($file, PHP_EOL);
        fwrite($file, $method->getDocComment());
        fwrite($file, PHP_EOL);
        fwrite($file, '```');
        fwrite($file, PHP_EOL);
    }
    unset($methods);
    fwrite($file, PHP_EOL);
}
fclose($file);

