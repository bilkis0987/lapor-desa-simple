<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #16a34a; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        h1 { text-align: center; color: #166534; }
        .status { padding: 3px 8px; border-radius: 4px; font-size: 10px; }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Pelapor</th>
                <th>Kategori</th>
                <th>Prioritas</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->id }}</td>
                    <td>{{ $complaint->title }}</td>
                    <td>{{ $complaint->complainant_name }}</td>
                    <td>{{ $complaint->category->name }}</td>
                    <td>{{ ucfirst($complaint->priority) }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $complaint->status)) }}</td>
                    <td>{{ $complaint->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center">Tidak ada data pengaduan.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
