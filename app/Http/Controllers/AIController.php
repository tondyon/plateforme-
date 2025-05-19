<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AIService;

class AIController extends Controller
{
    protected AIService $ai;

    public function __construct(AIService $ai)
    {
        $this->ai = $ai;
    }

    public function index()
    {
        return view('ai.index');
    }

    public function ask(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string',
        ]);
        try {
            $answer = $this->ai->ask($data['question']);
            return response()->json(['answer' => $answer]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function qcm(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string',
        ]);
        try {
            $qcm = $this->ai->generateQCM($data['subject']);
            return response()->json(['qcm' => $qcm]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function quiz(Request $request)
    {
        $data = $request->validate([
            'topic' => 'required|string',
            'count' => 'integer',
        ]);
        try {
            $quiz = $this->ai->generateQuiz($data['topic'], $data['count'] ?? 5);
            return response()->json(['quiz' => $quiz]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
