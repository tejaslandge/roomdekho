<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-purple-600 to-pink-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:from-purple-700 hover:to-pink-700 focus:from-purple-700 focus:to-pink-700 active:from-purple-800 active:to-pink-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-purple-200']) }}>
    {{ $slot }}
</button>
