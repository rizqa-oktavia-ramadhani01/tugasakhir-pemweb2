<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Raport Perkembangan Anak - {{ $child->nama_anak }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4F46E5;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #4F46E5;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #666;
            margin: 5px 0 0;
        }
        .child-info {
            background: #F8FAFC;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .child-info h3 {
            margin: 0 0 10px;
            color: #333;
        }
        .child-info table {
            width: 100%;
        }
        .child-info td {
            padding: 5px;
        }
        .stats {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }
        .stat-card {
            flex: 1;
            background: linear-gradient(135deg, #4F46E5, #7C3AED);
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }
        .stat-card h2 {
            margin: 0;
            font-size: 28px;
        }
        .stat-card p {
            margin: 5px 0 0;
            font-size: 11px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #4F46E5;
            margin: 20px 0 10px;
            border-left: 4px solid #4F46E5;
            padding-left: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #F1F5F9;
            font-weight: bold;
        }
        .progress-bar {
            background: #E2E8F0;
            border-radius: 10px;
            height: 10px;
            overflow: hidden;
        }
        .progress-fill {
            background: #10B981;
            height: 100%;
            border-radius: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #999;
        }
        .badge {
            display: inline-block;
            background: #10B981;
            color: white;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 10px;
        }
        .word-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .word-item {
            background: #EEF2FF;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>TUTURO</h1>
        <p>Laporan Perkembangan Anak - TEMAN TUMBUH</p>
    </div>

    <div class="child-info">
        <h3>Data Anak</h3>
        <table>
            <tr>
                <td width="30%"><strong>Nama</strong></td>
                <td>{{ $child->nama_anak }}</td>
            </tr>
            <tr>
                <td><strong>Usia</strong></td>
                <td>{{ $child->usia_anak }} Tahun</td>
            </tr>
            <tr>
                <td><strong>Jenis Kelamin</strong></td>
                <td>{{ $child->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Laporan</strong></td>
                <td>{{ $generated_at }}</td>
            </tr>
        </table>
    </div>

    <div class="stats">
        <div class="stat-card">
            <h2>{{ $streak }}</h2>
            <p>Hari Beruntun</p>
        </div>
        <div class="stat-card">
            <h2>{{ $consistencyPercent }}%</h2>
            <p>Konsistensi</p>
        </div>
        <div class="stat-card">
            <h2>{{ $totalSesi }}</h2>
            <p>Total Sesi</p>
        </div>
        <div class="stat-card">
            <h2>{{ $totalJurnal }}</h2>
            <p>Jurnal</p>
        </div>
    </div>

    <div class="section-title">📊 Progres Milestone</div>
    <div style="margin-bottom: 20px;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
            <span>{{ $completedMilestones }} dari {{ $totalMilestones }} milestone tercapai</span>
            <span>{{ $milestonePercent }}%</span>
        </div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: {{ $milestonePercent }}%"></div>
        </div>
    </div>

    <div class="section-title">📋 Aktivitas Harian (30 Hari Terakhir)</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Selesai</th>
                <th>Total</th>
                <th>Progres</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dailyProgress as $day)
            <tr>
                <td>{{ $day['tanggal'] }}</td>
                <td>{{ $day['selesai'] }}</td>
                <td>{{ $day['total'] }}</td>
                <td>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $day['total'] > 0 ? ($day['selesai'] / $day['total']) * 100 : 0 }}%"></div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">📖 Kata Baru yang Dipelajari</div>
    <div class="word-list">
        @forelse($uniqueKataBaru as $kata)
            <span class="word-item">{{ $kata }}</span>
        @empty
            <p>Belum ada kata baru yang dicatat.</p>
        @endforelse
    </div>

    <div class="section-title">📓 Ringkasan Jurnal</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Aktivitas</th>
                <th>Respon Anak</th>
                <th>Kata Baru</th>
            </tr>
        </thead>
        <tbody>
            @forelse($journals as $journal)
            <tr>
                <td>{{ \Carbon\Carbon::parse($journal->tanggal)->format('d/m/Y') }}</td>
                <td>{{ Str::limit($journal->aktivitas_dilakukan, 40) }}</td>
                <td>{{ Str::limit($journal->respon_anak ?? '-', 30) }}</td>
                <td>{{ $journal->kata_baru ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Belum ada jurnal.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dihasilkan secara otomatis oleh sistem TUTURO</p>
        <p>© {{ date('Y') }} TUTURO - Platform Tumbuh Kembang Anak</p>
    </div>
</body>
</html>