<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatBotController extends Controller
{
    public function sendChat(Request $request){
        // dd($request);

        $result = OpenAI::completions()->create([
            'max_tokens' => 100,            //simboliu skaicius atsakyme
            'model' => 'gpt-turbo-3.5',  //modelio pavadinimas
            'prompt' => $request->input     //prompt
            //rezultatas tai OpenAI\API\Response objektas
        ]);

        $response = array_reduce(
            $result->toArray()['choices'],
            fn(string $result, array $choice) => $result . $choice['text'], ""
        );
        dd($response);
    }
}
