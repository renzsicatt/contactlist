<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebSocket as WebSocketModel;
use Carbon\Carbon;

class WebSocketController extends Controller
{
    public function processEvent(Request $request)
    {

        $currentDateTime = Carbon::now('UTC')->format('Y-m-d H:i:s');
        $WebSocket = new WebSocketModel(); // Adjust this if you are using a different model
        $WebSocket->Action = $request->message;
        $WebSocket->Date = $currentDateTime;
        $WebSocket->save();
        return $request->message;
    }
}
