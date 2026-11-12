<?php
// =====================================================================
//  TODA la información de LISHU-IT está aquí.
//  Las páginas recorren estos arrays para pintar el contenido:
//  para cambiar un texto, una cifra o una foto, se edita SOLO este fichero.
//  (Empresa ficticia: los datos inventados son para el proyecto de clase.)
// =====================================================================

// Fotos de Unsplash (licencia libre). Se cargan por URL, sin descargarlas.
function foto(string $id, int $ancho = 1200): string
{
    return "https://images.unsplash.com/photo-{$id}?auto=format&fit=crop&w={$ancho}&q=70";
}

$empresa = [
    'nombre'    => 'LISHU-IT',
    'lema'      => 'Ciberseguridad y auditoría para todo lo que está conectado.',
    'intro'     => 'Protegemos cámaras, sensores, iluminación inteligente y domótica —y las redes a las que se conectan— frente a ciberataques, vulnerabilidades y accesos no autorizados.',
    'resumen'   => 'Multinacional que protege la seguridad y la privacidad de los dispositivos conectados de empresas, administraciones y particulares.',
    'objetivo'  => 'Ser la referencia en seguridad IoT en España y crecer a nivel internacional.',
    'ventaja'   => 'I+D propio y atención personalizada y cercana frente a grandes generalistas.',
    'fundacion' => 2004,
    'email'     => 'contacto@lishu-it.es',
    'telefono'  => '+34 900 102 404',
    'urgencias' => '+34 900 102 911',
    'direccion' => 'Paseo de la Castellana 259, planta 21 · 28046 Madrid',
    'horario'   => 'L-V 8:00-20:00 · SOC IoT 24/7',
    'linkedin'  => 'https://www.linkedin.com/',
];

// Menú principal: archivo => texto
$menu = [
    'index.php'     => 'Inicio',
    'servicios.php' => 'Servicios',
    'sectores.php'  => 'Sectores',
    'nosotros.php'  => 'Nosotros',
    'contacto.php'  => 'Contacto',
];

$cifras = [
    ['titulo' => '+20 años',      'texto' => 'de experiencia en IoT'],
    ['titulo' => 'Multinacional', 'texto' => 'proyectos privados y públicos'],
    ['titulo' => 'I+D propio',    'texto' => 'nuevas tecnologías'],
    ['titulo' => 'Foco IoT',      'texto' => 'no somos generalistas'],
];

// Cifras inventadas para dar realismo
$numeros = [
    ['valor' => 184000, 'sufijo' => '',   'texto' => 'dispositivos auditados'],
    ['valor' => 12600,  'sufijo' => '',   'texto' => 'vulnerabilidades corregidas'],
    ['valor' => 640,    'sufijo' => '',   'texto' => 'clientes en 7 países'],
    ['valor' => 97,     'sufijo' => '%',  'texto' => 'de clientes renuevan'],
];

$propuesta = [
    ['icono' => 'search',     'titulo' => 'Especialización IoT', 'texto' => 'Auditorías diseñadas para dispositivos y redes conectadas.'],
    ['icono' => 'flask',      'titulo' => 'Innovación continua', 'texto' => 'I+D propio por delante de nuevas amenazas.'],
    ['icono' => 'shield',     'titulo' => 'Prevención',          'texto' => 'Mantenimiento que evita incidentes antes de que ocurran.'],
    ['icono' => 'sliders',    'titulo' => 'A medida',            'texto' => 'Adaptado al entorno y al nivel de riesgo de cada cliente.'],
    ['icono' => 'lock',       'titulo' => 'Privacidad',          'texto' => 'Protegemos los datos personales y corporativos.'],
    ['icono' => 'headphones', 'titulo' => 'Soporte continuo',    'texto' => 'Atención técnica y seguimiento periódico.'],
];

$porque = [
    ['fuerte' => 'Especialistas en IoT', 'resto' => ', no consultora generalista'],
    ['fuerte' => 'I+D propio',           'resto' => ' por delante de nuevas amenazas'],
    ['fuerte' => 'Prevención',           'resto' => ' de fallos antes de que ocurran'],
    ['fuerte' => 'Soluciones a medida',  'resto' => ' según riesgo y entorno'],
    ['fuerte' => 'Privacidad',           'resto' => ' de datos personales y corporativos'],
    ['fuerte' => 'Soporte continuo',     'resto' => ' e informes periódicos'],
];

