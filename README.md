# Tree-Files-PHP
Get tree folder with basic information the files , in addition to setting a level of tree limit.

**Example**

```php
require_once 'treeFiles.php';
try {
	$treeFiles = $getTreeFiles('./', 2); //Return ARRAY
	$message   = "A lista de pasta foi carregada com sucesso!";
} catch (Exception $e) {
	$treeFiles = [];
	$message   = $e->getMessage();
}
```

**How to use**
```php
require_once 'treeFiles.php';
try {
	$treeFiles = $getTreeFiles($directory, $levelTree = 5, $openSubFolder = true, $restrictExtensionsArray = []);
	$treeFiles = $getTreeFiles('./bower_components', 8, true, ['js', 'css']);
	$treeFiles = $getTreeFiles('./bower_components');
} catch (Exception $e) {
	echo $e->getMessage();
}
```
**Structure**
```php
$getTreeFiles('./', 2, true, ['js', 'css']);

//Folder|Directory Array
[0] => Array (
    [name] => bower_components  //String
    [type] => dir //String
    [path] => /home/jhordan/PhpstormProjects/tree_files/bower_components/ //String
    [readable] => true //Boolean 
    [writable] => true //Boolean 
    [tree] => Array ( //Folder|Directory Array
        [0] => Array (
            [name] => bootstrap //String
            [type] => dir //String
            [path] => /home/jhordan/PhpstormProjects/tree_files/bower_components/bootstrap/ //String
            [readable] => true //Boolean 
            [writable] => true //Boolean 
            [tree] =>  Array () //Folder|Directory Array
            )
        [1] => Array (
            [name] => jquery //String
            [type] => dir //String
            [path] => /home/jhordan/PhpstormProjects/tree_files/bower_components/jquery/
            [readable] => true //Boolean 
            [writable] => true //Boolean 
            [tree] =>  Array () //Folder|Directory Array
            )
        )
    )
[1] => Array (
    [name] => style.css //String
    [only_name] => style //String
    [type] => file //String
    [size] => 1.379 //Double
    [path] => /home/jhordan/PhpstormProjects/tree_files/style.css //String
    [extension] => css //String
    [readable] => true //Boolean 
    [writable] => true //Boolean
    )

```
