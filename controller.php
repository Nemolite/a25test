<?php

// обеспечим безопасность 
  foreach ($_POST as $key=>$value) {
  	$arr[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

  }

// print_r($arr);

// отправляем на почтовый ящик

  if (isset($arr)) {
        $to = "g25092011@mail.ru";
        $subject = "Заказ";
        foreach ($arr as $key=>$value) {
            if (!empty($value)) {
                $message .= strip_tags(str_replace('_',' ',$key).': '.trim($value))."\r\n";
            }
        }
        $message = wordwrap($message, 70, "\r\n");
        $send_status = mail($to, $subject, $message);
        if ($send_status) {
            echo 'Данные отправлены';
        } else {    
            echo 'Нет возможности отправить данные';
        }
    } else {
        echo 'Нет данных для отправления';
    }


// Записываем данные в БД (используем PDO)
    $host = '127.0.0.1';
    $db   = 'a25bd';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];


    $pdo = new PDO($dsn, $user, $pass, $opt);
// Подготавливаем
    $sql = "INSERT INTO sendmail (name , phone, email ) VALUES (:uname, :phone, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uname', $arr["username"], PDO::PARAM_STR);
    $stmt->bindParam(':phone', $arr["phone"], PDO::PARAM_STR);
    $stmt->bindParam(':email', $arr["mail"], PDO::PARAM_STR);
// Отправляем
    $tmp = $stmt->execute();
    if ($tmp) echo "и сохранены на сервере";
    	else
    		echo "но не сохранились на сервере";
    
?>