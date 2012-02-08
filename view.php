<?php
echo <<<PLUGIN
<?php
/*
Plugin Name: {$this->name}
Plugin URI: {$this->uri}
Description: {$this->description}
Version: {$this->version}
Author: {$this->author}
Author URI: {$this->author_uri}
License: {$this->license}
*/

PLUGIN
;

echo "
/* ------------------------- Filters --------------------------- */
";
if(is_array($this->filters)){
    foreach($this->filters as $filter){
        if(!$filter) continue;
        $filter = explode(' ', $filter);
        $name = $filter[0];
        $priority = $filter[1] ? ', '.$filter[1] : ', 0';
        $args = $filter[2];
        for($i = 1; $i <= $args; $i++)
            $args_string .= '$arg_'.$i.', ';
        $args_string = trim($args_string, ', ');
        $args = $args ? ', '.$args : '';
        echo <<<WPFILTER

add_filter('{$name}', '{$this->id}_{$name}'$priority$args);
/**
 * Hooks into the `$name` filter.
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/$name
*/
function {$this->id}_{$name}($args_string){
    
    //return something;
}

WPFILTER
;
        unset($args_string);
    }
}

echo "
/* ------------------------- Actions --------------------------- */
";

if(is_array($this->actions)){
    foreach($this->actions as $action){
        if(!$action) continue;
        $action = explode(' ', $action);
        $name = $action[0];
        $priority = $action[1] ? ', '.$action[1] : ', 0';
        $args = $action[2];
        for($i = 1; $i <= $args; $i++)
            $args_string .= '$arg_'.$i.', ';
        $args_string = trim($args_string, ', ');
        $args = $args ? ', '.$args : '';
        echo <<<WPACTION

add_action('{$name}', '{$this->id}_{$name}'$priority$args);
/**
 * Hooks into the `$name` action.
 * @link http://codex.wordpress.org/Plugin_API/Action_Reference/$name
*/
function {$this->id}_{$name}($args_string){

}

WPACTION
;
        unset($args_string);
    }
}