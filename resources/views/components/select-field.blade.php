@props(['label', 'id', 'options' => [], 'selected' => '', 'placeholder' => 'Selecione uma opção', 'name' => ''])

@php
    $fieldName = $name ?: $id;
    $hasError = $errors->has($fieldName);
@endphp

<div class="relative select-container" id="container-{{ $id }}">
    <div class="flex justify-between items-center mb-2">
        <label for="{{ $id }}" class="block text-sm font-medium text-slate-700">{{ $label }}</label>
        {{ $rightLabel ?? '' }}
    </div>
    
    <select id="{{ $id }}" name="{{ $fieldName }}" class="sr-only select-hidden" tabindex="-1">
        <option value="" {{ $selected === '' ? 'selected' : '' }}>{{ $placeholder }}</option>
        @foreach($options as $value => $optionLabel)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $optionLabel }}</option>
        @endforeach
    </select>

    <button 
        type="button"
        id="trigger-{{ $id }}"
        class="w-full px-6 py-4 rounded-full bg-slate-50 border text-left text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-4 transition-all duration-200 flex items-center justify-between cursor-pointer {{ $hasError ? '!border-rose-300 focus:!border-rose-500 focus:!ring-rose-500/10' : 'border-slate-200 focus:border-[#FFEE8C] focus:ring-[#FFEE8C]/20' }}"
        aria-haspopup="listbox"
        aria-expanded="false"
    >
        <span class="select-label font-medium">
            {{ $options[$selected] ?? $placeholder }}
        </span>
        <x-heroicon-o-chevron-down class="w-4 h-4 text-slate-400 transition-transform duration-200 select-chevron" />
    </button>

    <div 
        id="dropdown-{{ $id }}"
        class="absolute left-0 right-0 mt-2 bg-white/95 backdrop-blur-md border border-slate-200/80 rounded-[2rem] shadow-xl z-50 py-2 hidden opacity-0 scale-95 transition-all duration-200 origin-top select-dropdown"
        role="listbox"
    >
        <div class="max-h-60 overflow-y-auto px-2 space-y-1">
            @foreach($options as $value => $optionLabel)
                <button
                    type="button"
                    data-value="{{ $value }}"
                    class="w-full flex items-center gap-4 px-5 py-3.5 rounded-2xl font-bold text-sm transition-all duration-200 text-left select-option cursor-pointer {{ $selected == $value ? 'bg-[#FFFBE6] text-[#A17C00]' : 'text-slate-500 hover:bg-[#FFFDF0] hover:text-[#A17C00]' }}"
                    role="option"
                    aria-selected="{{ $selected == $value ? 'true' : 'false' }}"
                >
                    {{ $optionLabel }}
                </button>
            @endforeach
        </div>
    </div>
    
    @error($fieldName)
        <p class="mt-1.5 text-xs font-semibold text-rose-600 pl-4">{{ $message }}</p>
    @enderror
</div>

@once
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.addEventListener('click', (e) => {
            const trigger = e.target.closest('[id^="trigger-"]');
            const option = e.target.closest('.select-option');
            
            if (trigger) {
                const container = trigger.closest('.select-container');
                const dropdown = container.querySelector('.select-dropdown');
                const chevron = container.querySelector('.select-chevron');
                const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
                
                closeAllDropdowns(dropdown);
                
                if (isExpanded) {
                    closeDropdown(dropdown, trigger, chevron);
                } else {
                    openDropdown(dropdown, trigger, chevron);
                }
                return;
            }
            
            if (option) {
                const container = option.closest('.select-container');
                const dropdown = container.querySelector('.select-dropdown');
                const trigger = container.querySelector('[id^="trigger-"]');
                const chevron = container.querySelector('.select-chevron');
                const selectHidden = container.querySelector('.select-hidden');
                const selectLabel = container.querySelector('.select-label');
                
                const val = option.getAttribute('data-value');
                const label = option.textContent.trim();
                
                selectHidden.value = val;
                selectHidden.dispatchEvent(new Event('change', { bubbles: true }));
                
                selectLabel.textContent = label;
                
                container.querySelectorAll('.select-option').forEach(opt => {
                    opt.classList.remove('bg-[#FFFBE6]', 'text-[#A17C00]');
                    opt.classList.add('text-slate-500', 'hover:bg-[#FFFDF0]', 'hover:text-[#A17C00]');
                    opt.setAttribute('aria-selected', 'false');
                });
                option.classList.remove('text-slate-500', 'hover:bg-[#FFFDF0]', 'hover:text-[#A17C00]');
                option.classList.add('bg-[#FFFBE6]', 'text-[#A17C00]');
                option.setAttribute('aria-selected', 'true');
                
                closeDropdown(dropdown, trigger, chevron);
                return;
            }
            
            closeAllDropdowns();
        });

        function openDropdown(dropdown, trigger, chevron) {
            trigger.setAttribute('aria-expanded', 'true');
            chevron.classList.add('rotate-180');
            
            dropdown.classList.remove('hidden');
            void dropdown.offsetWidth;
            
            dropdown.classList.remove('opacity-0', 'scale-95');
            dropdown.classList.add('opacity-100', 'scale-100');
        }

        function closeDropdown(dropdown, trigger, chevron) {
            if (dropdown.classList.contains('hidden')) return;
            
            trigger.setAttribute('aria-expanded', 'false');
            chevron.classList.remove('rotate-180');
            
            dropdown.classList.remove('opacity-100', 'scale-100');
            dropdown.classList.add('opacity-0', 'scale-95');
            
            const transitionHandler = () => {
                dropdown.classList.add('hidden');
                dropdown.removeEventListener('transitionend', transitionHandler);
            };
            dropdown.addEventListener('transitionend', transitionHandler);
        }

        function closeAllDropdowns(exceptDropdown = null) {
            document.querySelectorAll('.select-container').forEach(container => {
                const dropdown = container.querySelector('.select-dropdown');
                if (dropdown === exceptDropdown) return;
                const trigger = container.querySelector('[id^="trigger-"]');
                const chevron = container.querySelector('.select-chevron');
                closeDropdown(dropdown, trigger, chevron);
            });
        }
    });
</script>
@endonce
