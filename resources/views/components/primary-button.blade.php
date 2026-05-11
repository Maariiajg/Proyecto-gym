<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-10 py-4 bg-indigo-600 hover:bg-indigo-500 border border-transparent rounded-[1.2rem] font-black text-[10px] text-white uppercase tracking-[0.2em] shadow-xl shadow-indigo-500/20 focus:outline-none transition ease-in-out duration-150 active:scale-95']) }}>
    {{ $slot }}
</button>
