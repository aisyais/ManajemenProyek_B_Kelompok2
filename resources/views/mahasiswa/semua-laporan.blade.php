<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Laporan Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { 
            margin: 0; 
            font-family: "Poppins", sans-serif; 
            background: linear-gradient(to bottom, #0d2b52, #7c0018);
            min-height: 100vh;          
            background-repeat: no-repeat; 
            background-attachment: fixed;
            color: #333; }
        .container { 
            width: 90%; 
            max-width: 900px; 
            margin: 30px auto; }
        .header { display: flex; justify-content: space-between; align-items: center; color: white; margin-bottom: 20px; }
        .back-btn { background: white; border: none; padding: 8px 18px; border-radius: 20px; cursor: pointer; font-weight: 500; text-decoration: none; color: black; }
        
        .report-card { display: flex; gap: 15px; background: white; padding: 20px; border-radius: 15px; margin-bottom: 25px; }
        .avatar { width: 45px; height: 45px; border-radius: 50%; }
        .report-header { display: flex; justify-content: space-between; width: 100%; margin-bottom: 5px; }
        
        .status { font-size: 13px; font-weight: bold; display: flex; align-items: center; gap: 3px; }
        .status.pending { color: orange; }
        .status.proses { color: blue; }
        .status.selesai { color: green; }

        .username { font-weight: 600; font-size: 15px; }
        .date { font-size: 12px; color: gray; }
        .content { margin-top: 8px; font-size: 14px; }
        .faculty { margin-top: 10px; font-weight: 500; font-size: 13px; color: gray; font-style: italic; }
        
        /* Kotak Balasan Admin */
        .admin-reply { margin-top: 15px; background: #f1f8ff; padding: 15px; border-radius: 10px; border-left: 5px solid #0d2b52; }
        .admin-reply strong { color: #0d2b52; display: block; margin-bottom: 5px; }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <div>
            <strong>Halo {{ Auth::user()->name }}</strong><br>
            Berikut adalah riwayat laporan Anda
        </div>
        <a href="{{ route('mahasiswa.dashboard') }}" class="back-btn">Kembali</a>
    </div>

    @if($laporans->isEmpty())
        <div style="text-align: center; color: white; margin-top: 50px;">
            <h3>Belum ada laporan yang Anda kirim.</h3>
        </div>
    @endif

    @foreach($laporans as $laporan)
    <div class="report-card">
        <img src="https://ui-avatars.com/api/?name={{ $laporan->nama }}&background=random" class="avatar" alt="avatar">

        <div style="width:100%;">
            <div class="report-header">
                <div>
                    <div class="username">{{ $laporan->nama }}</div>
                    <div class="date">{{ $laporan->created_at->format('d M Y, H:i') }}</div>
                </div>

                @if($laporan->status == 'pending')
                    <div class="status pending">⏳ Pending</div>
                @elseif($laporan->status == 'proses')
                    <div class="status proses">🔄 Diproses</div>
                @else
                    <div class="status selesai">✔ Selesai</div>
                @endif
            </div>

            <div class="content">
                {{ $laporan->isi }}
            </div>

            <div class="faculty">— {{ $laporan->nama }}, {{ $laporan->fakultas }}</div>

            @if($laporan->tanggapan)
                <div class="admin-reply">
                    <strong>💬 Balasan Admin:</strong>
                    {{ $laporan->tanggapan->isi_tanggapan }}
                </div>
            @endif
        </div>
    </div>
    @endforeach

</div>

</body>
</html>