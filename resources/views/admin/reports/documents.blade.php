@extends('layouts.admin')

@section('title', 'Statistik Produk Hukum')

@push('styles')
    <style>
        @media print {
            aside, header, #impersonate-banner, .visit-site-btn, .export-btn { display: none !important; }
            main { margin-left: 0 !important; width: 100% !important; height: auto !important; overflow: visible !important; }
            body { background: white !important; height: auto !important; overflow: visible !important; }
            .shadow-sm, .shadow-lg, .shadow-xl { shadow: none !important; border: 1px solid #e2e8f0 !important; }
            .bg-slate-50\/50 { background: #f8fafc !important; border-bottom: 1px solid #e2e8f0 !important; }
        }
    </style>
@endpush

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <div class="flex items-center gap-2 text-islami mb-2">
            <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-1 text-[10px] font-black uppercase tracking-widest hover:underline">
                <i data-lucide="arrow-left" class="w-3 h-3"></i> Kembali
            </a>
        </div>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Analisis Produk Hukum</h2>
        <p class="text-slate-500 mt-1">Laporan distribusi dokumen berdasarkan tahun dan jenis klaster.</p>
    </div>
    <div class="flex items-center gap-3">
        <button onclick="window.print()" class="px-6 py-3 bg-slate-900 text-white rounded-xl font-bold flex items-center gap-2 hover:scale-105 transition-all shadow-lg export-btn">
            <i data-lucide="download" class="w-5 h-5"></i>
            Cetak & Ekspor
        </button>
    </div>
</div>

<!-- Narrative Section -->
<div class="mb-10 p-8 bg-slate-900 text-white rounded-3xl shadow-xl shadow-slate-200">
    <div class="flex items-start gap-6">
        <div class="bg-white/10 p-4 rounded-2xl">
            <i data-lucide="trending-up" class="w-8 h-8 text-white"></i>
        </div>
        <div>
            <h4 class="text-xl font-bold">Narasi Analisis Tren</h4>
            <p class="mt-3 text-slate-300 leading-relaxed text-sm">
                Analisis data longitudinal menunjukkan pertumbuhan berkelanjutan dalam volume publikasi digital JDIH. 
                Terdapat konsentrasi tinggi pada kategori <strong>{{ array_key_first($typeStats->toArray()) }}</strong> yang mencakup <strong>{{ number_format($typeStats->first()) }}</strong> dokumen. 
                Puncak publikasi tercatat pada periode tahun <strong>{{ $yearlyStats->first()->doc_year ?? 'N/A' }}</strong>, mencerminkan intensitas regulasi pada periode tersebut.
            </p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
    <!-- Yearly Distribution Chart -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden h-full">
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h4 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Tren Publikasi Tahunan</h4>
                <div class="flex items-center gap-2 text-slate-400">
                    <i data-lucide="line-chart" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="p-8">
                <div class="h-80">
                    <canvas id="yearlyDocChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Type Mix Table -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                <h4 class="font-bold text-slate-900">Distribusi Jenis</h4>
                <i data-lucide="layers" class="w-4 h-4 text-slate-400"></i>
            </div>
            <div class="p-4">
                <div class="space-y-1">
                    @foreach($typeStats as $name => $count)
                    <div class="flex items-center justify-between p-4 hover:bg-slate-50 rounded-xl transition-all border border-transparent hover:border-slate-100">
                        <span class="text-xs font-bold text-slate-600 truncate mr-4">{{ $name }}</span>
                        <span class="px-3 py-1 bg-slate-900 text-white rounded-lg text-[10px] font-black tracking-widest">{{ $count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bg-islami p-8 rounded-2xl text-white relative overflow-hidden group shadow-xl shadow-green-100">
             <div class="absolute -right-4 -bottom-4 opacity-20 group-hover:scale-110 transition-transform duration-500">
                  <i data-lucide="award" class="w-32 h-32 text-white"></i>
             </div>
             <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-2 opacity-80">JDIH Excellence</p>
             <h3 class="text-xl font-bold leading-tight">Sistem Pengelolaan Dokumen Hukum Terpadu</h3>
             <p class="text-xs mt-4 leading-relaxed opacity-80">Data ini digunakan untuk evaluasi kinerja publikasi bulanan dan tahunan UIN Siber Syekh Nurjati.</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('yearlyDocChart').getContext('2d');
        const yearlyData = @json($yearlyStats);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: yearlyData.map(d => d.doc_year).reverse(),
                datasets: [{
                    label: 'Produk Hukum',
                    data: yearlyData.map(d => d.total).reverse(),
                    borderColor: '#0F9D58',
                    backgroundColor: 'rgba(15, 157, 88, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#0F9D58',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5] }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    });
</script>
@endpush
