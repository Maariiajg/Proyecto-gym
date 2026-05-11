@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'glass bg-slate-900/50 border-white/5 text-white placeholder-slate-600 focus:border-indigo-500/50 focus:ring-indigo-500/50 rounded-2xl shadow-inner transition-all px-6 py-4 font-bold text-sm']) }}>
