<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Получаем данные из формы
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

    // 2. Валидация (базовая, можно расширить)
    $errors = [];
    if (empty($name)) {
        $errors[] = "Пожалуйста, введите имя.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Пожалуйста, введите корректный email.";
    }
    if (empty($comment)) {
        $errors[] = "Пожалуйста, введите комментарий.";
    }

    // 3. Если нет ошибок, отправляем email
    if (empty($errors)) {
        $to = 'dvklmv@gmail.com';  // <--- Замените на свой email
        $subject = 'Новое сообщение с формы';
        $message = "Имя: " . $name . "\n";
        $message .= "Email: " . $email . "\n";
        $message .= "Комментарий: " . $comment . "\n";
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";

        if (mail($to, $subject, $message, $headers)) {
             echo '<p>Спасибо! Ваше сообщение отправлено.</p>'; //  уведомление
        } else {
            echo '<p>Произошла ошибка при отправке сообщения. Пожалуйста, попробуйте позже.</p>';
        }
    } else {
        echo '<ul style="color: red;">';
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo '</ul>';
    }
}
?>
