<?php
/**
 * User: Samuel Meyer
 * Date: 09.10.2020
 * Updated by :
 *
 */

/* Import all classes */
$classes = glob( __DIR__ . '/class/*.php');
foreach($classes as $class){require($class);}
