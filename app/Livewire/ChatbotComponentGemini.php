<?php

namespace App\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use App\Models\ChatMessage;
use App\Models\ChatSession;
use GuzzleHttp\RequestOptions;
use App\Models\SystemInstruction;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class ChatbotComponentGemini extends Component
{
    public $message;
    public $userInputs = [];
    public $responses = [];
    public $currentSessionId;

    public function mount()
    {
        $this->loadLastSession();
    }

    public function loadLastSession()
    {
        // Load the last session if it exists
        $lastSession = ChatSession::where('user_id', Auth::id())->latest()->first();
        if ($lastSession) {
            $this->currentSessionId = $lastSession->id;
            $this->loadMessages();
        }
    }

    public function loadMessages()
    {
        $messages = ChatMessage::where('session_id', $this->currentSessionId)->get();
        foreach ($messages as $message) {
            if ($message->is_user) {
                $this->userInputs[] = $message->message;
            } else {
                $this->responses[] = $message->message;
            }
        }
    }

    public function chat()
    {
        if (!$this->currentSessionId) {
            $this->startNewSession();
        }

        $this->userInputs[] = $this->message;
        $this->saveMessage($this->message, true);

        $client = new Client([
            'base_uri' => 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . env('GEMINI_API_KEY'),
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        try {
            // $systemInstructions = "Anda adalah asisten AI yang membantu, cerdas, baik hati, dan efisien. Anda selalu memenuhi permintaan pengguna dengan sebaik-baiknya. Namamu adalah Deon. Utamakan menjawab pertanyaan dengan bahasa indonesia. ini nama user nya " . Auth::user()->name . ", jangan lupa ucapkan salam atau sambutan ke user jika user mengucapkan salam atau sambutan, jika user tidak mengucapkan salam atau sambutan, tidak usah ucapkan salam.";

            $systemInstructions = SystemInstruction::all();

            $instructionText = '';
            foreach ($systemInstructions as $instruction) {
                $instructionText .= $instruction->instruction . " ";
            }

            $instructionText = str_replace('[USERNAME]' , Auth::user()->name, $instructionText);

            $context = [[ 'text' => $instructionText, ]]; // System instructions
            foreach ($this->userInputs as $userInput) {
                $context[] = ['text' => $userInput];
            }
            foreach ($this->responses as $response) {
                $context[] = ['text' => $response];
            }
            $context[] = ['text' => $this->message];

            $response = $client->post('', [
                RequestOptions::JSON => [
                    'contents' => [
                        [
                            'parts' => $context
                        ]
                    ]
                ],
            ]);

            $unformattedData = json_decode($response->getBody(), true);
            $botMessage = $unformattedData['candidates'][0]['content']['parts'][0]['text'];
            $data = app(MarkdownRenderer::class)->toHtml($botMessage);

            $this->responses[] = $data;
            $this->saveMessage($botMessage, false);

            $this->message = '';

        } catch (\Exception $e) {
            $this->addError('chat', 'There was an error sending your message: ' . $e->getMessage());
        }
    }

    public function startNewSession()
    {
        $session = ChatSession::create(['user_id' => Auth::id()]);
        $this->currentSessionId = $session->id;
    }

    public function saveMessage($message, $isUser)
    {
        ChatMessage::create([
            'session_id' => $this->currentSessionId,
            'message' => $message,
            'is_user' => $isUser,
        ]);
    }

    public function clearChat()
    {
        $this->userInputs = [];
        $this->responses = [];
        $this->message = '';
        $this->startNewSession();
    }
    public function render()
    {
        return view('livewire.chatbot-component-gemini');
    }
}
