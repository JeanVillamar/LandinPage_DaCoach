/* Progresivo: sin JS la landing se lee entera. Lo que se pierde es el
   movimiento, no la información. */
(function () {
  'use strict';

  var quieto = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // --- Cabecera: la línea aparece solo cuando ya hiciste scroll.
  var cabecera = document.getElementById('cabecera');
  if (cabecera) {
    var alFijar = function () {
      cabecera.classList.toggle('is-fija', window.scrollY > 8);
    };
    alFijar();
    window.addEventListener('scroll', alFijar, { passive: true });
  }

  // ------------------------------------------------------------------
  // Check animado (Lottie) en la confirmación del formulario.
  // Este bloque solo hace algo si el elemento existe (index.php solo lo
  // imprime cuando ?enviado=1) y si window.lottie cargó de verdad. Si el
  // CDN falla por cualquier razón, esto no hace nada y el SVG estático de
  // siempre sigue siendo lo único visible — cero riesgo de romper la página.
  var contenedorCheck = document.querySelector('.aviso__check-animado[data-lottie]');
  if (contenedorCheck && !quieto && window.lottie && typeof window.lottie.loadAnimation === 'function') {
    try {
      var animacionCheck = window.lottie.loadAnimation({
        container: contenedorCheck,
        renderer: 'svg',
        loop: false,
        autoplay: true,
        path: contenedorCheck.getAttribute('data-lottie')
      });
      animacionCheck.addEventListener('DOMLoaded', function () {
        var aviso = contenedorCheck.closest('.aviso--ok');
        if (aviso) aviso.classList.add('tiene-lottie');
      });
      // Si el JSON no carga (404, red), no pasa nada: la clase nunca se
      // añade y el SVG estático sigue siendo lo que se ve.
    } catch (err) {
      // Se ignora a propósito: el respaldo estático ya está en el DOM.
    }
  }

  // ------------------------------------------------------------------
  // Red de nodos de la portada.
  // Es lo que vende la empresa: cosas sueltas que se conectan.
  // ------------------------------------------------------------------
  var lienzo = document.getElementById('lienzo');
  if (lienzo && !quieto) {
    var ctx = lienzo.getContext('2d');
    var nodos = [];
    var raton = { x: -9999, y: -9999 };
    var anim = null;
    var w = 0, h = 0;

    var DIST = 130;      // Distancia a la que dos nodos se enlazan.
    var DIST_RATON = 190;

    var medir = function () {
      var dpr = Math.min(window.devicePixelRatio || 1, 2);
      var r = lienzo.getBoundingClientRect();
      w = r.width;
      h = r.height;
      lienzo.width = Math.round(w * dpr);
      lienzo.height = Math.round(h * dpr);
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

      // La densidad se ajusta al área: en un móvil no hacen falta 60 nodos.
      var cuantos = Math.min(58, Math.max(18, Math.round((w * h) / 22000)));
      nodos = [];
      for (var i = 0; i < cuantos; i++) {
        nodos.push({
          x: Math.random() * w,
          y: Math.random() * h,
          vx: (Math.random() - 0.5) * 0.28,
          vy: (Math.random() - 0.5) * 0.28,
          r: Math.random() * 1.6 + 1
        });
      }
    };

    var pintar = function () {
      ctx.clearRect(0, 0, w, h);

      for (var i = 0; i < nodos.length; i++) {
        var n = nodos[i];
        n.x += n.vx;
        n.y += n.vy;
        if (n.x < 0 || n.x > w) n.vx *= -1;
        if (n.y < 0 || n.y > h) n.vy *= -1;

        // Enlaces entre nodos cercanos.
        for (var j = i + 1; j < nodos.length; j++) {
          var m = nodos[j];
          var dx = n.x - m.x, dy = n.y - m.y;
          var d = Math.sqrt(dx * dx + dy * dy);
          if (d < DIST) {
            ctx.strokeStyle = 'rgba(14, 107, 87, ' + (0.16 * (1 - d / DIST)).toFixed(3) + ')';
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.moveTo(n.x, n.y);
            ctx.lineTo(m.x, m.y);
            ctx.stroke();
          }
        }

        // El cursor atrae y enlaza: el visitante forma parte de la red.
        var rx = n.x - raton.x, ry = n.y - raton.y;
        var rd = Math.sqrt(rx * rx + ry * ry);
        var cerca = rd < DIST_RATON;
        if (cerca) {
          ctx.strokeStyle = 'rgba(14, 107, 87, ' + (0.3 * (1 - rd / DIST_RATON)).toFixed(3) + ')';
          ctx.lineWidth = 1;
          ctx.beginPath();
          ctx.moveTo(n.x, n.y);
          ctx.lineTo(raton.x, raton.y);
          ctx.stroke();
          n.x += rx > 0 ? -0.18 : 0.18;
          n.y += ry > 0 ? -0.18 : 0.18;
        }

        ctx.fillStyle = 'rgba(14, 107, 87, ' + (cerca ? 0.5 : 0.28) + ')';
        ctx.beginPath();
        ctx.arc(n.x, n.y, n.r, 0, Math.PI * 2);
        ctx.fill();
      }
      anim = requestAnimationFrame(pintar);
    };

    var arrancar = function () { if (!anim) anim = requestAnimationFrame(pintar); };
    var parar = function () { if (anim) { cancelAnimationFrame(anim); anim = null; } };

    medir();
    arrancar();

    var remedir;
    window.addEventListener('resize', function () {
      clearTimeout(remedir);
      remedir = setTimeout(medir, 200);
    });

    window.addEventListener('mousemove', function (ev) {
      var r = lienzo.getBoundingClientRect();
      raton.x = ev.clientX - r.left;
      raton.y = ev.clientY - r.top;
    }, { passive: true });
    window.addEventListener('mouseout', function () { raton.x = raton.y = -9999; });

    // No gastar batería animando algo que ya no se ve.
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (e) {
        e[0].isIntersecting ? arrancar() : parar();
      }, { threshold: 0 }).observe(lienzo);
    }
    document.addEventListener('visibilitychange', function () {
      document.hidden ? parar() : arrancar();
    });
  }

  // ------------------------------------------------------------------
  // Antes / Después: las mismas 7 tarjetas giran en cascada.
  // ------------------------------------------------------------------
  var cambio = document.querySelector('.cambio');
  if (cambio) {
    var pestanas = [].slice.call(cambio.querySelectorAll('.cambio__pestana'));
    var pildora = cambio.querySelector('.cambio__pildora');
    var rejilla = document.getElementById('cambio-rejilla');
    var pie = document.getElementById('cambio-pie');
    var pies = [
      'Siete puntos sueltos, torcidos y perdiéndose.',
      'Los mismos siete, conectados y con tu equipo supervisando.'
    ];

    var moverPildora = function (pestana) {
      pildora.style.width = pestana.offsetWidth + 'px';
      pildora.style.transform = 'translateX(' + (pestana.offsetLeft - 4) + 'px)';
    };

    var activar = function (idx, mueveFoco) {
      pestanas.forEach(function (p, i) {
        var activa = i === idx;
        p.classList.toggle('es-activa', activa);
        p.setAttribute('aria-selected', activa ? 'true' : 'false');
        p.tabIndex = activa ? 0 : -1;
      });
      cambio.classList.toggle('es-despues', idx === 1);
      moverPildora(pestanas[idx]);
      rejilla.setAttribute('aria-labelledby', pestanas[idx].id);

      // La cara que está de espaldas no debe leerla un lector de pantalla.
      [].slice.call(rejilla.querySelectorAll('.cambio__cara--antes')).forEach(function (c) {
        c.setAttribute('aria-hidden', idx === 1 ? 'true' : 'false');
      });
      [].slice.call(rejilla.querySelectorAll('.cambio__cara--despues')).forEach(function (c) {
        c.setAttribute('aria-hidden', idx === 0 ? 'true' : 'false');
      });

      pie.classList.add('es-cambiando');
      setTimeout(function () {
        pie.textContent = pies[idx];
        pie.classList.remove('es-cambiando');
      }, 250);

      if (mueveFoco) pestanas[idx].focus();
    };

    pestanas.forEach(function (pestana, i) {
      pestana.addEventListener('click', function () { activar(i, false); });
      pestana.addEventListener('keydown', function (ev) {
        var salto = ev.key === 'ArrowRight' ? 1 : ev.key === 'ArrowLeft' ? -1 : 0;
        if (!salto) return;
        ev.preventDefault();
        activar((i + salto + pestanas.length) % pestanas.length, true);
      });
    });

    moverPildora(pestanas[0]);
    activar(0, false);
    window.addEventListener('resize', function () {
      var activa = cambio.querySelector('.cambio__pestana.es-activa');
      if (activa) moverPildora(activa);
    });
  }

  // ------------------------------------------------------------------
  // Frases de impacto: cada palabra entra por separado sin perder los
  // énfasis editoriales (<em>) definidos en el HTML.
  // ------------------------------------------------------------------
  [].slice.call(document.querySelectorAll('[data-frase]')).forEach(function (frase) {
    var indice = 0;

    var envolver = function (nodo) {
      [].slice.call(nodo.childNodes).forEach(function (hijo) {
        if (hijo.nodeType === 3) {
          var partes = hijo.nodeValue.match(/\s+|[^\s]+/g);
          if (!partes) return;
          var fragmento = document.createDocumentFragment();

          partes.forEach(function (parte) {
            if (/^\s+$/.test(parte)) {
              fragmento.appendChild(document.createTextNode(' '));
              return;
            }

            var caja = document.createElement('span');
            caja.className = 'palabra';
            caja.style.setProperty('--p', String(indice++));
            var dentro = document.createElement('span');
            dentro.textContent = parte;
            caja.appendChild(dentro);
            fragmento.appendChild(caja);
          });

          hijo.parentNode.replaceChild(fragmento, hijo);
        } else if (hijo.nodeType === 1 && !hijo.classList.contains('palabra')) {
          envolver(hijo);
        }
      });
    };

    envolver(frase);
  });

  // Movimiento ligado al scroll: las fotos avanzan a otra velocidad que el
  // texto. Es muy sutil a propósito; crea profundidad sin entorpecer la lectura.
  var escenas = [].slice.call(document.querySelectorAll('[data-frase-escena]'));
  if (escenas.length && !quieto) {
    var cuadroFrases = null;

    var actualizarFrases = function () {
      var alto = window.innerHeight || document.documentElement.clientHeight;
      escenas.forEach(function (escena) {
        var r = escena.getBoundingClientRect();
        var progreso = Math.max(0, Math.min(1, (alto - r.top) / (alto + r.height)));
        var mediaY = (0.5 - progreso) * 54;
        var escala = 1.105 - progreso * 0.035;
        var contenidoY = (0.5 - progreso) * 16;
        escena.style.setProperty('--frase-media-y', mediaY.toFixed(2) + 'px');
        escena.style.setProperty('--frase-media-scale', escala.toFixed(4));
        escena.style.setProperty('--frase-contenido-y', contenidoY.toFixed(2) + 'px');
      });
      cuadroFrases = null;
    };

    var pedirActualizacionFrases = function () {
      if (!cuadroFrases) cuadroFrases = requestAnimationFrame(actualizarFrases);
    };

    actualizarFrases();
    window.addEventListener('scroll', pedirActualizacionFrases, { passive: true });
    window.addEventListener('resize', pedirActualizacionFrases, { passive: true });
  }

  // ------------------------------------------------------------------
  // Contadores del caso.
  // ------------------------------------------------------------------
  var contar = function (el) {
    var fin = parseInt(el.dataset.contar, 10);
    var suf = el.dataset.sufijo || '';
    if (quieto) { el.textContent = fin + suf; return; }
    var t0 = null;
    var dur = 1400;
    var paso = function (t) {
      if (!t0) t0 = t;
      var p = Math.min((t - t0) / dur, 1);
      var suave = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(fin * suave) + suf;
      if (p < 1) requestAnimationFrame(paso);
    };
    requestAnimationFrame(paso);
  };

  // ------------------------------------------------------------------
  // Aparición de secciones.
  // ------------------------------------------------------------------
  var objetivos = document.querySelectorAll('.aparece, .frase');
  if (!('IntersectionObserver' in window)) {
    [].slice.call(objetivos).forEach(function (el) { el.classList.add('es-visible'); });
    [].slice.call(document.querySelectorAll('[data-contar]')).forEach(contar);
    return;
  }

  var observador = new IntersectionObserver(function (entradas) {
    entradas.forEach(function (entrada) {
      var esFrase = entrada.target.classList.contains('frase');
      if (entrada.isIntersecting) {
        entrada.target.classList.add('es-visible');
        // Las frases entran y salen cada vez, así que se siguen observando.
        if (!esFrase) observador.unobserve(entrada.target);
      } else if (esFrase) {
        entrada.target.classList.remove('es-visible');
      }
    });
  }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });

  [].slice.call(objetivos).forEach(function (el) { observador.observe(el); });

  var obsCifras = new IntersectionObserver(function (entradas) {
    entradas.forEach(function (entrada) {
      if (!entrada.isIntersecting) return;
      contar(entrada.target);
      obsCifras.unobserve(entrada.target);
    });
  }, { threshold: 0.6 });

  [].slice.call(document.querySelectorAll('[data-contar]')).forEach(function (el) {
    obsCifras.observe(el);
  });
})();
