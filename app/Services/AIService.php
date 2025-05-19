<?php

namespace App\Services;

use OpenAI\Factory;
use OpenAI\Client;

class AIService
{
    protected Client $client;

    public function __construct()
    {
        // Instantiate OpenAI client via Factory
        $this->client = (new Factory())
            ->withApiKey(config('services.openai.key'))
            ->withOrganization(config('services.openai.organization'))
            ->withProject(config('services.openai.project'))
            ->make();
    }

    public function ask(string $question): string
    {
        $response = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => "Répond brièvement à la question suivante : {$question}"],
            ],
        ]);

        return trim($response->choices[0]->message->content ?? '');
    }

    public function generateQCM(string $subject): array
    {
        $prompt = "Génère une question à choix multiples sur \"{$subject}\", 4 options (A–D) et indique la bonne réponse.";
        $response = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $content = trim($response->choices[0]->message->content ?? '');
        // parse en array: question, options et answer
        // Format attendu: Question:...\nA. ...\nB. ...\nC. ...\nD. ...\nRéponse: X
        return explode("\n", $content);
    }

    public function generateQuiz(string $topic, int $count = 5): array
    {
        $prompt = "Crée un quiz de {$count} questions variées (QCM + réponses ouvertes) sur \"{$topic}\".";
        $response = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return explode("\n", trim($response->choices[0]->message->content ?? ''));
    }
}
