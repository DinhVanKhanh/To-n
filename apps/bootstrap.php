<?php
    spl_autoload_register(function($className)
    {
        $exp=str_replace('_','/',$className);
        $path=str_replace('apps','',dirname(__FILE__));
        try
        {
            include_once($path.'/'.$exp.'.php');
        }
        catch(Exception $ex)
        {
            die();
        }  
    });
?>