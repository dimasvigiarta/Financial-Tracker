<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div style="margin-bottom: 20px;">
                        <a href="{{ route('categories.create') }}" 
                           style="background-color: #2563eb; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
                            + TAMBAH KATEGORI BARU
                        </a>
                    </div>

                    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                        <thead>
                            <tr style="background-color: #f3f4f6; text-align: left;">
                                <th style="padding: 10px; border: 1px solid #ddd;">Nama Kategori</th>
                                <th style="padding: 10px; border: 1px solid #ddd;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">{{ $category->name }}</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">
                                    <a href="{{ route('categories.edit', $category) }}" style="color: orange; font-weight: bold; margin-right: 10px;">Edit</a>
                                    
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="color: red; font-weight: bold; background: none; border: none; cursor: pointer;">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" style="padding: 20px; text-align: center; border: 1px solid #ddd;">
                                    Belum ada data kategori. Klik tombol tambah di atas!
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>