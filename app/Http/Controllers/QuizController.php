    public function submit(Request $request, Quiz $quiz)
    {
        $user = auth()->user();
        $score = $this->calculateQuizScore($request->answers, $quiz);
        
        // Sauvegarde de la tentative
        $attempt = $quiz->attempts()->create([
            'user_id' => $user->id,
            'score' => $score,
            'completed_at' => now()
        ]);

        // Attribution d'expérience basée sur le score
        $baseExperience = 100; // Points de base pour avoir terminé le quiz
        $bonusExperience = ($score / 100) * 200; // Bonus basé sur le score (max 200 points)
        $totalExperience = $baseExperience + $bonusExperience;
        
        $user->addExperience((int)$totalExperience, "Quiz terminé : {$quiz->title} - Score : {$score}%");

        // Si le quiz est réussi
        if ($score >= $quiz->passing_score) {
            event(new QuizCompleted($user, $quiz, $score));
        }

        return redirect()->route('courses.show', $quiz->course)
            ->with('success', "Quiz terminé ! Score : {$score}%");
    }