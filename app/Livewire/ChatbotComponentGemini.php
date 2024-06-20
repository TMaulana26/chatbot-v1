<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use GuzzleHttp\Client;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\ChatMessage;
use App\Models\ChatSession;
use GuzzleHttp\RequestOptions;
use App\Models\SystemInstruction;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SendChatController;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class ChatbotComponentGemini extends Component
{
    public $message;
    public $userInputs = [];
    public $responses = [];
    public $contentsContext = [];
    public $currentSessionId;

    protected $rules = [
        'message' => 'required',
    ];
    

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
        $this->validate();
        
        if (!$this->currentSessionId) {
            $this->startNewSession();
        }

        $this->userInputs[] = $this->message;
        $this->saveMessage($this->message, true);

        if ($this->message == '/clear') {
            $this->clearChat();
            return;
        }

        if ($this->message == '/masuk' || $this->message == '/keluar') {
            $this->handleAbsen();
            return;
        }

        $sendChatController = new SendChatController();

        $data = $sendChatController->fetchData();
        $instructionText = $sendChatController->prosessInstruction($data['systemInstructions'], $data['employeeData'], $data['departmentData'], $data['departmentTasksData'], $data['attendanceData']);

        // dd($instructionText);

        $systemInstructionContext = [
            [
                'text' => $instructionText,
            ]
        ];
        $userInputs = $this->userInputs;
        $responses = $this->responses;
        $maxLength = max(count($userInputs), count($responses));

        for ($i = 0; $i < $maxLength; $i++) {
            if (isset($userInputs[$i])) {
                $contentsContext[] = ['text' => Auth::user()->employee->name . " : " . $userInputs[$i]];
            }
            if (isset($responses[$i])) {
                $contentsContext[] = ['text' => "Deon : " . $responses[$i]];
            }
        }
        $contentsContext[] = ['text' => $this->message];

        $requestPayload = [
            'system_instruction' => [
                'parts' => $systemInstructionContext
            ],
            'contents' => [
                'parts' => $contentsContext
            ]
        ];



        $unformattedData = $sendChatController->callApi($requestPayload);
        $botMessage = $unformattedData['candidates'][0]['content']['parts'][0]['text'];
        $data = app(MarkdownRenderer::class)->toHtml($botMessage);

        $this->responses[] = $data;
        $this->saveMessage($data, false);

        $this->message = '';
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

    public function handleAbsen()
    {
        $user = Auth::user();
        $now = Carbon::now('Asia/Jakarta');
        $todayAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('check_in_time', Carbon::today('Asia/Jakarta'))
            ->first();

        if ($this->message == '/masuk') {
            $checkInDeadline = Carbon::createFromTime(9, 0, 0, 'Asia/Jakarta');
            if ($now->greaterThanOrEqualTo($checkInDeadline)) {
                $this->responses[] = 'Anda hanya bisa absen sebelum pukul 09:00.';
            } elseif ($todayAttendance) {
                $this->responses[] = 'Anda sudah absen hari ini.';
            } else {
                $attendance = Attendance::create([
                    'user_id' => $user->id,
                    'check_in_time' => $now,
                ]);
                $this->responses[] = 'Berhasil absen. Check-in time: ' . $attendance->check_in_time;
            }
        }

        if ($this->message == '/keluar') {
            $checkOutStartTime = Carbon::createFromTime(17, 0, 0, 'Asia/Jakarta');
            if ($now->lessThanOrEqualTo($checkOutStartTime)) {
                $this->responses[] = 'Anda hanya bisa check-out setelah pukul 17:00.';
            } elseif ($todayAttendance && !$todayAttendance->check_out_time) {
                $todayAttendance->update([
                    'check_out_time' => $now,
                ]);
                $this->responses[] = 'Berhasil check-out. Check-out time: ' . $todayAttendance->check_out_time;
            } elseif ($todayAttendance && $todayAttendance->check_out_time) {
                $this->responses[] = 'Anda sudah check-out hari ini.';
            } else {
                $this->responses[] = 'Anda belum absen hari ini.';
            }
        }

        $this->saveMessage(end($this->responses), false);
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.chatbot-component-gemini');
    }
}
