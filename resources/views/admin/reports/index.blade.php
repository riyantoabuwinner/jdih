@extends('layouts.admin')

@section('title', 'Laporan Ringkasan')

@push('styles')
    <style>
        @media print {
            aside, header, #impersonate-banner, .visit-site-btn, .print-btn, .text-print-hide { display: none !important; }
            main { margin-left: 0 !important; width: 100% !important; height: auto !important; overflow: visible !important; }
            body { 
                background: white !important; 
                height: 297mm !important; 
                width: 210mm !important;
                overflow: hidden !important; 
            }
            .bg-islami\/5 { background: #f0fdf4 !important; border: 1px solid #dcfce7 !important; }
            .shadow-sm, .shadow-lg, .shadow-xl { shadow: none !important; border: 1px solid #e2e8f0 !important; }
            .custom-scroll { overflow: visible !important; }
            .print-force-page1 { max-height: 18cm; overflow: hidden; }
        }
    </style>
@endpush

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Pelaporan & Statistik</h2>
        <p class="text-slate-500 mt-1">Pantau performa publikasi dan manajemen JDIH secara real-time.</p>
    </div>
    <div class="flex items-center gap-3">
        <button onclick="window.print()" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold flex items-center gap-2 hover:bg-slate-50 transition-all shadow-sm print-btn">
            <i data-lucide="printer" class="w-5 h-5"></i>
            Cetak Laporan
        </button>
    </div>
</div>

<!-- Narrative Section -->
<div class="mb-10 p-8 bg-islami/5 border border-islami/10 rounded-3xl">
    <div class="flex items-start gap-4">
        <div class="bg-islami p-3 rounded-xl text-white shadow-lg">
            <i data-lucide="info" class="w-6 h-6"></i>
        </div>
        <div>
            <h4 class="text-lg font-bold text-slate-900">Narasi Laporan Ringkasan</h4>
            <p class="text-slate-600 mt-2 leading-relaxed text-sm">
                Berdasarkan data sistem JDIH per tanggal <strong>{{ date('d F Y') }}</strong>, terdapat total <strong>{{ $totalDocuments }}</strong> produk hukum yang telah terarsip secara digital. 
                Penyebaran dokumen terbagi ke dalam <strong>{{ $totalCategories }}</strong> kategori klaster hukum utama. 
                Sistem juga mencatat <strong>{{ $totalFeedbacks }}</strong> masukan dari publik, yang menunjukkan tingkat interaksi masyarakat terhadap dokumentasi hukum yang disajikan.
            </p>
        </div>
    </div>
</div>

<!-- Stats Overview (Strict One Row) -->
<div class="flex flex-row gap-6 mb-10 w-full">
    <div class="flex-1 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
        <p class="text-[9px] font-black uppercase text-slate-400 tracking-[0.2em] mb-1">Total Produk</p>
        <h3 class="text-3xl font-black text-slate-900">{{ number_format($totalDocuments) }}</h3>
    </div>

    <div class="flex-1 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
        <p class="text-[9px] font-black uppercase text-slate-400 tracking-[0.2em] mb-1">Kategori</p>
        <h3 class="text-3xl font-black text-slate-900">{{ number_format($totalCategories) }}</h3>
    </div>

    <div class="flex-1 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
        <p class="text-[9px] font-black uppercase text-slate-400 tracking-[0.2em] mb-1">Feedback</p>
        <h3 class="text-3xl font-black text-slate-900">{{ number_format($totalFeedbacks) }}</h3>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-10 print-force-page1">
    <!-- Chart: Daily Publications -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full ring-1 ring-slate-100">
        <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h4 class="font-bold text-slate-900 text-[11px] uppercase tracking-widest">Produk Hukum Terpublikasi Harian</h4>
            <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i>
        </div>
        <div class="p-8">
            <div class="h-64">
                <canvas id="publishChart"></canvas>
            </div>
            <div class="mt-6 pt-6 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Total Terpublikasi</span>
                <span class="text-xl font-black text-islami">{{ number_format($totalPublishedCount) }} <span class="text-[10px] text-slate-400 uppercase font-bold">Dokumen</span></span>
            </div>
        </div>
    </div>

    <!-- Chart: Daily Visitors -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full ring-1 ring-slate-100">
        <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h4 class="font-bold text-slate-900 text-[11px] uppercase tracking-widest">Kunjungan Produk Hukum Perhari</h4>
            <i data-lucide="users" class="w-4 h-4 text-slate-400"></i>
        </div>
        <div class="p-8">
            <div class="h-64">
                <canvas id="visitChart"></canvas>
            </div>
            <div class="mt-6 pt-6 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Total Kunjungan</span>
                <span class="text-xl font-black text-blue-600">{{ number_format($totalVisitsCount) }} <span class="text-[10px] text-slate-400 uppercase font-bold">Akses</span></span>
            </div>
        </div>
    </div>
</div>

<!-- User Satisfaction Survey -->
<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">
    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h4 class="font-black text-slate-900 text-[11px] uppercase tracking-widest">Tingkat Kepuasan Pengguna</h4>
            <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">Distribusi Rating Survey (1 - 5 Bintang)</p>
        </div>
        <div class="w-8 h-8 bg-islami/10 rounded-lg flex items-center justify-center text-islami">
            <i data-lucide="award" class="w-4 h-4"></i>
        </div>
    </div>
    <div class="p-8 flex-1">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Left: Chart -->
            <div class="h-[300px] relative">
                <canvas id="surveyChart"></canvas>
            </div>
            
            <!-- Right: Stats -->
            <div class="space-y-8">
                <div>
                    <h5 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Total Partisipasi</h5>
                    <div class="flex items-baseline gap-3">
                        <span class="text-5xl font-black text-slate-900 tracking-tighter">{{ number_format($totalFeedbacks) }}</span>
                        <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Responden</span>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <h5 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Statistik Penilaian</h5>
                    @for($i = 5; $i >= 1; $i--)
                        <div class="flex items-center gap-4 group">
                            <div class="flex items-center gap-1.5 w-12">
                                <span class="text-xs font-black text-slate-600">{{ $i }}</span>
                                <i data-lucide="star" class="w-3.5 h-3.5 fill-yellow-400 text-yellow-400"></i>
                            </div>
                            <div class="flex-1 h-2.5 bg-slate-100 rounded-full overflow-hidden shadow-inner">
                                @php
                                    $count = $surveyStats->get($i, 0);
                                    $percentage = $totalFeedbacks > 0 ? ($count / $totalFeedbacks) * 100 : 0;
                                    $colors = [
                                        1 => 'bg-red-500', 
                                        2 => 'bg-orange-500', 
                                        3 => 'bg-yellow-400', 
                                        4 => 'bg-lime-500', 
                                        5 => 'bg-emerald-500'
                                    ];
                                @endphp
                                <div class="{{ $colors[$i] }} h-full rounded-full transition-all duration-1000 ease-out" 
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                            <div class="w-10 text-right">
                                <span class="text-xs font-black text-slate-900">{{ number_format($count) }}</span>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [5, 5], drawBorder: false }, ticks: { font: { size: 10 } } },
                x: { grid: { display: false }, ticks: { font: { size: 9 }, maxRotation: 45, minRotation: 45 } }
            }
        };

        // Publish Chart
        const publishCtx = document.getElementById('publishChart').getContext('2d');
        const publishData = @json($dailyPublished);
        new Chart(publishCtx, {
            type: 'bar',
            data: {
                labels: publishData.map(d => d.date),
                datasets: [{
                    data: publishData.map(d => d.total),
                    backgroundColor: '#0F9D58',
                    borderRadius: 4
                }]
            },
            options: commonOptions
        });

        // Visit Chart
        const visitCtx = document.getElementById('visitChart').getContext('2d');
        const visitData = @json($dailyVisits);
        new Chart(visitCtx, {
            type: 'bar',
            data: {
                labels: visitData.map(d => d.date),
                datasets: [{
                    data: visitData.map(d => d.total),
                    backgroundColor: '#2563eb',
                    borderRadius: 4
                }]
            },
            options: commonOptions
        });

        // Survey Chart
        const surveyCtx = document.getElementById('surveyChart').getContext('2d');
        const surveyData = {
            labels: ['1 ★', '2 ★', '3 ★', '4 ★', '5 ★'],
            datasets: [{
                data: [
                    {{ $surveyStats->get(1, 0) }},
                    {{ $surveyStats->get(2, 0) }},
                    {{ $surveyStats->get(3, 0) }},
                    {{ $surveyStats->get(4, 0) }},
                    {{ $surveyStats->get(5, 0) }}
                ],
                backgroundColor: ['#ef4444', '#f97316', '#fbbf24', '#65a30d', '#059669']
            }]
        };
        new Chart(surveyCtx, {
            type: 'pie',
            data: surveyData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endpush
