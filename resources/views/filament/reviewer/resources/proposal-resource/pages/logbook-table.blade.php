<div>
    <h2 class="text-xl font-bold mb-4">Logbook Pelaksanaan Bantuan</h2>

    <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2 font-medium">No</th>
                    <th class="px-4 py-2 font-medium">Tanggal</th>
                    <th class="px-4 py-2 font-medium">Tempat</th>
                    <th class="px-4 py-2 font-medium">Kegiatan (Teknik)</th>
                    <th class="px-4 py-2 font-medium">Deskripsi</th>
                    <th class="px-4 py-2 font-medium">Berkas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($logbooks as $logbook)
                    <tr class="dark:bg-gray-900">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $logbook->tanggal->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">{{ $logbook->tempat }}</td>
                        <td class="px-4 py-2">{{ $logbook->nama_kegiatan }}</td>
                        <td class="px-4 py-2">{{ $logbook->deskripsi }}</td>
                        <td class="px-4 py-2">
                            {{-- Cek jika ada file terlampir --}}
                            @if ($logbook->file_path)
                                <a href="{{ Storage::url($logbook->file_path) }}" target="_blank"
                                    class="text-primary-600 hover:underline">
                                    Lihat berkas
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center px-4 py-12 text-gray-500">
                            Peneliti belum mengisi logbook.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
