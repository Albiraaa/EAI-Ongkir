@extends('layouts.admin')

@section('title', 'Shipping Settings')
@section('page-title', 'Shipping Settings')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900">Konfigurasi RajaOngkir</h2>
        <div class="mt-6 space-y-4 text-sm text-slate-600">
            <div class="flex justify-between border-b border-slate-200 pb-3"><span>Base URL</span><span>{{ $settings['base_url'] }}</span></div>
            <div class="flex justify-between border-b border-slate-200 pb-3"><span>API Key</span><span>{{ $settings['api_key'] }}</span></div>
            <div class="flex justify-between border-b border-slate-200 pb-3"><span>Origin ID</span><span>{{ $settings['origin_id'] }}</span></div>
            <div class="flex justify-between border-b border-slate-200 pb-3"><span>Courier</span><span>{{ implode(', ', $settings['couriers']) }}</span></div>
            <div class="flex justify-between"><span>Timeout</span><span>{{ $settings['timeout'] }} detik</span></div>
        </div>
    </div>
@endsection
