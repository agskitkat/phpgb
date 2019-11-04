<?
/* 
	1. Объявить две целочисленные переменные $a и $b 
	и задать им произвольные начальные значения. 
	Затем написать скрипт, который работает по следующему принципу:
	
	если $a и $b положительные, вывести их разность;
	если $а и $b отрицательные, вывести их произведение;
	если $а и $b разных знаков, вывести их сумму;
	
	Ноль можно считать положительным числом.
*/
echo "\r\n 1. \r\n";

$a = rand(-10, 10);
$b = rand(-10, 10);

echo "a = $a, b = $b \r\n";

if($a >= 0 && $b >=0) {
	echo "разность \r\n";
	if($a > $b) {
		echo($a - $b);
	} else {
		echo($b - $b);
	}
}

if($a < 0 && $b < 0) {
	echo "произведение \r\n";
	echo($a * $b);
}

if(($a >= 0 && $b < 0) || ($a < 0 && $b >= 0)) {
	echo "сумма \r\n";
	echo($a + $b);
}

/* 
	2. Присвоить переменной $а значение в промежутке [0..15]. 
	С помощью оператора switch организовать вывод чисел от $a до 15.
*/
echo "\r\n 2. \r\n";
$a = rand(1, 15);
echo "a = $a \r\n";
switch($a) {
	case 1:
		echo 1;
	case 2:
		echo 2;
	case 3:
		echo 3;
	case 4:
		echo 4;
	case 5:
		echo 5;
	case 6:
		echo 6;
	case 7:
		echo 7;
	case 8:
		echo 8;
	case 9:
		echo 9;
	case 10:
		echo 10;
	case 11:
		echo 11;
	case 12:
		echo 12;
	case 13:
		echo 13;
	case 14:
		echo 14;
	case 15:
		echo 15;
}

/* 
	3. Реализовать основные 4 арифметические операции в виде 
	функций с двумя параметрами.
	Обязательно использовать оператор return.
*/
echo "\r\n 3. \r\n";
/* 
	Сложение
*/
function p($a, $b) {
	return $a + $b;
}

/* 
	Вычитание 
*/
function m($a, $b) {
	return $a - $b;
}

/* 
	Деление 
*/
function d($a, $b) {
	return $a / $b;
}

/* 
	Умножение 
*/
function u($a, $b) {
	return $a * $b;
}


/* 
	4. Реализовать функцию с тремя параметрами:
	function mathOperation($arg1, $arg2, $operation),
	где $arg1, $arg2 – значения аргументов, 
	$operation – строка с названием операции. 
	В зависимости от переданного значения операции выполнить 
	одну из арифметических операций (использовать функции из пункта 3)
	и вернуть полученное значение (использовать switch).
*/
echo "\r\n 4. \r\n";
function mathOperation($arg1, $arg2, $operation) {
	switch($operation) {
		case "+":
			return p($arg1, $arg2);
		break;
		case "-":
			return m($arg1, $arg2);
		break;
		case "/":
			return d($arg1, $arg2);
		break;
		case "*":
			return u($arg1, $arg2);
		break;
	}
}

/* 
	5. Посмотреть на встроенные функции PHP. Используя имеющийся HTML-шаблон, 
	вывести текущий год в подвале при помощи встроенных функций PHP.
*/
echo "\r\n 5. \r\n";
echo(date("Y-m-d H:i:s"));


/* 
6. *С помощью рекурсии организовать функцию возведения числа в степень. Формат: 
function power($val, $pow), где $val – заданное число, $pow – степень.
 */
echo "\r\n 6. \r\n";
function power($val, $pow) {
	if($pow === 1){
		return $val;
	}
	return power($val*$val, --$pow);
}
echo power(2, 4);


/* 
	7. *Написать функцию, которая вычисляет текущее время и возвращает 
	его в формате с правильными склонениями, например:
	
	22 часа 15 минут
	21 час 43 минуты
*/
echo "\r\n 7. \r\n";


/*  
	Конструкция «числительное + существительное» в именительном падеже 
	Создано на основе https://nekin.info/math/imya_chislitelnoye.htm
*/
function getEnding($int, $arEndings) {
	$int = $int % 100; // Находим остаток от деления на 100

	
	// Если это второй десяток
	if ($int >= 11 && $int <= 19) {
        $ending = $arEndings[2];
    } else {
		// Ищем окончания 
		$i = $int % 10; // Остаток от деления на 10

		switch ($i) {
			case (1): $ending = $arEndings[0]; break;
			case (2):
			case (3):
			case (4): $ending = $arEndings[1]; break;
			default: $ending = $arEndings[2];
		}
	}
	
	return $ending;
}

function nowTime() {
	$str = "";
	$h = date("H");
	$m = date("i");
	
	$str .= $h ." ";
	$str .= getEnding($h, array('час', 'часа', 'часов')) . " ";
	
	$str .= $m ." ";
	$str .= getEnding(+$m, array('минута', 'минуты', 'минут')) ." ";
	
	return $str;
}

echo nowTime();
?>