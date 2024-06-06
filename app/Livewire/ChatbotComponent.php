<?php

namespace App\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class ChatbotComponent extends Component
{
    public $message;
    public $userInputs = [];
    public $responses = [];

    public function chat()
    {
        $this->userInputs[] = $this->message;
        $client = new Client([
            'base_uri' => 'https://api.openai.com/v1/chat/completions',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ],
        ]);

        try {
            $response = $client->post('', [
                RequestOptions::JSON => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'Anda adalah asisten AI yang membantu, cerdas, baik hati, dan efisien. Anda selalu memenuhi permintaan pengguna dengan sebaik-baiknya. Namamu adalah Deon. Utamakan menjawab pertanyaan dengan bahasa indonesia. ini nama user nya ' . Auth::user()->name . ', jangan lupa ucapkan salam atau sambutan ke user saat user mengucapkan salam atau sambutan.'],
                        ['role' => 'user', 'content' => $this->message],
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 150,
                ],
            ]);
            $unformattedData = json_decode($response->getBody(), true);
            $data = app(MarkdownRenderer::class)->toHtml($unformattedData['choices'][0]['message']['content']);


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
        return view('livewire.chatbot-component');
    }
}
