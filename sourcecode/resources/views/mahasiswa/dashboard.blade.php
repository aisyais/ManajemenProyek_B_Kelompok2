<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - TaduLapor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            margin: 0; padding: 0; font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #0c2340 0%, #7b0000 100%);
            min-height: 100vh;
        }
        .container { max-width: 850px; margin: auto; padding: 30px 20px; color: #333; }
        
        /* Header Area */
        .header-top { display: flex; justify-content: space-between; align-items: center; color: white; margin-bottom: 30px; }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .user-info img { width: 50px; height: 50px; border-radius: 50%; border: 2px solid white; }
        .btn-kembali { background: #f0f0f0; color: #333; padding: 8px 20px; border-radius: 20px; text-decoration: none; font-weight: 600; font-size: 14px; border: none; cursor: pointer; }

        h2.page-title { text-align: center; color: white; margin-bottom: 25px; font-weight: 500; letter-spacing: 0.5px; }

        /* Form Styling (Mirip Desain) */
        .form-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .input-group { margin-bottom: 15px; }
        
        /* Input Field Abu-abu & Rounded */
        .custom-input {
            width: 100%;
            padding: 15px 20px;
            background-color: #F5F5F5; /* Abu-abu muda */
            border: none;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            box-sizing: border-box;
            outline: none;
            transition: 0.3s;
        }
        .custom-input:focus { background-color: #EBEBEB; }
        
        /* Textarea khusus */
        textarea.custom-input { resize: vertical; min-height: 120px; }

        /* Tombol Kirim (Icon Pesawat) */
        .btn-submit-container { text-align: right; margin-top: 10px; }
        .btn-send {
            background: #681A1A; /* Merah Marun Gelap */
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-size: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }
        .btn-send:hover { background: #8a2be2; transform: scale(1.05); }

        /* Bar "Komentar Sebelumnya" */
        .history-bar {
            margin-top: 25px;
            background: white;
            padding: 10px 20px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .history-text { color: #666; font-size: 14px; }
        .btn-show-all {
            background: #333; color: white;
            padding: 8px 18px; border-radius: 8px;
            font-size: 12px; text-decoration: none;
        }

        /* Preview Card Riwayat */
        .preview-list { margin-top: 20px; }
        .preview-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
            display: flex; gap: 15px;
        }
        .p-avatar img { width: 40px; height: 40px; border-radius: 50%; }
        .p-content { width: 100%; }
        .p-header { display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 14px; font-weight: bold; }
        .p-status { font-size: 12px; color: #555; }
        .p-body { font-size: 13px; color: #444; margin-bottom: 5px; line-height: 1.5; }
        .p-footer { font-size: 12px; color: gray; font-style: italic; }

        /* Alert */
        .alert { background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; }
    </style>
</head>

<body>

<div class="container">

    <div class="header-top">
        <div class="user-info">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random&color=fff" alt="User">
            <div>
                <div style="font-size: 12px; opacity: 0.8;">Halo {{ Auth::user()->name }}</div>
                <div style="font-weight: 600; font-size: 16px;">Selamat Datang di TaduLapor</div>
            </div>
        </div>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-kembali">Logout</button>
        </form>
    </div>

    <h2 class="page-title">Ayo Sampaikan Aspirasi Anda!</h2>

    @if(session('success'))
        <div class="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="form-card">
        <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="input-group">
                <input type="text" value="{{ Auth::user()->name }}" class="custom-input" readonly style="color: #777; cursor: not-allowed;">
            </div>

            <div class="input-group">
                <input type="text" name="fakultas" placeholder="Fakultas" class="custom-input" required>
            </div>

            <div class="input-group">
                <textarea name="isi" placeholder="Ketik aspirasi atau keluhan Anda di sini..." class="custom-input" required></textarea>
            </div>
            
            <div class="btn-submit-container">
                <button type="submit" class="btn-send" title="Kirim Laporan">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="history-bar">
        <span class="history-text">Beberapa laporan anda sebelumnya</span>
        <a href="{{ route('mahasiswa.riwayat') }}" class="btn-show-all">Show All</a>
    </div>

    <div class="preview-list">
        @foreach($laporans as $laporan)
        <div class="preview-card">
            <div class="p-avatar">
                <img src="https://ui-avatars.com/api/?name={{ $laporan->nama }}&background=random" alt="A">
            </div>
            <div class="p-content">
                <div class="p-header">
                    <span>{{ $laporan->nama }}</span>
                    <span class="p-status">
                        @if($laporan->status == 'pending') ⏳ Pending
                        @elseif($laporan->status == 'proses') 🔄 Diproses
                        @else <span style="color:green">✔ Selesai</span>
                        @endif
                    </span>
                </div>
                <div class="p-body">
                    {{ Str::limit($laporan->isi, 100) }}
                </div>
                <div class="p-footer">
                    — {{ $laporan->fakultas }} &bull; {{ $laporan->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

</body>
</html>