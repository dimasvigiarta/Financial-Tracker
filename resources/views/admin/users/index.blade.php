<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-slate-800 leading-tight tracking-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h3 class="text-lg font-black text-slate-800 uppercase tracking-tight">Daftar Pengguna</h3>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Username</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Email</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5 font-bold text-slate-700 uppercase tracking-tight">{{ $user->name }}</td>
                            <td class="px-8 py-5 font-medium text-slate-500">{{ $user->email }}</td>
                            <td class="px-8 py-5">
                                @if($user->is_admin)
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-indigo-50 text-indigo-600 border border-indigo-100">Super Admin</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-slate-100 text-slate-500 border border-slate-200">User Biasa</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>