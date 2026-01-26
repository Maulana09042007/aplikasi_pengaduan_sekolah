function openCard(id) {
    const card = document.getElementById('detail-' + id);
    if(!card) return;
    card.classList.remove('hidden');
    const content = card.querySelector('.card-content');
    if(content) content.classList.remove('opacity-0','scale-95');
}

function closeCard() {
    document.querySelectorAll('.detail-card').forEach(card => {
        const content = card.querySelector('.card-content');
        if(content){
            content.classList.add('opacity-0','scale-95');
            setTimeout(() => card.classList.add('hidden'), 200);
        } else {
            card.classList.add('hidden');
        }
    });
}

function sendFeedback(event, id) {
    event.preventDefault();
    const feedback = document.getElementById('feedback-' + id).value;
    fetch('/admin/aspirasi/' + id + '/feedback', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ feedback })
    }).then(() => {
        alert('Feedback berhasil dikirim!');
        location.reload();
    }).catch(() => alert('Gagal mengirim feedback.'));
}

function applyFilter() {
    const date = document.getElementById('filter-date').value.toLowerCase();
    const nis = document.getElementById('filter-nis').value.toLowerCase();
    const nama = document.getElementById('filter-nama').value.toLowerCase();
    const kategori = document.getElementById('filter-kategori').value.toLowerCase();

    document.querySelectorAll('#aspirasi-table tbody tr').forEach(row => {
        const tglText = row.cells[0].textContent.toLowerCase();
        const nisText = row.cells[1].textContent.toLowerCase();
        const namaText = row.cells[2].textContent.toLowerCase();
        const katText = row.cells[3].textContent.toLowerCase();

        if(
            (!date || tglText.includes(date)) &&
            (!nis || nisText.includes(nis)) &&
            (!nama || namaText.includes(nama)) &&
            (!kategori || katText.includes(kategori))
        ) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function resetFilter() {
    document.getElementById('filter-date').value = '';
    document.getElementById('filter-nis').value = '';
    document.getElementById('filter-nama').value = '';
    document.getElementById('filter-kategori').value = '';
    applyFilter();
}
