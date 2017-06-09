<?php

function do_docComment(&$file, &$thing) {
    fwrite($file, '```');
    fwrite($file, PHP_EOL);
    fwrite($file, $thing->getDocComment());
    fwrite($file, PHP_EOL);
    fwrite($file, '```');
    fwrite($file, PHP_EOL);
}

function do_class(&$file, &$class) {
    fwrite($file, '# ');
    if($class->isFinal()) {
        fwrite($file, 'final ');
    }
    fwrite($file, $class->getName());
    fwrite($file, PHP_EOL);
    do_docComment($file, $class);
}

function do_parameter(&$file, &$parameter) {
    if($parameter->hasType()) {
        fwrite($file, $parameter->getType());
        fwrite($file, ' ');
    }
    fwrite($file, '$'.$parameter->getName());
}

function do_method_parameters(&$file, &$method) {
    if($method->getNumberOfParameters()) {
        $parameters = $method->getParameters();
        $first = true;
        foreach($parameters as $parameter) {
            if($first) {
                $first = false;
            } else {
                fwrite($file, ', ');
            }
            do_parameter($file, $parameter);
            unset($parameter);
        }
        unset($parameters);
    }
}

function do_full_class(&$file, &$class) {
    do_class($file, $class);
    
}

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

$README = fopen("doc/README.md", "w");

foreach($new_classes as $new_class) {
    $file = fopen("doc/".$new_class.".md", "w");
    $class = new ReflectionClass($new_class);
    unset($new_class);
    do_class($README, $class);
    
    do_class($file, $class);
    
    $methods = $class->getMethods(); 
    foreach ($methods as $method) {
        fwrite($file, '- ');
        fwrite($file, $method->getName());
        fwrite($file, '(');
        do_method_parameters($file, $method);
        fwrite($file, ')');
        if($method->hasReturnType()) {
            fwrite($file, ': ');
            fwrite($file, $method->getReturnType());
        }
        fwrite($file, PHP_EOL);
        do_docComment($file, $method);
    }
    unset($methods);
    fwrite($README, PHP_EOL);
    
    fwrite($file, PHP_EOL);
    fclose($file);
    unset($file);
}
fclose($README);

