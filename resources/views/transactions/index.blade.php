<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-900 leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #f3f4f6; min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-700">Data Keuangan</h3>
                <a href="{{ route('transactions.create') }}" 
                   style="background-color: #2563eb; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-flex; align-items: center; gap: 5px; box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3);">
                    <span>+</span> Transaksi Baru
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6 text-gray-900">
                    
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f8fafc; text-align: left; color: #64748b;">
                                <th style="padding: 15px; border-bottom: 2px solid #e2e8f0; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Tanggal</th>
                                <th style="padding: 15px; border-bottom: 2px solid #e2e8f0; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Keterangan</th>
                                <th style="padding: 15px; border-bottom: 2px solid #e2e8f0; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Kategori</th>
                                <th style="padding: 15px; border-bottom: 2px solid #e2e8f0; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Jumlah</th>
                                <th style="padding: 15px; border-bottom: 2px solid #e2e8f0; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                            <tr style="border-bottom: 1px solid #f1f5f9;" class="hover:bg-blue-50 transition-colors duration-200">
                                <td style="padding: 15px; font-weight: 500; color: #475569;">
                                    {{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}
                                </td>
                                <td style="padding: 15px; font-weight: 600; color: #1e293b;">
                                    {{ $transaction->description }}
                                </td>
                                <td style="padding: 15px;">
                                    <span style="background: #eff6ff; color: #3b82f6; padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; border: 1px solid #dbeafe;">
                                        {{ $transaction->category->name }}
                                    </span>
                                </td>
                                <td style="padding: 15px; font-weight: 800; font-size: 15px; color: {{ $transaction->type == 'income' ? '#16a34a' : '#dc2626' }}">
                                    {{ $transaction->type == 'income' ? '+' : '-' }} 
                                    Rp {{ number_format($transaction->amount) }}
                                </td>
                                <td style="padding: 15px; text-align: center;">
                                    <a href="{{ route('transactions.edit', $transaction) }}" 
                                       style="color: #d97706; font-weight: bold; margin-right: 10px; text-decoration: none; display: inline-block;">
                                        Edit
                                    </a>
                                    
                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus transaksi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer; font-weight: bold;">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8;">
                                    <div style="margin-bottom: 10px; font-size: 30px;">📂</div>
                                    Belum ada data transaksi.<br>
                                    <span style="font-size: 14px;">Klik tombol "Transaksi Baru" untuk mulai mencatat.</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $transactions->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>