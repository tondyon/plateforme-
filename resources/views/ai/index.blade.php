@extends('layouts.app')

@section('title', 'Assistant IA')

@section('content')
<div class = "container mx-auto px-4 py-8">
<h1  class = "text-2xl font-bold mb-6">Assistant IA</h1>
<div class = "bg-white p-6 rounded-lg shadow-lg">
<div class = "grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label  class = "block mb-2 font-medium">Question libre</label>
                <input  id    = "ai-question" type = "text" class = "w-full border-gray-300 rounded px-3 py-2" placeholder = "Posez votre question">
                <button id    = "btn-ask" class    = "mt-2 w-full bg-blue-600 text-white px-4 py-2 rounded">Envoyer</button>
            </div>
            <div>
                <label  class = "block mb-2 font-medium">Générateur de QCM</label>
                <input  id    = "ai-subject" type = "text" class = "w-full border-gray-300 rounded px-3 py-2" placeholder = "Sujet du QCM">
                <button id    = "btn-qcm" class   = "mt-2 w-full bg-green-600 text-white px-4 py-2 rounded">Générer QCM</button>
            </div>
            <div>
                <label  class = "block mb-2 font-medium">Générateur de Quiz</label>
                <input  id    = "ai-topic" type  = "text" class   = "w-full border-gray-300 rounded px-3 py-2 mb-2" placeholder = "Sujet du Quiz">
                <input  id    = "ai-count" type  = "number" value = "5" min                                                     = "1" class = "w-full border-gray-300 rounded px-3 py-2 mb-2">
                <button id    = "btn-quiz" class = "w-full bg-purple-600 text-white px-4 py-2 rounded">Générer Quiz</button>
            </div>
        </div>
        <div id = "ai-output" class = "bg-gray-100 p-4 rounded-lg min-h-[150px] flex items-center justify-center text-gray-800"></div>

        <div    class = "flex items-center gap-4 mt-6">
        <button id    = "btn-export-pdf" class    = "bg-red-600 text-white px-4 py-2 rounded">Exporter PDF</button>
        <button id    = "btn-clear-history" class = "bg-gray-600 text-white px-4 py-2 rounded">Vider historique</button>
        </div>

        <div id = "ai-history" class = "mt-6 space-y-4"></div>
    </div>
</div>
@endsection

@push('scripts')
<script src = "https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const token       = document.querySelector('meta[name="csrf-token"]').content;
        const STORAGE_KEY = 'ai_history_storage';

        loadHistoryFromLocalStorage();

        async function callAI(url, data) {
            try {
                const response = await fetch(url, {
                    method : 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                    body   : JSON.stringify(data)
                });
                if (!response.ok) throw new Error(`HTTP ${response.status}: ${await response.text()}`);
                return await response.json();
            } catch (err) {
                return { error: err.message };
            }
        }

        function showLoading() {
            document.getElementById('ai-output').innerHTML = `
                <div class = "flex justify-center items-center space-x-2">
                <div class = "w-6 h-6 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                    <span>Chargement...</span>
                </div>`;
        }

        function handleAIRequest(buttonId, inputIds, route, payloadBuilder, formatter) {
            document.getElementById(buttonId).onclick = async () => {
                const inputs = inputIds.map(id => document.getElementById(id));
                const values = inputs.map(input => input.value.trim());
                if (values.some(v => !v)) {
                    Swal.fire('Attention', 'Veuillez remplir tous les champs.', 'warning');
                    return;
                }

                showLoading();
                inputs.forEach(input => input.disabled = true);
                document.getElementById(buttonId).disabled = true;

                const res = await callAI(route, payloadBuilder(...values));

                inputs.forEach(input => input.disabled = false);
                document.getElementById(buttonId).disabled = false;

                if (res.error) {
                    Swal.fire('Erreur', res.error, 'error');
                    document.getElementById('ai-output').innerHTML = '';
                } else {
                    Swal.fire('Succès', 'Contenu généré.', 'success');
                    const                   answer                   = formatter(res);
                    document.getElementById('ai-output').textContent = answer;
                    addToHistory(`Requête : ${values.join(' / ')}`, answer);
                }
            };
        }

        function addToHistory(question, answer) {
            const history = document.getElementById('ai-history');
            const card = document.createElement('div');
            card.className = 'bg-white shadow p-4 rounded-lg';
            card.innerHTML = `
                <div class="text-sm text-gray-500 mb-2">${question}</div>
                <pre class="whitespace-pre-wrap text-gray-800">${answer}</pre>
            `;
            history.prepend(card);
            saveHistoryToLocalStorage();
        }

        function saveHistoryToLocalStorage() {
            const history = document.getElementById('ai-history');
            const items = Array.from(history.querySelectorAll('div')).map(card => ({
                question: card.querySelector('div').innerText,
                answer: card.querySelector('pre').innerText
            }));
            localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
        }

        function loadHistoryFromLocalStorage() {
            const saved = localStorage.getItem(STORAGE_KEY);
            if (saved) {
                try {
                    JSON.parse(saved).forEach(item => addToHistory(item.question, item.answer));
                } catch (e) {
                    console.error('Erreur chargement historique:', e);
                }
            }
        }

        document.getElementById('btn-export-pdf').onclick = () => {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            const history = document.getElementById('ai-history');
            const cards = history.querySelectorAll('div');

            if (cards.length === 0) {
                Swal.fire('Information', 'Aucune requête à exporter.', 'info');
                return;
            }

            let y = 10;
            doc.setFontSize(16);
            doc.text("Historique des requêtes IA", 10, y);
            y += 10;
            doc.setFontSize(12);

            cards.forEach((card, index) => {
                const title = card.querySelector('div').innerText;
                const content = card.querySelector('pre').innerText;
                const text = `${index + 1}. ${title}\n${content}\n\n`;
                const splitText = doc.splitTextToSize(text, 180);
                if (y + splitText.length * 7 > 280) {
                    doc.addPage();
                    y = 10;
                }
                doc.text(splitText, 10, y);
                y += splitText.length * 7;
            });

            doc.save('Historique_IA.pdf');
        };

        document.getElementById('btn-clear-history').onclick = () => {
            Swal.fire({
                title: 'Effacer l\'historique ?',
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, effacer',
                cancelButtonText: 'Annuler'
            }).then(result => {
                if (result.isConfirmed) {
                    localStorage.removeItem(STORAGE_KEY);
                    document.getElementById('ai-history').innerHTML = '';
                    Swal.fire('Effacé !', 'L\'historique a été vidé.', 'success');
                }
            });
        };

        handleAIRequest('btn-ask', ['ai-question'], '{{ route("ai.ask") }}',
            (q) => ({ question: q }),
            (res) => res.answer
        );

        handleAIRequest('btn-qcm', ['ai-subject'], '{{ route("ai.qcm") }}',
            (s) => ({ subject: s }),
            (res) => res.qcm.join('\n')
        );

        handleAIRequest('btn-quiz', ['ai-topic', 'ai-count'], '{{ route("ai.quiz") }}',
            (t, c) => ({ topic: t, count: parseInt(c) || 5 }),
            (res) => res.quiz.join('\n\n')
        );
    });
</script>
@endpush
