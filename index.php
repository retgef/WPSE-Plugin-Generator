<?php
if(isset($_POST['question_id']) && $_POST['question_id']){
   $args['question_id'] = $_POST['question_id'];
   if($_POST['filters'])
      $args['filters'] = $_POST['filters'];
   
   if($_POST['actions'])
      $args['actions'] = $_POST['actions'];
      
   require_once('plugin-generator.php');
   new WP_Plugin_Generator($args);
   die();
}
elseif(isset($_POST['question_id'])){
   $message = '<p class="error">Please enter a WPSE Question ID</p>';
}?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
   <head>
        <title>WPSE Plugin Generator</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="core.js"></script>
            <link href="style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
        <div id='wrap'>
            <h1>WPSE Plugin Generator</h1>
            <?php echo $message;?>
            <form method="post">
               <p class="question-id">
                  <label for="question_id">Question ID:</label>
                  <input type="text" name="question_id">
               </p>
               <p class="actions">
                  <em>Format: action_name priority arguments  Example: init 10 2</em>
                  <label for="question_id">Actions: <span>+</span></label>
                  <input type="text" name="actions[]">
               </p>
               <p class="filters">
                  <em>Format: filter_name priority arguments  Example: the_content 5 1</em>
                  <label for="question_id">Filters: <span>+</span></label>
                  <input type="text" name="filters[]">
               </p>
               <p>
                  <input type="submit" value="Get the plugin!">
               </p>
            </form>
        </div>
   </body>
</html>