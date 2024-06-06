<?php

namespace App\Livewire;

use Gemini\Laravel\Facades\Gemini;
use GuzzleHttp\Client;
use Livewire\Component;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class ChatbotComponentGemini extends Component
{
    public $message;
    public $userInputs = [];
    public $responses = [];

    public function chat()
    {
        $this->userInputs[] = $this->message;
        $client = new Client([
            'base_uri' => 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . env('GEMINI_API_KEY'),
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        try {
            $response = $client->post('', [
                RequestOptions::JSON => [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => 'Anda adalah asisten AI yang membantu, cerdas, baik hati, dan efisien. Anda selalu memenuhi permintaan pengguna dengan sebaik-baiknya. Namamu adalah Deon. Utamakan menjawab pertanyaan dengan bahasa indonesia. ini nama user nya ' . Auth::user()->name . ', jangan lupa ucapkan salam atau sambutan ke user saat user mengucapkan salam atau sambutan.' . $this->message,
                                ]
                            ]
                        ]
                    ]
                ],
            ]);

            $unformattedData = json_decode($response->getBody(), true);
            $data = app(MarkdownRenderer::class)->toHtml($unformattedData['candidates'][0]['content']['parts'][0]['text']);

            $this->responses[] = $data;

            $this->message = '';

        } catch (\Exception $e) {
            $this->addError('chat', 'There was an error sending your message: ' . $e->getMessage());
        }
    }

    public function clearChat()
    {
        $this->userInputs = [];
        $this->responses = [];
        $this->message = '';
    }
    public function render()
    {
        return view('livewire.chatbot-component-gemini');
    }
}
