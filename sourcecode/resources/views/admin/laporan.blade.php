<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Semua Laporan - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; background: #f5f8fa; }
        
        /* --- LAYOUT SIDEBAR --- */
        .sidebar { 
            width: 260px; height: 100vh; position: fixed; left: 0; top: 0; 
            background: linear-gradient(180deg, #0d2b52 0%, #7c0018 100%); 
            color: white; padding-top: 20px; z-index: 100;
        }
        
        .logo { padding: 0 25px; margin-bottom: 40px; display: flex; align-items: center; gap: 8px; }
        .logo-text { font-size: 18px; font-weight: bold; margin-left: 5px; }

        /* Menu Sidebar */
        .menu-item { 
            padding: 15px 25px; display: flex; align-items: center; gap: 10px;
            color: rgba(255,255,255,0.7); text-decoration: none; font-size: 15px; font-weight: 500; 
            transition: 0.3s; margin-bottom: 5px;
        }
        
        /* Active State */
        .menu-item.active { 
            background: #f5f8fa; color: #333; 
            border-radius: 30px 0 0 30px; 
            margin-left: 15px; padding-left: 20px; font-weight: 700;
            box-shadow: -5px 5px 10px rgba(0,0,0,0.1);
        }
        .menu-item:hover:not(.active) { color: white; transform: translateX(5px); }

        /* Tombol Kembali Sidebar */
        .btn-back-sidebar { position: absolute; bottom: 30px; width: 100%; text-align: center; }
        .btn-back-sidebar a {
            background: rgba(255,255,255,0.15); padding: 10px 25px; border-radius: 30px; 
            color: white; text-decoration: none; font-size: 14px; font-weight: 500;
            backdrop-filter: blur(5px); transition: 0.3s;
        }
        .btn-back-sidebar a:hover { background: rgba(255,255,255,0.3); }

        /* --- CONTENT AREA --- */
        .content { margin-left: 260px; padding: 30px; }

        /* Header */
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; }
        .header h2 { margin: 0; font-size: 28px; font-weight: 700; color: #333; }
        .user-profile { display: flex; align-items: center; gap: 15px; }
        .logout-btn { 
            background: white; border: 1px solid #ddd; padding: 8px 20px; 
            border-radius: 30px; text-decoration: none; color: #333; 
            font-size: 13px; font-weight: 600; transition: 0.3s; cursor: pointer;
        }
        .logout-btn:hover { background: #fee; border-color: #fab; color: #d00; }

        /* --- TABEL MODERN --- */
        .table-wrapper {
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.03);
            border: 1px solid #eee;
            padding: 25px;
        }
        
        .table-header { margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .table-header h3 { margin: 0; font-size: 18px; color: #333; }

        table { width: 100%; border-collapse: separate; border-spacing: 0; }
        
        /* Header Kolom */
        th { 
            text-align: left; padding: 18px 15px; 
            color: #666; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        /* Isi Baris */
        td { 
            padding: 18px 15px; 
            border-bottom: 1px solid #f9f9f9; 
            vertical-align: middle; font-size: 14px; color: #444;
        }
        
        /* Efek Hover Baris */
        tr:hover td { background-color: #fcfcfc; }
        
        /* Styling Badge Fakultas */
        .badge-fakultas {
            background: #f0f0f0; padding: 5px 10px; border-radius: 6px;
            font-size: 12px; font-weight: 600; color: #555;
        }

        /* Styling Dropdown Status */
        .custom-select {
            padding: 8px 12px; border-radius: 8px; border: 1px solid #ddd;
            background: white; font-size: 13px; color: #555; cursor: pointer; outline: none;
            transition: 0.2s; width: 100%;
        }
        .custom-select:hover { border-color: #aaa; }
        
        /* Helper Classes untuk Warna Border Status */
        .status-pending { border-left: 4px solid #f1c40f !important; }
        .status-proses  { border-left: 4px solid #3498db !important; }
        .status-selesai { border-left: 4px solid #2ecc71 !important; }

        /* Tombol Aksi (Icon) */
        .action-group { display: flex; align-items: center; gap: 8px; }
        
        .btn-icon {
            width: 35px; height: 35px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            text-decoration: none; transition: 0.2s; border: none; cursor: pointer;
            font-size: 14px;
        }
        .btn-reply { background: #e3f2fd; color: #1976d2; } 
        .btn-reply:hover { background: #2196f3; color: white; }
        
        .btn-delete { background: #ffebee; color: #c62828; } 
        .btn-delete:hover { background: #ef5350; color: white; }

    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/Tadulapor.png') }}" alt="TaduLapor" style="height: 40px; width: auto;">
            
            <img src="{{ asset('images/untad.png') }}" alt="Untad" style="height: 38px; width: auto;">

            <div class="logo-text">TaduLapor</div>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="menu-item">
            <i class="fas fa-desktop"></i> Dashboard
        </a>
        
        <a href="{{ route('admin.laporan') }}" class="menu-item active">
            <i class="fas fa-file-alt"></i> Laporan
        </a>

        <div class="btn-back-sidebar">
            <a href="/">Kembali</a>
        </div>
    </div>

    <div class="content">
        
        <div class="header">
            <h2>Semua Laporan</h2>
            <div class="user-profile">
                <div style="text-align: right;">
                    <div style="font-weight: bold; color: #333;">Halo, Admin</div>
                    <div style="font-size: 12px; color: gray;">{{ Auth::user()->name }}</div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>

        <div class="table-wrapper">
            <div class="table-header">
                <h3>Daftar Lengkap Aspirasi Mahasiswa</h3>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Nama & Fakultas</th>
                        <th>Isi Laporan</th>
                        <th width="15%">Status</th>
                        <th width="12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporans as $laporan)
                    <tr>
                        <td style="text-align: center; color: #888;">{{ $loop->iteration }}</td>
                        <td>
                            <div style="font-weight: 600; color: #333;">{{ $laporan->nama }}</div>
                            <div style="margin-top: 5px;">
                                <span class="badge-fakultas">{{ $laporan->fakultas }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="line-height: 1.5; color: #555;">
                                {{ $laporan->isi }} </div>
                            <div style="font-size: 11px; color: #999; margin-top: 6px;">
                                <i class="far fa-clock"></i> {{ $laporan->created_at->format('d M Y, H:i') }}
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('status.update', $laporan->id) }}" method="POST">
                                @csrf
                                <select name="status" onchange="this.form.submit()" 
                                    class="custom-select status-{{ $laporan->status }}">
                                    
                                    <option value="pending" {{ $laporan->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                    <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>🔄 Proses</option>
                                    <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.balas', $laporan->id) }}" class="btn-icon btn-reply" title="Balas">
                                    <i class="fas fa-reply"></i>
                                </a>
                                
                                <a href="{{ route('laporan.hapus', $laporan->id) }}" class="btn-icon btn-delete" title="Hapus" onclick="return confirm('Hapus laporan ini?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>