$clientes = [
    [
        'id' => 'industria', 'icono' => 'factory', 'titulo' => 'Grandes empresas e industria',
        'texto' => 'Sistemas industriales y corporativos',
        'foto' => foto('1581091226825-a6a2a5aee158'),
        'detalle' => 'Fábricas, plantas logísticas y sedes corporativas con miles de sensores, PLC, cámaras y controles de acceso conectados a la misma red que los ordenadores de oficina.',
        'riesgos' => ['Redes OT e IT sin segmentar', 'Firmware de PLC y sensores sin actualizar', 'Accesos remotos de proveedores sin control'],
        'caso' => ['cliente' => 'Grupo logístico nacional (14 centros)', 'resultado' => 'Segmentamos 9.200 dispositivos y redujimos un 83 % la superficie de ataque en 4 meses.'],
    ],
    [
        'id' => 'tecnologicas', 'icono' => 'cpu', 'titulo' => 'Tecnológicas y domótica',
        'texto' => 'Certificar y reforzar sus productos',
        'foto' => foto('1518770660439-4636190af475'),
        'detalle' => 'Fabricantes de cámaras, enchufes, termostatos y asistentes que necesitan sacar al mercado productos seguros y cumplir la normativa europea.',
        'riesgos' => ['Contraseñas por defecto y puertos de depuración', 'Apps y APIs en la nube vulnerables', 'Cumplimiento del Cyber Resilience Act y EN 303 645'],
        'caso' => ['cliente' => 'Fabricante de domótica (2 M de unidades vendidas)', 'resultado' => 'Auditamos firmware y app antes del lanzamiento: 41 fallos corregidos y certificación EN 303 645 a la primera.'],
    ],
    [
        'id' => 'hoteles', 'icono' => 'building', 'titulo' => 'Hoteles y edificios',
        'texto' => 'Cámaras, accesos, clima e iluminación',
        'foto' => foto('1566073771259-6a8506099945'),
        'detalle' => 'Hoteles, oficinas y edificios inteligentes donde cerraduras, climatización, ascensores y videovigilancia dependen de la red.',
        'riesgos' => ['Cerraduras electrónicas clonables', 'Wi-Fi de huéspedes mezclada con sistemas internos', 'Cámaras accesibles desde Internet'],
        'caso' => ['cliente' => 'Cadena hotelera (22 hoteles)', 'resultado' => 'Aislamos 3.400 dispositivos de habitación y monitorizamos 24/7 sin ningún incidente en 2 años.'],
    ],
    [
        'id' => 'pymes', 'icono' => 'briefcase', 'titulo' => 'Pymes',
        'texto' => 'Protección sin equipo técnico propio',
        'foto' => foto('1600880292203-757bb62b4baf'),
        'detalle' => 'Comercios, clínicas, despachos y talleres con cámaras, alarmas, TPV y routers que nadie revisa porque no tienen un departamento de IT.',
        'riesgos' => ['Routers y cámaras con la contraseña de fábrica', 'Sin copias de seguridad ni actualizaciones', 'Datos de clientes expuestos (RGPD)'],
        'caso' => ['cliente' => 'Red de 11 clínicas dentales', 'resultado' => 'Auditoría en 1 semana, plan Pyme Segura y cero sustos desde entonces: todo por menos de lo que cuesta un portátil al año.'],
    ],
    [
        'id' => 'particulares', 'icono' => 'home', 'titulo' => 'Particulares',
        'texto' => 'Hogar inteligente y privacidad familiar',
        'foto' => foto('1558002038-1055907df827'),
        'detalle' => 'Hogares con cámaras, vigilabebés, altavoces, robots aspiradores y televisores conectados que pueden espiar o ser usados en ataques.',
        'riesgos' => ['Cámaras y vigilabebés accesibles por desconocidos', 'Altavoces y TV que recogen más datos de la cuenta', 'Router doméstico sin actualizar'],
        'caso' => ['cliente' => 'Familia de Valencia (27 dispositivos)', 'resultado' => 'Descubrimos una cámara que emitía en abierto; en 2 horas el hogar quedó revisado y protegido.'],
    ],
];

