    protected function schedule(Schedule $schedule)
    {
        // ...existing scheduled tasks...

        // Nettoyer les anciennes vérifications de certificats tous les premiers du mois
        $schedule->command('certificates:cleanup')
            ->monthly()
            ->at('00:00')
            ->emailOutputTo('admin@example.com');

        // ...existing scheduled tasks...
