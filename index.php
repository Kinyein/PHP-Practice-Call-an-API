<?php
// Para ver lo que se trabaja en un archivo php se puede levantar un entorno local de la siguiente manera en la consola: php -S localhost:8000 (el puerto puede variar)

const API_URL = "https://whenisthenextmcufilm.com/api";
# Incializar una nueva sesion de cURL; ch = cURL handle
$ch = curl_init(API_URL);
// Indicamos que queremos recibir el resultado de la peticion y no mostrarla en pantalla 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
/* Comentario multilinea
    Se ejecuta la peticion y guarda el resultado
*/
$result = curl_exec($ch);
// Transforma el resultado de json a un array asociativo con el segundo parametro booleano
$data = json_decode($result, true);

curl_close($ch);

// Hay otra forma mas facil para solo hacer un GET a una api y es usando file_get_contents
// $result = file_get_contents(API_URL);
?>

<head>
	<meta charset="UTF-8" />
	<title>The next marvel movie</title>
	<meta name="description" content="The next marvel movie" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
</head>

<main>
	<pre style="font-size: 12px; overflow: scroll; height: 400px;">
		<?php var_dump($data); ?>
	</pre>
	<section style="display: flex; gap: 20px; flex-wrap: wrap">
		<hgroup>
			<img 
				src="<?= $data["poster_url"]; ?>" 
				width="300" 
				alt="Poster de <?= $data["title"] ?>" 
				style="border-radius: 8px; width: 100%; max-width: 300px" 
			/>
			<div>
				<h3><?= $data["title"] ?> se estrena en <?= $data["days_until"]; ?> dias</h3>
				<h4>Fecha de estreno: <?= $data["release_date"]; ?></h4>
			</div>
		</hgroup>

		<hgroup>
			<img 
				src="<?= $data["following_production"]["poster_url"]; ?>" 
				width="300" 
				alt="Poster de <?= $data["following_production"]["title"] ?>" 
				style="border-radius: 8px; width: 100%; max-width: 300px" 
			/>
			<div>
				<h3><?= $data["following_production"]["title"] ?> se estrena en <?= $data["following_production"]["days_until"]; ?> dias</h3>
				<h4>Fecha de estreno: <?= $data["following_production"]["release_date"]; ?></h4>
			</div>
		</hgroup>

	</section>

</main>

<style>
	:root {
		color-scheme: light dark;
	}

	hgroup {
		display: flex;
		gap: 20px;
		align-items: center;
		justify-content: center;
		flex: 1;
		min-width: 500px;
		flex-wrap: wrap;

		>div {
			min-width: 200px;
			flex: 1;
		}
	}
</style>