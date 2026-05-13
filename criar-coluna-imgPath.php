<?php

$dbPath = __DIR__ . '/banco_dados.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$stmt = $pdo->query("PRAGMA table_info(videos)");
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

$imgPathExists = false;
foreach ($columns as $column) {
	if (($column['name'] ?? null) === 'imgPath') {
		$imgPathExists = true;
		break;
	}
}

if ($imgPathExists) {
	echo "A coluna 'imgPath' ja existe na tabela 'videos'.";
	return;
}

$pdo->exec("ALTER TABLE videos ADD COLUMN imgPath TEXT");
echo "Coluna 'imgPath' adicionada com sucesso a tabela 'videos'.";