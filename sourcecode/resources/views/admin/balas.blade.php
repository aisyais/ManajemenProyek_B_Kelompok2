<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Balas Laporan - Admin</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: linear-gradient(to bottom, #103B67, #7A0010); }
        .header { display: flex; align-items: center; padding: 25px 40px; color: white; gap: 15px; }
        
        .container { width: 60%; background: white; margin: 30px auto; padding: 25px; border-radius: 12px; }
        
        .back-btn { background: #E5E4E2; padding: 10px 22px; border-radius: 10px; display: inline-block; font-weight: bold; margin-bottom: 20px; text-decoration: none; color: black; }
        
        /* Kotak Laporan Mahasiswa */
        .report-box { background: #D9D9D9; padding: 20px; border-radius: 10px; }
        .user-info { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
        .avatar { width: 42px; height: 42px; border-radius: 50%; background: #ccc; }
        
        /* Kotak Balasan */
        .reply-box { background: #f0f0f0; padding: 25px; border-radius: 10px; margin-top: 22px; border: 1px solid #ccc; }
        .reply-input { width: 100%; padding: 15px; border-radius: 10px; border: 1px solid #ccc; outline: none; font-size: 15px; box-sizing: border-box; font-family: sans-serif; }
        
        .send-btn { float: right; margin-top: 15px; background: #5A0B0B; border: none; padding: 12px 20px; border-radius: 8px; cursor: pointer; color: white; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <div>
            <div class="title" style="font-size: 28px; font-weight: bold;">TaduLapor</div>
            <div class="subtitle">Halaman Respon Admin</div>
        </div>
    </div>

    <div class="container">

        <a href="{{ route('admin.dashboard') }}" class="back-btn">Kembali ke Dashboard</a>

        <div class="report-box">
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name={{ $laporan->nama }}" class="avatar">
                <div>
                    <b>{{ $laporan->nama }}</b> <br>
                    <small>{{ $laporan->created_at->format('d M Y, H:i') }}</small>
                </div>
            </div>

            <div class="report-text" style="line-height: 1.5;">
                {{ $laporan->isi }}
            </div>

            <div style="margin-top: 15px; font-style: italic; color: #555;">
                — Fakultas {{ $laporan->fakultas }}
            </div>
        </div>

        <div class="reply-box">
            <h4 style="margin-top: 0;">Balasan Anda:</h4>
            
            <form action="{{ route('admin.balas.store', $laporan->id) }}" method="POST">
                @csrf
                
                <textarea name="isi_balasan" class="reply-input" rows="5" placeholder="Ketik tanggapan Anda di sini..." required></textarea>

                <button type="submit" class="send-btn">
                    Kirim Tanggapan ✈️
                </button>
                <div style="clear: both;"></div>
            </form>
        </div>

    </div>

</body>
</html>