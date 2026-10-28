/**
 * HerramientaJB - interacciones del frontend (JavaScript sin librerías).
 */

const formatoPesos = new Intl.NumberFormat('es-CO', {
    style: 'currency',
    currency: 'COP',
    maximumFractionDigits: 0,
});

/* ---------- Menú lateral en celulares ---------- */
function iniciarMenuMovil() {
    const menu = document.getElementById('menu-lateral');
    const fondo = document.getElementById('menu-fondo');

    if (!menu || !fondo) {
        return;
    }

    const abrir = () => {
        menu.classList.remove('-translate-x-full');
        fondo.classList.remove('hidden');
    };

    const cerrar = () => {
        menu.classList.add('-translate-x-full');
        fondo.classList.add('hidden');
    };

    document.querySelectorAll('[data-abrir-menu]').forEach((boton) => boton.addEventListener('click', abrir));
    fondo.addEventListener('click', cerrar);
    document.addEventListener('keydown', (evento) => {
        if (evento.key === 'Escape') {
            cerrar();
        }
    });
}

/* ---------- Confirmar antes de eliminar ---------- */
function iniciarConfirmaciones() {
    document.querySelectorAll('form[data-confirmar]').forEach((formulario) => {
        formulario.addEventListener('submit', (evento) => {
            if (!window.confirm(formulario.dataset.confirmar)) {
                evento.preventDefault();
            }
        });
    });
}

/* ---------- Mensajes flash que se cierran solos ---------- */
function iniciarMensajes() {
    document.querySelectorAll('[data-mensaje]').forEach((mensaje) => {
        const cerrar = () => mensaje.remove();
        mensaje.querySelector('[data-cerrar]')?.addEventListener('click', cerrar);
        setTimeout(cerrar, 6000);
    });
}

/* ---------- Vista previa de imagen del producto ---------- */
function iniciarVistaPreviaImagen() {
    const entrada = document.querySelector('[data-vista-previa]');
    const imagen = document.getElementById(entrada?.dataset.vistaPrevia ?? '');

    if (!entrada || !imagen) {
        return;
    }

    entrada.addEventListener('change', () => {
        const archivo = entrada.files?.[0];
        if (archivo) {
            imagen.src = URL.createObjectURL(archivo);
            imagen.classList.remove('hidden');
        }
    });
}

/* ---------- Líneas de productos (cotizaciones y ventas) ---------- */
function iniciarLineasProductos() {
    const contenedor = document.querySelector('[data-lineas]');

    if (!contenedor) {
        return;
    }

    const cuerpo = contenedor.querySelector('[data-lineas-cuerpo]');
    const plantilla = contenedor.querySelector('template');
    const totalEl = contenedor.querySelector('[data-total]');
    const validarStock = contenedor.dataset.validarStock === 'true';
    // Índice único para cada fila nueva (evita choques con filas que vienen de old()).
    let indice = Date.now();

    const recalcular = () => {
        let total = 0;

        cuerpo.querySelectorAll('[data-linea]').forEach((linea) => {
            const opcion = linea.querySelector('select').selectedOptions[0];
            const cantidad = parseInt(linea.querySelector('[data-cantidad]').value, 10) || 0;
            const precio = parseFloat(opcion?.dataset.precio ?? '0');
            const stock = parseInt(opcion?.dataset.stock ?? '0', 10);
            const subtotal = precio * cantidad;
            const aviso = linea.querySelector('[data-aviso-stock]');

            linea.querySelector('[data-precio]').textContent = opcion?.value ? formatoPesos.format(precio) : '—';
            linea.querySelector('[data-subtotal]').textContent = formatoPesos.format(subtotal);

            if (aviso) {
                const sinStock = validarStock && opcion?.value && cantidad > stock;
                aviso.textContent = sinStock ? `Solo hay ${stock} en stock` : '';
                aviso.classList.toggle('hidden', !sinStock);
            }

            total += subtotal;
        });

        totalEl.textContent = formatoPesos.format(total);
    };

    const agregar = () => {
        const html = plantilla.innerHTML.replaceAll('__INDICE__', String(indice));
        indice += 1;
        cuerpo.insertAdjacentHTML('beforeend', html);
        recalcular();
    };

    contenedor.querySelector('[data-agregar]').addEventListener('click', agregar);

    cuerpo.addEventListener('input', recalcular);
    cuerpo.addEventListener('change', recalcular);
    cuerpo.addEventListener('click', (evento) => {
        const boton = evento.target.closest('[data-quitar]');
        if (!boton) {
            return;
        }
        if (cuerpo.querySelectorAll('[data-linea]').length > 1) {
            boton.closest('[data-linea]').remove();
            recalcular();
        }
    });

    if (cuerpo.querySelectorAll('[data-linea]').length === 0) {
        agregar();
    } else {
        recalcular();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    iniciarMenuMovil();
    iniciarConfirmaciones();
    iniciarMensajes();
    iniciarVistaPreviaImagen();
    iniciarLineasProductos();
});
