<?php
namespace Codelines\LaravelItexmo;

use Illuminate\Notifications\Notification;

class ItextMo{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param ItexMoContract $notification
     * @return void
     */
    public function send($notifiable, ItexMoContract $notification)
    {
        $message = $notification->toItextMo($notifiable);

        $itexmo_api_key = env('ITEXMO_API_KEY');
        $itexmo_sender_id = env('ITEXMO_SENDER_ID');
        $itexmo_secret = env('ITEXMO_API_SECRET');

        if(method_exists($notification, 'useApiKey')){
            $itexmo_api_key = $notification->useApiKey()['itexmo_api_key'];
            $itexmo_sender_id = $notification->useApiKey()['itexmo_sender_id'];
            $itexmo_secret = $notification->useApiKey()['itexmo_secret'];
        }

        // Send notification to the $notifiable instance...
        $client = new \GuzzleHttp\Client();


        $response = $client->request(
            'POST',
            'https://www.itexmo.com/php_api/api.php',[
                'form_params' => [
                    '1' => $notifiable->mobile(),
                    '2' => $message,
                    '3' => $itexmo_api_key,
                    '6' => $itexmo_sender_id,
                    'passwd' => $itexmo_secret,
                ]
            ]
        );
    }
}