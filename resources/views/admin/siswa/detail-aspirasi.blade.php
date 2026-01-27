<div id="detail-{{ $aspirasi->id }}" class="detail-card hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeCard()"></div>
    <div class="bg-white rounded-xl shadow-2xl p-6 max-w-md w-11/12 relative z-10 border border-gray-200 card-content opacity-0 scale-95 transition-all duration-200">
        <button onclick="closeCard()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
        <h3 class="text-2xl font-bold mb-4 text-center text-blue-600">Detail Aspirasi</h3>
        <p><strong>NIS:</strong> {{ $aspirasi->siswa->nis ?? '-' }}</p>
        <p><strong>Nama Siswa:</strong> {{ $aspirasi->siswa->nama ?? '-' }}</p>
        <p><strong>Kategori:</strong> {{ $aspirasi->kategori->ket_kategori ?? '-' }}</p>
        <p><strong>Lokasi:</strong> {{ $aspirasi->lokasi ?? '-' }}</p>
        <div class="mt-4">
            <label class="block font-semibold mb-1">Status:</label>
            <select id="status-{{ $aspirasi->id }}" class="w-full border rounded p-2">
                <option value="Menunggu" {{ $aspirasi->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="Diproses" {{ $aspirasi->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="Selesai" {{ $aspirasi->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            <button onclick="updateStatus({{ $aspirasi->id }})" class="mt-2 px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Ubah Status</button>
        </div>
        <div class="mt-4">
            <label class="block font-semibold mb-1">Feedbak User:</label>
            <textarea class="w-full border rounded p-2 bg-gray-100" readonly>{{ $aspirasi->feedback ?? 'Error' }}</textarea>
        </div>
        <form onsubmit="sendFeedback(event, {{ $aspirasi->id }})" class="mt-4">
            <label for="feedback-{{ $aspirasi->id }}" class="block font-semibold mb-1">Feedback Admin :</label>
            <textarea id="feedback-{{ $aspirasi->id }}" class="w-full border rounded p-2" placeholder="Tulis feedback..."></textarea>
            <div class="mt-2 text-center">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700">Kirim Feedback</button>
            </div>
        </form>
        <div class="mt-4 text-center">
            <button onclick="closeCard()" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-full hover:bg-gray-400">Tutup</button>
        </div>
    </div>
</div>

<script>
function closeCard() {
    const card = document.getElementById('detail-{{ $aspirasi->id }}');
    card.classList.add('hidden');
}
function updateStatus(id) {
    const status = document.getElementById('status-' + id).value;
    fetch('/admin/status/' + id + '/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status })
    })
    .then(response => response.json())
    .then(data => {
        alert('Status berhasil diperbarui!');
        location.reload();
    })
    .catch(err => {
        console.error(err);
        alert('Gagal memperbarui status.');
    });
}
function sendFeedback(event, id) {
    event.preventDefault();
    const feedback = document.getElementById('feedback-' + id).value;
    fetch('/admin/feedback/' + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ feedback_user: feedback })
    })
    .then(response => response.json())
    .then(data => {
        alert('Feedback berhasil dikirim!');
        location.reload();
    })
    .catch(err => {
        console.error(err);
        alert('Gagal mengirim feedback.');
    });
}
</script>
