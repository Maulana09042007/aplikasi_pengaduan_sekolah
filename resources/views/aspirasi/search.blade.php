<hr class="my-6">

<div class="bg-gray-50 border rounded-lg p-4">
    <h2 class="text-lg font-semibold mb-3 text-center">
        Cek Status Aspirasi
    </h2>

    <form method="GET" action="{{ route('aspirasi.create') }}" class="space-y-3">
        <input
            name="nis"
            value="{{ request('nis') }}"
            class="w-full border p-2 rounded"
            placeholder="Masukkan NIS"
            required
        >

        <button
            class="w-full bg-gray-700 hover:bg-gray-800 text-white py-2 rounded transition"
        >
            Cari Aspirasi
        </button>
    </form>

    @if(isset($aspirasis) && $aspirasis->count())
        <div class="mt-4 overflow-x-auto">
            <table class="w-full text-sm border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border p-2">Kategori</th>
                        <th class="border p-2">Lokasi</th>
                        <th class="border p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aspirasis as $aspirasi)
                        <tr class="text-center">
                            <td class="border p-2">
                                {{ $aspirasi->kategori->ket_kategori }}
                            </td>
                            <td class="border p-2">
                                {{ $aspirasi->lokasi }}
                            </td>
                            <td class="border p-2 font-semibold
                                @if($aspirasi->status === 'Menunggu') text-yellow-600
                                @elseif($aspirasi->status === 'Proses') text-blue-600
                                @else text-green-600
                                @endif
                            ">
                                {{ $aspirasi->status }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif(request('nis'))
        <p class="mt-4 text-center text-gray-500 text-sm">
            Data aspirasi tidak ditemukan.
        </p>
    @endif
</div>
