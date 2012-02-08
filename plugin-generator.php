<?php

class WP_Plugin_Generator{
    protected $id = 'wpse';
    protected $name = 'Default Plugin Name';
    protected $description = '';
    protected $uri = 'http://yoursite.com';
    protected $version = '0.1';
    protected $author = 'Your Name';
    protected $author_uri = 'http://wordpress.stackexchange.com/users/USER_ID/USER_NAME';
    protected $license = 'GPL2';
    protected $actions;
    protected $filters;
    protected $file_contents;
    protected $question;
    protected $question_id;
    
    function __construct($args = array()){
        $this->set_vars($args);
        $this->get_question_info();
        $this->set_question_vars();
        $this->generate_plugin_contents();
        $this->export_file();
    }
    
    protected function set_vars($args){
        extract($args);
        $this->name = $name ? $name : $this->name;
        $this->description = $description ? $description : $this->description;
        $this->uri = $uri = $uri ? $uri : $this->uri;
        $this->version = $version ? $version : $this->version;
        $this->author = $author ? $author : $this->author;
        $this->author_uri = $author_uri ? $author_uri : $this->author_uri;
        $this->license = $license ? $license : $this->license;
        $this->question_id = $question_id ? $question_id : $this->question_id;
        $this->actions = $actions;
        $this->filters = $filters;
    }
    
    protected function generate_plugin_contents(){
        ob_start();
        include('view.php');
        $buffer = ob_get_clean();
        $this->file_contents = $buffer;
    }
    
    protected function export_file(){
        header('Content-type: application/php charset=utf-8');
        header('Content-Disposition: attachment; filename="test.php"');
        echo $this->file_contents;
    }
    
    protected function get_question_info(){
        $question_id = $this->question_id;
        if(!$question_id) return;
        $api_url = 'http://api.wordpress.stackexchange.com/1.0/questions/';
        $json_response = file_get_contents($api_url.$question_id);
        $json_response = file_get_contents('compress.zlib://data://text/plain;base64,'.base64_encode($json_response));
        $response = json_decode($json_response);
        $this->question = $response->questions[0];
    }
    
    protected function set_question_vars(){
        if(!$this->question) return;
        $wpse_author = $this->question->owner->display_name;
        $wpse_title = $this->question->title;
        $this->description = $wpse_title.' (Author: '.$wpse_author.') ';
        $this->name = 'WPSE Question #'.$this->question->question_id;
        $this->uri = 'http://wordpress.stackexchange.com/questions/'.$this->question->question_id;
        $this->id = 'wpse_'.$this->question->question_id;
    }
}