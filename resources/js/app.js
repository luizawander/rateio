import './bootstrap';
import * as Masks from './masks';

window.Masks = Masks;

window.ClipboardHelper = {
    async copy(button, staticText, successText = 'Copiado!', duration = 2000) {
        if (button.disabled) return;
        const textToCopy = button.getAttribute('data-copy-value') || staticText;
        if (!textToCopy) return;

        try {
            await navigator.clipboard.writeText(textToCopy);
            
            const originalText = button.innerHTML;
            button.innerHTML = successText;
            button.classList.add('!bg-emerald-500', '!text-white', '!border-transparent', 'hover:!bg-emerald-600');
            button.disabled = true;

            setTimeout(() => {
                button.innerHTML = originalText;
                button.classList.remove('!bg-emerald-500', '!text-white', '!border-transparent', 'hover:!bg-emerald-600');
                button.disabled = false;
            }, duration);
        } catch (err) {
            alert('Não foi possível copiar.');
        }
    }
};