$proceso = [
    ['titulo' => 'Auditoría IoT',                'texto' => 'Inventario y revisión de todos los dispositivos conectados y su red.', 'icono' => 'search'],
    ['titulo' => 'Análisis de vulnerabilidades', 'texto' => 'Detectamos fallos de firmware, configuraciones débiles y puertos expuestos.', 'icono' => 'bug'],
    ['titulo' => 'Evaluación de riesgos',        'texto' => 'Priorizamos cada riesgo según su impacto en el negocio o el hogar.', 'icono' => 'gauge'],
    ['titulo' => 'Monitorización',               'texto' => 'Vigilancia continua del tráfico y de comportamientos anómalos.', 'icono' => 'activity'],
    ['titulo' => 'Mantenimiento e informes',     'texto' => 'Actualizaciones, parches e informes periódicos para el cliente.', 'icono' => 'file'],
];

// Servicios detallados (página Servicios)
$servicios = [
    [
        'icono' => 'search', 'titulo' => 'Auditoría IoT',
        'texto' => 'Descubrimos y catalogamos cada dispositivo conectado —incluidos los que nadie recordaba— y revisamos cómo se comunican entre sí y con Internet.',
        'incluye' => ['Inventario automático de la red', 'Revisión física y lógica de dispositivos', 'Mapa de red y flujos de datos'],
    ],
    [
        'icono' => 'bug', 'titulo' => 'Análisis de vulnerabilidades y pentesting',
        'texto' => 'Atacamos tus dispositivos como lo haría un ciberdelincuente: firmware, credenciales, apps móviles, APIs en la nube y protocolos como MQTT, Zigbee o BLE.',
        'incluye' => ['Pentesting de firmware y hardware', 'Pruebas de apps y APIs', 'Análisis de radio (Wi-Fi, BLE, Zigbee)'],
    ],
    [
        'icono' => 'gauge', 'titulo' => 'Evaluación de riesgos',
        'texto' => 'Traducimos los fallos técnicos a lenguaje de negocio: qué puede pasar, cuánto costaría y qué arreglar primero.',
        'incluye' => ['Matriz de riesgos por impacto', 'Plan de acción priorizado', 'Apoyo para RGPD, NIS2 y ENS'],
    ],
    [
        'icono' => 'activity', 'titulo' => 'Monitorización 24/7',
        'texto' => 'Nuestro SOC especializado en IoT vigila el tráfico de tus dispositivos día y noche y actúa en cuanto detecta algo raro.',
        'incluye' => ['SOC IoT 24/7 desde Madrid', 'Alertas en tiempo real', 'Respuesta ante incidentes'],
    ],
    [
        'icono' => 'file', 'titulo' => 'Mantenimiento e informes',
        'texto' => 'Mantenemos tus dispositivos al día y te enviamos informes claros para que siempre sepas cómo de protegido estás.',
        'incluye' => ['Gestión de parches y firmware', 'Informe mensual o trimestral', 'Revisión anual completa'],
    ],
    [
        'icono' => 'award', 'titulo' => 'Certificación de producto',
        'texto' => 'Acompañamos a fabricantes para que sus productos salgan al mercado seguros y cumpliendo la normativa europea.',
        'incluye' => ['ETSI EN 303 645', 'Cyber Resilience Act (CRA)', 'Seguridad desde el diseño'],
    ],
];

$planes = [
    [
        'nombre' => 'Hogar Seguro', 'para' => 'Particulares', 'precio' => '9,90', 'periodo' => '€/mes',
        'items' => ['Auditoría inicial del hogar (remota)', 'Hasta 25 dispositivos', 'Alertas en el móvil', 'Soporte por chat y teléfono'],
        'destacado' => false,
    ],
    [
        'nombre' => 'Pyme Segura', 'para' => 'Pymes y comercios', 'precio' => '149', 'periodo' => '€/mes',
        'items' => ['Auditoría IoT anual presencial', 'Hasta 150 dispositivos', 'Monitorización 24/7', 'Informe trimestral', 'Técnico asignado'],
        'destacado' => true,
    ],
    [
        'nombre' => 'Empresa', 'para' => 'Industria, hoteles y edificios', 'precio' => 'A medida', 'periodo' => '',
        'items' => ['Pentesting y análisis de riesgos', 'Dispositivos ilimitados', 'SOC IoT dedicado', 'Informe mensual y KPI', 'Cumplimiento NIS2 / ENS'],
        'destacado' => false,
    ],
];

