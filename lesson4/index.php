<?
/* 
	1. Создать галерею фотографий. Она должна состоять всего из одной странички,
	на которой пользователь видит все картинки в уменьшенном виде и форму для 
	загрузки нового изображения. При клике на фотографию она должна открыться в 
	браузере в новой вкладке. Размер картинок можно ограничивать с помощью 
	свойства width. При загрузке изображения необходимо делать 
	проверку на тип и размер файла.
	
	2. *Строить фотогалерею, не указывая статичные ссылки к файлам,
	а просто передавая в функцию построения адрес папки с изображениями.
	Функция сама должна считать список файлов и построить фотогалерею со
	ссылками в ней.
	
	3. *[ для тех, кто изучал JS-1 ] При клике по миниатюре нужно 
	показывать полноразмерное изображение в модальном окне (материал в помощь: 
	http://dontforget.pro/javascript/prostoe-modalnoe-okno-na-jquery-i-css-bez-plaginov/)
	
	Дополнительно
	1 - Создать функцию, которая будет при каждом запросе файла index.php
	сохранять в файл log.txt данные о времени запроса.
	2* - Доработать логирование таким образом, чтобы после каждой 10 записи 
	в файл log.txt, он пересохранялся с новым именем. Например logX.txt 
	(под Х понимаются числа от 0 до бесконечности). А новые записи снова 
	записывались в файл log.txt. Таким образом должен формироваться архив логирований. В каждом файле не более 10 записей.
	Подробности в записе урока)
*/

	$photos = [];
	$imagesDir = 'uploads/';
	
	// Есть нужная дерриктория, содаём если нет
	if(!is_dir($imagesDir)) {
		mkdir($imagesDir, 0700);
	}
	
	// Загружаем файл
	if(count($_FILES)) {
		$uploadfile = $imagesDir . basename($_FILES['file']['name']);
		if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
			echo "Файл корректен и был успешно загружен.\n";
		}
	}
	
	// Получаем список файлов
	if(is_dir($imagesDir)) {
		$files = scandir($imagesDir);
		foreach($files as $file) {
			$file = $imagesDir . $file;
			if(is_file($file)) {
				$photos[] = $file;
			}
		}
	}
	
	
	// Логирование
	$logsDir = 'logs/';
	
	function recordData($fileName) {
		$fp = fopen($fileName, "a");
		fwrite($fp, date("Y-m-d H:i:s") . "\r\n");
		fclose($fp);
	}
	// Есть нужная дерриктория, содаём если нет
	if(!is_dir($logsDir)) {
		mkdir($logsDir, 0700);
	}
	// Читаем деррикторию в обратном порядке
	if(is_dir($logsDir)) {
		$files = scandir($logsDir, 1);
	}
	// Если первый не файл
	if(!is_file($logsDir . $files[0])) {
		// То создаём и записывам
		recordData( $logsDir . "log0.txt" );
	} else {
		// Если есть считаем строки
		$row = 0;
		$fp = fopen($logsDir . $files[0], "r");
		while (($buffer = fgets($fp, 4096)) !== false) {
			$row++;
		}
		fclose($fp);
		
		if($row < 10) {
			recordData( $logsDir . $files[0] );
		} else {
			recordData( $logsDir . "log". (count($files)-2).".txt" );
		}
	}
?>
<html>
	<head>
		<script>
			function showModal(image) {
				let modal = document.querySelector('#modal');
				modal.classList.add('modal_active');
				modal.querySelector('img').setAttribute("src", image);
			}
			
			function modalClose(modal) {
				modal.classList.remove('modal_active');
			}
		</script>
		<style>
			body {
				background: #d1d1d1;
				display: flex;
				justify-content: center;
				align-items: center;
				flex-direction: column;
			}
			.gallery {
				width: 100%;
				margin-bottom: 40px;
				display: flex;
				justify-content: center;
				align-items: center;
				flex-wrap: wrap;
			}
			.photo-preview {
				width: 200px;
				height: 200px;
				background-size: cover;
				margin:5px;
				cursor: pointer;
			}
			
			.modal {
				position:absolute;
				top: 0px;
				left:0px;
				width: 100vw;
				height: 100vh;
				background:rgba(0,0,0,.7);
				display:none;
				justify-content: center;
				align-items: center;
			}
			.modal.modal_active {
				display: flex;
			}
			.modal .modal__body {
				text-align: center;
			}	
			.modal .modal__body img {
				max-width: 90vw;
				max-height: 90vh;
			}
			
			.add {
				
			}
		</style>
	</head>
	<body>
		<div class="gallery">
			<? foreach($photos as &$photo) {?>
				<div onclick="showModal('<?=$photo?>')" style="background-image:url(<?=$photo?>)" class="photo-preview"></div>
			<?}?>
		</div>
		<form class="add" method="post" enctype="multipart/form-data">
			<label>Добавить изображение</label><br>
			<input name="file" type="file">
			<button type="submit">Загрузить</button>
		</form>
		<div id="modal" class="modal" onclick="modalClose(this)">
			<div class="modal__body">
				<img src="" >
			</div>
		</div>
	</body>
</html>