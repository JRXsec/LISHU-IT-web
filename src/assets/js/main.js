// Pequeñas animaciones. La web funciona igual sin JavaScript.
document.addEventListener('DOMContentLoaded', () => {
    const reducir = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Aparición suave de tarjetas al hacer scroll
    const revelar = document.querySelectorAll('.revelar');
    if ('IntersectionObserver' in window && !reducir) {
        document.documentElement.classList.add('js-anim');
        const obs = new IntersectionObserver((entradas) => {
            entradas.forEach((e) => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    obs.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        revelar.forEach((el) => obs.observe(el));
    }

    // Contadores animados (sección de números)
    const formato = new Intl.NumberFormat('es-ES');
    document.querySelectorAll('[data-contador]').forEach((el) => {
        const fin = parseInt(el.dataset.contador, 10);
        const sufijo = el.dataset.sufijo || '';
        if (reducir || !('IntersectionObserver' in window)) return;
        const obs = new IntersectionObserver(([e]) => {
            if (!e.isIntersecting) return;
            obs.disconnect();
            const inicio = performance.now();
            const dur = 1600;
            const paso = (t) => {
                const p = Math.min((t - inicio) / dur, 1);
                const v = Math.round(fin * (1 - Math.pow(1 - p, 3)));
                el.textContent = formato.format(v) + sufijo;
                if (p < 1) requestAnimationFrame(paso);
            };
            requestAnimationFrame(paso);
        }, { threshold: 0.5 });
        obs.observe(el);
    });

    // Cerrar el menú móvil al pulsar un enlace
    const toggle = document.getElementById('menu-toggle');
    document.querySelectorAll('.menu a').forEach((a) => a.addEventListener('click', () => { if (toggle) toggle.checked = false; }));

    // Sombra en la barra al hacer scroll
    const nav = document.querySelector('.nav');
    const sombra = () => nav && nav.classList.toggle('con-sombra', window.scrollY > 10);
    window.addEventListener('scroll', sombra, { passive: true });
    sombra();
});