$normas = ['ISO/IEC 27001', 'ENS Categoría Alta', 'ETSI EN 303 645', 'IEC 62443', 'RGPD', 'NIS2'];

$faq = [
    ['p' => '¿Qué es un dispositivo IoT?', 'r' => 'Cualquier aparato conectado a Internet que no es un ordenador o un móvil: cámaras, sensores, enchufes, termostatos, cerraduras, televisores, máquinas industriales…'],
    ['p' => '¿Una auditoría interrumpe mi actividad?', 'r' => 'No. Planificamos las pruebas para que no afecten al funcionamiento normal y las más delicadas se hacen fuera de horario.'],
    ['p' => '¿Cuánto tarda una auditoría?', 'r' => 'Un hogar, unas 2 horas. Una pyme, de 2 a 5 días. Una gran empresa depende del número de sedes y dispositivos; te damos un plan cerrado antes de empezar.'],
    ['p' => '¿Trabajáis fuera de España?', 'r' => 'Sí. Tenemos oficinas en Portugal, México y Colombia y hacemos proyectos en toda Europa y Latinoamérica.'],
    ['p' => '¿Qué pasa con mis datos?', 'r' => 'Firmamos un acuerdo de confidencialidad, cumplimos el RGPD y nunca guardamos más información de la necesaria. La privacidad es parte de lo que vendemos.'],
];

$competencia = [
    ['nombre' => 'Telefónica Tech', 'enfoque' => 'Ciberseguridad a gran escala',   'nosotros' => 'Especialización IoT y trato cercano'],
    ['nombre' => 'S2 Group',        'enfoque' => 'Infraestructuras críticas',      'nosotros' => 'Cobertura de domótica y consumo'],
    ['nombre' => 'GMV',             'enfoque' => 'Seguridad informática avanzada', 'nosotros' => 'Servicio personalizado y mantenimiento'],
    ['nombre' => 'Indra',           'enfoque' => 'Tecnología y defensa',           'nosotros' => 'Agilidad y foco exclusivo en IoT'],
    ['nombre' => 'Deloitte Cyber',  'enfoque' => 'Consultoría y riesgos',          'nosotros' => 'Capacidad técnica e I+D en IoT'],
];

$canales = [
    ['icono' => 'globe',    'titulo' => 'Digital',   'texto' => 'web, LinkedIn, publicidad, campañas y email'],
    ['icono' => 'users',    'titulo' => 'Directo',   'texto' => 'reuniones, visitas y teléfono'],
    ['icono' => 'calendar', 'titulo' => 'Eventos',   'texto' => 'ferias y congresos de ciberseguridad'],
    ['icono' => 'link',     'titulo' => 'Indirecto', 'texto' => 'partners y recomendaciones'],
    ['icono' => 'heart',    'titulo' => 'Relación',  'texto' => 'largo plazo, soporte continuo e informes'],
];

$alianzas = [
    ['icono' => 'monitor', 'titulo' => 'Software y hardware',  'texto' => 'Herramientas y componentes'],
    ['icono' => 'shield',  'titulo' => 'Ciberseguridad',       'texto' => 'Servicios complementarios'],
    ['icono' => 'wifi',    'titulo' => 'Telecomunicaciones',   'texto' => 'Conectividad'],
    ['icono' => 'cloud',   'titulo' => 'Servicios en la nube', 'texto' => 'Infraestructura escalable'],
];

$dispositivos = ['Cámaras', 'Sensores', 'Iluminación', 'Climatización', 'Domótica', 'Accesos'];

