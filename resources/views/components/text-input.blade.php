@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-3 bg-neo-white border-2 border-black text-black font-bold placeholder-gray-500 focus:outline-none focus:border-neo-blue focus:shadow-neo-sm transition-all duration-200 disabled:bg-gray-100 disabled:text-gray-500']) }}>