@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3']) }}>
    {{ $value ?? $slot }}
</label>
