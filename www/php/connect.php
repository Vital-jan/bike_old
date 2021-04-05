<?
    const DB_HOST = 'localhost';
    const DB_NAME = 'bike';
    const DB_USER = 'root';
    const DB_PASS = '';


    $db_connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    mysqli_set_charset($db_connect, 'utf8');

    function str_check($str = ''){ // валідація тексту перед збереженням в БД
        $str = str_replace("<br/>", "\n", $str); 
        $str = str_replace("&", "~~", $str); 
        // $str = strip_tags($str);
        $str = htmlspecialchars ($str, ENT_QUOTES);
        $str = str_replace("`", "&#96;", $str); 
        $str = trim($str);
        $str = str_replace("\n", "<br/>", $str); 
        $str = str_replace("~~", "&", $str); 
        return $str;
    }

    function getLogin() {
        if (isset($_SESSION)) {
            if ($_SESSION['login']) return true;
        }
        return false;
    }

    function query($query = '') {
        return mysqli_query($GLOBALS['db_connect'], "{$query}");
    }

// ----------------------------------------------------------------------------------------
    function get_query($query = '') { // повертає асоціативний масив - результат запиту

        $query_result = mysqli_query($GLOBALS['db_connect'], $query);

        $array = array();
        while ($cRecord = mysqli_fetch_assoc($query_result)) {
            $array[] = $cRecord;
        }
        return $array;
    }

// ----------------------------------------------------------------------------------------
    function filename_parse($file) {
        if (!$file || $file == '') return false;
        $name = basename($file);
        $path = substr($file, 0, strlen($file) - strlen($name));
        $index = strpos($name, '.');
        if ($index === false) {
            $name = $file;
            $ext = '';
        }
        else {
            $exp = explode('.', $name);
            $ext = $exp[1];
            if ($ext) $ext = '.'.$ext;
            $name = $exp[0];
        }
        return array('path'=>$path, 'name'=>$name, 'ext'=>$ext);
    }

// ----------------------------------------------------------------------------------------
    function filename_generate($file) { // генерує нове ім'я, якщо зазначений файл існує
        if (!$file || $file == '') return false;
        $fa = filename_parse($file);
        if (!$fa) return false;
        
        $counter = 0;
        $new_file = $file;
        while (file_exists($file)) {
            $file = $fa['path'].$fa['name'].$counter.$fa['ext'];
            $counter++;
        }
        return $file;
    }

?>