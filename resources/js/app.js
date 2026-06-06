import { imageMap } from './constants/imageMap';

window.NK_IMAGE_MAP = imageMap;

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', (event) => {
            const targetId = anchor.getAttribute('href');
            if (!targetId || targetId === '#') return;
            const target = document.querySelector(targetId);
            if (!target) return;
            event.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    document.querySelectorAll('[data-food-image-shell] img').forEach((img) => {
        if (img.complete) {
            img.closest('[data-food-image-shell]')?.classList.add('is-loaded');
        }
    });

    document.querySelectorAll('[data-add-btn]').forEach((button) => {
        const originalLabel = button.textContent;
        button.addEventListener('click', () => {
            if (button.disabled) return;
            button.textContent = 'Ditambahkan';
            setTimeout(() => {
                button.textContent = originalLabel;
            }, 1800);
        });
    });

    const trackForm = document.querySelector('[data-track-form]');
    if (trackForm) {
        const input = trackForm.querySelector('[data-track-input]');
        const submitButton = trackForm.querySelector('[data-track-submit]');
        const defaultButtonText = submitButton ? submitButton.textContent : '';

        trackForm.addEventListener('submit', (event) => {
            if (!input || !submitButton) return;
            const hasValue = input.value.trim().length > 0;

            if (!hasValue) {
                event.preventDefault();
                input.classList.add('nk-input-error');
                input.focus();
                setTimeout(() => input.classList.remove('nk-input-error'), 1300);
                return;
            }

            submitButton.textContent = 'Mencari...';
            setTimeout(() => {
                submitButton.textContent = defaultButtonText;
            }, 1800);
        });
    }
});