// Testimonios inventados
$testimonios = [
    ['texto' => 'Pensábamos que nuestras cámaras eran seguras. LISHU-IT encontró tres accesos abiertos el primer día. Ahora dormimos tranquilos.', 'nombre' => 'Marta Ferrer', 'cargo' => 'Directora de operaciones · Cadena hotelera', 'foto' => foto('1573496359142-b8d87734a5a2', 200)],
    ['texto' => 'Gracias a su laboratorio de I+D sacamos nuestro termostato al mercado con la certificación europea a la primera.', 'nombre' => 'Javier Ortega', 'cargo' => 'CTO · Fabricante de domótica', 'foto' => foto('1507003211169-0a1dd7228f2d', 200)],
    ['texto' => 'No tenemos informático. Con el plan Pyme Segura tenemos a alguien que vigila por nosotros y nos lo explica claro.', 'nombre' => 'Lucía Benítez', 'cargo' => 'Gerente · Red de clínicas dentales', 'foto' => foto('1494790108377-be9c29b29330', 200)],
];

// Historia (+20 años desde 2004)
$historia = [
    ['anio' => '2004', 'texto' => 'Nace LISHU-IT en Madrid como ingeniería de redes de sensores industriales.'],
    ['anio' => '2009', 'texto' => 'Primer servicio de auditoría de seguridad para sistemas de videovigilancia IP.'],
    ['anio' => '2013', 'texto' => 'Creamos el departamento de I+D y el laboratorio de hardware de Tres Cantos.'],
    ['anio' => '2017', 'texto' => 'Abrimos oficinas en Lisboa y Ciudad de México: pasamos a ser multinacional.'],
    ['anio' => '2020', 'texto' => 'Lanzamos el SOC IoT 24/7 y los planes para pymes y particulares.'],
    ['anio' => '2024', 'texto' => '20 aniversario, oficina en Bogotá y más de 150.000 dispositivos auditados.'],
    ['anio' => '2026', 'texto' => 'Laboratorio acreditado para certificar productos según el Cyber Resilience Act.'],
];

// Equipo inventado
$equipo = [
    ['nombre' => 'Elena Lis',    'cargo' => 'CEO y cofundadora',     'foto' => foto('1580489944761-15a19d654956', 400)],
    ['nombre' => 'Daniel Shu',   'cargo' => 'CTO y cofundador',      'foto' => foto('1472099645785-5658abf4ff4e', 400)],
    ['nombre' => 'Carmen Ríos',  'cargo' => 'Directora de I+D',      'foto' => foto('1438761681033-6461ffad8d80', 400)],
    ['nombre' => 'Andrés Molina', 'cargo' => 'Responsable del SOC IoT', 'foto' => foto('1500648767791-00dcc994a43e', 400)],
];

$oficinas = [
    ['ciudad' => 'Madrid',           'pais' => 'España',   'tipo' => 'Sede central y SOC 24/7'],
    ['ciudad' => 'Tres Cantos',      'pais' => 'España',   'tipo' => 'Laboratorio de I+D'],
    ['ciudad' => 'Barcelona',        'pais' => 'España',   'tipo' => 'Oficina comercial'],
    ['ciudad' => 'Lisboa',           'pais' => 'Portugal', 'tipo' => 'Oficina Europa'],
    ['ciudad' => 'Ciudad de México', 'pais' => 'México',   'tipo' => 'Oficina Latinoamérica'],
    ['ciudad' => 'Bogotá',           'pais' => 'Colombia', 'tipo' => 'Oficina comercial'],
];

$valores = [
    ['icono' => 'shield', 'titulo' => 'Seguridad primero',  'texto' => 'Nunca recomendamos algo que no instalaríamos en casa.'],
    ['icono' => 'users',  'titulo' => 'Cercanía',           'texto' => 'Un técnico con nombre y apellidos para cada cliente.'],
    ['icono' => 'flask',  'titulo' => 'Curiosidad',         'texto' => 'El 15 % de nuestra facturación va a I+D.'],
    ['icono' => 'lock',   'titulo' => 'Discreción',         'texto' => 'Lo que vemos en tu red, se queda en tu red.'],
];

// Fotos generales
$fotos = [
    'hero'     => foto('1550751827-4bd374c3f58b', 1800),
    'lab'      => foto('1581092160562-40aa08e78837', 1200),
    'soc'      => foto('1526374965328-7f61d4dc18c5', 1200),
    'oficina'  => foto('1497366216548-37526070297c', 1200),
    'equipo'   => foto('1522071820081-009f0129c71c', 1200),
    'contacto' => foto('1486406146926-c627a92ad1ab', 1200),
];
