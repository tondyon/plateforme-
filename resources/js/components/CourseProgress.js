export default {
    data() {
        return {
            progress: 0,
            isUpdating: false,
            error: null
        }
    },

    props: {
        courseId: {
            type: Number,
            required: true
        },
        initialProgress: {
            type: Number,
            default: 0
        }
    },

    mounted() {
        this.progress = this.initialProgress;
    },

    methods: {
        async updateProgress(newProgress) {
            if (this.isUpdating) return;
            
            this.isUpdating = true;
            this.error = null;

            try {
                const response = await fetch(`/courses/${this.courseId}/progress`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ progress: newProgress })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Erreur lors de la mise à jour de la progression');
                }

                this.progress = newProgress;

                // Si le cours est terminé, actualiser la page pour afficher le certificat
                if (newProgress === 100) {
                    window.location.reload();
                }

            } catch (error) {
                this.error = error.message;
                console.error('Erreur:', error);
            } finally {
                this.isUpdating = false;
            }
        }
    }
}