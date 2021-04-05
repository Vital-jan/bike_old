<?
require 'connect.php';

function genpass($number, $param = 1)
{
$arr = array('a','b','c','d','e','f',
'g','h','i','j','k','l',
'm','n','o','p','r','s',
't','u','v','x','y','z',
'A','B','C','D','E','F',
'G','H','I','J','K','L',
'M','N','O','P','R','S',
'T','U','V','X','Y','Z',
'1','2','3','4','5','6',
'7','8','9','0','.',',',
'(',')','[',']','!','?',
'&','^','%','@','*','$',
'<','>','/','|','+','-',
'{','}','`','~');
// Генерируем пароль
$pass = "";
for($i = 0; $i < $number; $i++)
{
if ($param>count($arr)-1)$param=count($arr) - 1;
if ($param==1) $param=48;
if ($param==2) $param=58;
if ($param==3) $param=count($arr) - 1;
// Вычисляем случайный индекс массива
$index = rand(0, $param);
$pass .= $arr[$index];
}
return $pass;
}

$response['error'] = null;

if (!$_POST['body']) {
    $response['error'] = 'Arguments null';
    exit  (json_encode($response));
}

$response['mail'] = strtolower($_POST['body']);

$exist = count(get_query("select * from users where lower(user_email) ='{$response['mail']}'"));
if ($exist > 0) {
    $response['exist'] = $exist;
    $response['error'] = 'Email exist';
    exit  (json_encode($response));
}

$new_pass = genpass(10,3);// генерируем пароль
$new_sha256 = hash('sha256', $new_pass);// сохраняем в sha256 ......
$response['hash'] = $new_sha256;

$insert_record = query("insert into users (user_email, user_password) values ('{$response['mail']}', '{$new_sha256}')" );
$response['inseert_record'] = $insert_record;

if (!$insert_record) exit  (json_encode($response));

mail($response['mail'], 'Реєстрація на need4speed.com', // отправляем на email
'Вітаємо! Ви зареєстровані на need4ride.com
Ваш логін: '.$response['mail'].
'
Ваш пароль: '.$new_pass.

'
Тепер Ви можете реєструватись в походах/покатухах або створювати власні.
Ви можете змінити пароль, увійшовши в особистий кабінет.

Щасливих доріг!', 
'need4ride.com'); 

exit  (json_encode($response));
?>