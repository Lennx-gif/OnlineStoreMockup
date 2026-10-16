const menuButton = document.querySelector('.menu-toggle');
if (menuButton) {
    menuButton.addEventListener('click', () => {
        const expanded = menuButton.getAttribute('aria-expanded') === 'true';
        menuButton.setAttribute('aria-expanded', String(!expanded));
        document.querySelector('.main-nav')?.classList.toggle('nav-open', !expanded);
    });
}

const announce = (message, isError = false) => {
    let status = document.querySelector('.live-status');
    if (!status) {
        status = document.createElement('p');
        status.className = 'live-status';
        status.setAttribute('role', 'status');
        document.querySelector('.page-shell')?.prepend(status);
    }
    status.textContent = message;
    status.classList.toggle('notice-error', isError);
    status.classList.toggle('notice-success', !isError);
};

document.querySelectorAll('.add-cart-form').forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const button = form.querySelector('button[type="submit"], button:not([type])');
        if (button) {
            button.disabled = true;
            button.classList.add('is-loading');
        }
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin',
            });
            const result = await response.json();
            if (!response.ok) throw new Error(result.message || 'The item could not be added.');
            document.querySelectorAll('[data-cart-count]').forEach((count) => {
                count.textContent = String(result.count);
                count.classList.remove('bump');
                void count.offsetWidth; // Force reflow to restart CSS animation
                count.classList.add('bump');
                const link = count.closest('a');
                if (link) link.setAttribute('aria-label', `Cart, ${result.count} items`);
            });
            announce(result.message);
        } catch (error) {
            announce(error instanceof Error ? error.message : 'The item could not be added.', true);
        } finally {
            if (button) {
                button.classList.remove('is-loading');
                button.disabled = false;
            }
        }
    });
});

// Auto-submit catalogue filter dropdowns for instantaneous response
document.querySelectorAll('.catalogue-controls select').forEach((select) => {
    select.addEventListener('change', () => {
        select.closest('form')?.submit();
    });
});

const cartForm = document.querySelector('.cart-items');
if (cartForm) {
    cartForm.addEventListener('submit', async (event) => {
        if (event.submitter?.name === 'action' || event.submitter?.formAction) return;
        event.preventDefault();
        const button = event.submitter;
        if (button) button.disabled = true;
        try {
            const response = await fetch('/api/cart_update.php', {
                method: 'POST',
                body: new FormData(cartForm),
                headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin',
            });
            const result = await response.json();
            if (!response.ok) throw new Error(result.message || 'The cart could not be updated.');
            Object.entries(result.items).forEach(([id, item]) => {
                const row = cartForm.querySelector(`[data-product-id="${id}"]`);
                if (!row) return;
                row.querySelector('.quantity-input').value = String(item.quantity);
                row.querySelector('.line-total').textContent = formatPrice(item.line_total);
            });
            cartForm.querySelectorAll('.cart-item').forEach((row) => {
                const input = row.querySelector('.quantity-input');
                if (input && input.value === '0') {
                    document.querySelector(`#remove-${CSS.escape(row.dataset.productId)}`)?.remove();
                    row.remove();
                }
            });
            const subtotal = document.querySelector('[data-cart-subtotal]');
            if (subtotal) subtotal.textContent = formatPrice(result.subtotal);
            const total = document.querySelector('.summary-total strong');
            if (total) total.textContent = formatPrice(result.subtotal);
            document.querySelectorAll('[data-cart-count]').forEach((count) => {
                count.textContent = String(result.count);
                count.closest('a')?.setAttribute('aria-label', `Cart, ${result.count} items`);
            });
            announce(result.message);
            if (cartForm.querySelectorAll('.cart-item').length === 0) window.location.reload();
        } catch (error) {
            announce(error instanceof Error ? error.message : 'The cart could not be updated.', true);
        } finally {
            if (button) button.disabled = false;
        }
    });
}

function formatPrice(amount) {
    return `KSh ${Math.round(Number(amount)).toLocaleString('en-KE')}`;
}

document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (!window.confirm(form.dataset.confirm)) event.preventDefault();
    });
});
