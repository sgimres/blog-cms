<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-black uppercase leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-4 border-black shadow-neo-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-black uppercase">All Users</h3>
                    <span class="bg-neo-yellow text-black font-bold px-3 py-1 border-2 border-black shadow-neo-sm">{{ $users->total() }} Users</span>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border-2 border-black text-black font-bold px-4 py-3 mb-6 shadow-neo-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto border-2 border-black">
                    <table class="min-w-full text-left">
                        <thead>
                            <tr class="bg-black text-white uppercase text-sm font-bold">
                                <th class="px-4 py-3 border-b-2 border-black">Name</th>
                                <th class="px-4 py-3 border-b-2 border-black">Email</th>
                                <th class="px-4 py-3 border-b-2 border-black">Role</th>
                                <th class="px-4 py-3 border-b-2 border-black">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-2 divide-black font-mono text-sm">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-3 font-bold text-black">{{ $user->name }}</td>
                                    <td class="px-4 py-3">{{ $user->email }}</td>
                                    <td class="px-4 py-3">
                                        <form method="POST" action="{{ route('admin.users.update-role', $user) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" onchange="this.form.submit()" class="border-2 border-black text-black font-bold focus:outline-none focus:shadow-neo-sm py-1 px-2 cursor-pointer transition-all duration-200 hover:bg-neo-white">
                                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-4 py-3">{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center font-bold text-gray-500">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>