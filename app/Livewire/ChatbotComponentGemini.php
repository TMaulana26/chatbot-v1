<?php

namespace App\Livewire;

use App\Models\User;
use GuzzleHttp\Client;
use Livewire\Component;
use App\Models\Employee;
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
            $systemInstructions = SystemInstruction::all();
            $getEmployeeData = Employee::all();

            $instructionText = '';
            foreach ($systemInstructions as $instruction) {
                $instructionText .= $instruction->instruction . " ";
            }

            $employeeData = '';
            foreach ($getEmployeeData as $data) {
                $employeeData .= "(Nama : ". $data->name . ", ";
                $employeeData .= "Departermen : ". $data->department_id . ", ";
                $employeeData .= "Jabatan : ". $data->job_title . ", ";
                $employeeData .= "Email : ". $data->email . ", ";
                $employeeData .= "No. HP : ". $data->phone . ", ";
                $employeeData .= "Mulai Kerja : ". $data->hire_date . ", ";
                $employeeData .= "Gaji : ". $data->salary . "). ";
            }
            $instructionText = str_replace('[EMPLOYEE_DATA]' , $employeeData, $instructionText);
            $instructionText = str_replace('[USERNAME]' , Auth::user()->employee->name, $instructionText);

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
            $this->saveMessage($data, false);

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
