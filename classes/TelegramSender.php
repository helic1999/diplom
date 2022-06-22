<?php

class TelegramSender
{
    public static function send(string $message, string $chatId): bool {
        $token = '5522243099:AAFLPTrkRwTq1YOwAONMnz__iphKm6iPMYE';

        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatId;
        $url = $url . "&text=" . urlencode($message);
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        return $result->ok ?? false;
    }
}