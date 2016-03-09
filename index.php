<?php 

require_once 'treeFiles.php';

try {
	$treeFiles = $getTreeFiles('./', 2);
	$message   = "A lista de pasta foi carregada com sucesso!";
} catch (Exception $e) {
	$treeFiles = [];
	$message   = $e->getMessage();
}

$processView = function($tree, $id = 'noCollapse') use(&$processView){
	echo "<ul class='collapse in' id='{$id}'>";
	foreach ($tree as $file){
		echo "<li class='parent_li'>";

		echo "<a title='Verkleinern' data-toggle='collapse' href='#".md5($file['path'])."'>";

		if($file['type'] == 'file')
			echo "<i class='glyphicon glyphicon-file'></i>"; 
		else
			echo "<i class='glyphicon glyphicon-folder-open'></i>";

		echo $file['name'];

		echo "</a>";

		if($file['type'] == 'dir')
			echo $processView($file['tree'], md5($file['path']));
		else
			echo "<ul></ul>";

		echo "</li>";
	}
	echo "</ul>";
};
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tree Files</title>

    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">

  </head>
  <body>
    <h5><?= $message;?></h5>
    <main>
    	<div id="test" class="tree">
    		<ul>
    			<?php $processView($treeFiles);?>
    		</ul>
    	</div>
    </main>

    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>