<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use App\Models\PushSubscription;
 
class PushController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'endpoint'   => 'required|string',
            'public_key' => 'required|string',
            'auth_token' => 'required|string',
        ]);
 
        PushSubscription::updateOrCreate(
            ['user_id' => Auth::id(), 'endpoint' => $request->endpoint],
            ['public_key' => $request->public_key, 'auth_token' => $request->auth_token]
        );
 
        return response()->json(['success' => true]);
    }
 
    public function unsubscribe(Request $request)
    {
        PushSubscription::where('user_id', Auth::id())
            ->where('endpoint', $request->endpoint)
            ->delete();
 
        return response()->json(['success' => true]);
    }
 
    // Kirim notifikasi ke semua subscription user tertentu
    public static function sendToUser($userId, $title, $body, $url = '/reminders')
    {
        $subscriptions = PushSubscription::where('user_id', $userId)->get();
        if ($subscriptions->isEmpty()) return;
 
        $auth = [
            'VAPID' => [
                'subject'    => env('VAPID_SUBJECT'),
                'publicKey'  => env('VAPID_PUBLIC_KEY'),
                'privateKey' => env('VAPID_PRIVATE_KEY'),
            ],
        ];
 
        $webPush = new WebPush($auth);
 
        foreach ($subscriptions as $sub) {
            $webPush->queueNotification(
                Subscription::create([
                    'endpoint'   => $sub->endpoint,
                    'publicKey'  => $sub->public_key,
                    'authToken'  => $sub->auth_token,
                ]),
                json_encode(['title' => $title, 'body' => $body, 'url' => $url])
            );
        }
 
        foreach ($webPush->flush() as $report) {
            if (!$report->isSuccess()) {
                // Hapus subscription yang tidak valid
                PushSubscription::where('endpoint', $report->getRequest()->getUri()->__toString())->delete();
            }
        }
    }
}
 

