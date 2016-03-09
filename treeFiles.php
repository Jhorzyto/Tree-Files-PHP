<?php

$getTreeFiles = function ($dir, $level = 5, $fileTree = true, array $extension = []) use (&$getTreeFiles){
	$directoriesIgnored = ['.', '..'];

	if($level <= 0)
		return [];
		
	$fileInfo = new SplFileInfo($dir);

	if(!$fileInfo->isDir())
		throw new Exception("Por favor adicione um diretório valido!");

	if(!$fileInfo->isReadable())
		throw new Exception("Você não pode ler este diretório!");

	$dir = $fileInfo->getRealPath();

    $treeFiles = scandir($dir);

    if(!is_array($treeFiles))
		throw new Exception("Ocorreu um erro ao exportar a lista de diretórios!");

	$structure = [];

	foreach ($treeFiles as $fileDir) {
		$dirInfo = new SplFileInfo("{$dir}/{$fileDir}");

		if(!in_array($dirInfo->getBasename(), $directoriesIgnored) && ($dirInfo->isDir() || empty($extension) || ($dirInfo->isFile() && in_array($dirInfo->getExtension(), $extension)))){

			if($dirInfo->isFile())
				$structure[] = [
					'name' => $dirInfo->getBasename(),
					'only_name' => $dirInfo->getBasename("." . $dirInfo->getExtension()),
					'type' => $dirInfo->getType(),
					'size' => $dirInfo->getSize() / 1000,
					'path' => $dirInfo->getPathname(),
					'extension' => $dirInfo->getExtension(),
					'readable'  => $dirInfo->isReadable(),
					'writable'  => $dirInfo->isWritable(),
				];
			elseif($fileTree)
				$structure[] = [
					'name' => $dirInfo->getBasename(),
					'type' => $dirInfo->getType(),
					'path' => $dirInfo->getPathname() . "/",
					'readable' => $dirInfo->isReadable(),
					'writable' => $dirInfo->isWritable(),
					'tree' => $getTreeFiles($dirInfo->getRealPath(), $level - 1, $fileTree, $extension),
				];


		}
		unset($dirInfo);
	}

	return $structure;
};