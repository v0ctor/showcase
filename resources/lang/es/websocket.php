<?php
/**
 * WebSocket language strings.
 */

return [

    'title'       => 'Conociendo WebSocket',
    'description' => 'Análisis de WebSocket, un protocolo que permite crear un canal de comunicación bidireccional sobre TCP.',

    'introduction' => [
        '1' => 'Desde el principio de su existencia, la Web se ha construido alrededor del paradigma petición/respuesta de HTTP: el usuario carga una página y no ocurre nada hasta que este accede a la siguiente. A partir del año 2005, AJAX empezó a modificar este paradigma añadiendo la posibilidad de, una vez cargada la página, realizar peticiones para obtener información adicional del servidor, ya sea de forma periódica o debido a la interacción del usuario. La principal característica de AJAX es que el servidor no puede iniciar una comunicación con el cliente, ya que es este último quien siempre toma la iniciativa.',

        '2' => 'En oposición a estas tecnologías (conocidas como <em>pull</em>), en las que el cliente realiza la petición de envío, existen las conocidas como <em>push</em>, que permiten a los servidores enviar información al cliente en cualquier momento; normalmente cuando tienen nueva información disponible. Cabe destacar que este modelo no tiene cabida en la Web debido a las limitaciones de su propio planteamiento, aunque se han intentado emular aproximaciones mediante técnicas como <em>long polling</em>.',

        '3' => 'El protocolo WebSocket plantea un modelo elegante y sencillo de comunicaciones para la Web que no rompe con las tecnologías ya existentes.',

        '4' => 'Compañías de éxito como <a href="https://slack.com">Slack</a> (mensajería corporativa), <a href="https://trello.com">Trello</a> (gestión de proyectos), <a href="https://web.whatsapp.com">WhatsApp</a> (mensajería personal) o <a href="https://pusher.com">Pusher</a> (servicios de comunicaciones en tiempo real) utilizan WebSocket para ofrecer sus servicios.',
    ],

    'protocol' => [
        'title' => 'Protocolo',

        '1' => 'WebSocket es un protocolo que permite crear un canal de comunicación bidireccional sobre una sola conexión TCP. Fue estandarizado por la Internet Engineering Task Force [<a href="https://tools.ietf.org/html/rfc6455">RFC 6455</a>] en 2011. Está pensado para ser implementado en navegadores y servidores web, aunque no hay ningún impedimento a la hora de implementarlo en cualquier otro tipo de aplicación que siga el modelo cliente/servidor.

',

        '2' => 'Las comunicaciones se realizan a través de los mismos puertos que utiliza HTTP con el fin de ofrecer compatibilidad con el software HTTP del lado del servidor ya existente. Es decir, cuando el protocolo trabaja directamente sobre TCP utiliza el puerto 80 y cuando lo hace sobre TLS utiliza el 443. No obstante, WebSocket es un protocolo independiente.',

        '3' => 'El protocolo se divide en dos partes: la <strong>negociación</strong> y la <strong>transferencia de datos</strong>. Como este coexiste con HTTP, la primera comunicación debe realizarse necesariamente a través de una <mark>petición</mark> HTTP. Por ello, la negociación de apertura comienza con una petición <em>upgrade</em> por parte del cliente, que tiene el siguiente aspecto:',

        '4' => 'Cabe destacar que la elección del método GET es una decisión arbitraria tomada por los autores del borrador que finalmente quedó plasmada en el RFC. Aun así, es el único método que contempla el estándar y, por tanto, el único que se debe utilizar.',

        '5' => 'Por su parte, si todo va bien, el servidor responde con un estado 101 (<em>switching protocols</em>), que tiene el aspecto que sigue:',

        '6' => 'En ambos casos, tanto en la petición como en la respuesta, se incluyen una serie de cabeceras: obligatorias de HTTP/1.1 (<code>Host</code>), necesarias para establecer la negociación (<code>Upgrade</code>, <code>Connection</code> y <code>Sec-WebSocket-*</code>) o por cuestiones relacionadas con modelo de seguridad escogido para el protocolo (<code>Origin</code>).',

        '7' => 'Una vez el cliente y el servidor han cumplido con su parte de la negociación, y únicamente si no ha ocurrido ningún error, comienza la transferencia de información. A partir de ese momento cada parte puede enviar información a placer sin depender de la otra, cosa imposible de hacer con HTTP, AJAX, las tecnologías push en general o técnicas más específicas como <em>long polling</em>. Además, WebSocket aporta ventajas respecto a modelos como Comet, cuya implementación no es trivial y es ineficiente para mensajes pequeños.',

        '8' => 'En WebSocket, la unidad elemental de transferencia de información son los mensajes, que están compuestos por una o más tramas, cada una de las cuales tiene un tipo de datos asociado que coincidirá con el que tengan el resto de tramas del mismo mensaje. Existen tramas que contienen texto (que se interpreta como UTF-8) o información binaria, entre otros tipos. También existen tramas de control, pensadas para ser usadas por el propio protocolo. La versión más reciente de WebSocket define seis tipos de trama y deja diez más reservados para uso futuro.',

        '9' => 'La siguiente figura muestra una visión general de alto nivel de la estructura de las tramas. Téngase en cuenta que el formato efectivo de la transferencia de datos es binario (no ASCII) y está descrito por las ABNF (<em>Augmented BNF for Syntax Specifications</em>) [<a href="https://tools.ietf.org/html/rfc5234">RFC 5234</a>].',

        '10' => 'A continuación se describe a grandes rasgos el significado de cada campo:',

        '11' => [
            'a' => '<code>FIN</code> indica si la trama es la última del mensaje. Nótese que la primera trama puede ser también la última.',

            'b' => '<code>RSV1</code>, <code>RSV2</code> y <code>RSV3</code> están reservados para su uso por parte de extensiones.',

            'c' => '<code>Opcode</code> define el tipo de datos que contiene la trama, explicado anteriormente.',

            'd' => '<code>Mask</code> indica si el campo <code>Payload data</code> está enmascarado. Todas las tramas que van dirigidas del cliente al servidor lo están.',

            'e' => '<code>Payload length</code> define la longitud del campo <code>Payload data</code> en bytes. El protocolo establece un mecanismo para poder utilizar el campo <code>Extended payload length</code> para indicar longitudes mayores que 127 bytes.',

            'f' => '<code>Masking-key</code> contiene la máscara utilizada para enmascarar el campo <code>Payload data</code> y solo está presente cuando el campo <code>Mask</code> es 1.',

            'g' => '<code>Payload data</code> contiene la información en sí.',
        ],

        '12' => 'De lo anterior se deduce que la fragmentación es algo corriente (y, en caso de mensajes muy grandes, inevitable) en WebSocket. Sin embargo, el protocolo está pensado para que la fragmentación se utilice lo mínimo posible. De hecho, se ha escogido un modelo basado en fragmentos por no escoger uno basado en flujos de información, además de para poder distinguir entre tipos de información. Cabe señalar que en un protocolo de nivel de aplicación no tendría mucho sentido fragmentar sin una razón.',

        '13' => 'Por último, cuando una de las partes decide que ya no hay nada más que transmitir, es posible cerrar la conexión mediante una negociación de cierre. Esta se inicia enviando un mensaje de control específico, al cual el otro extremo responde con otro mensaje de control para confirmar que el cierre es acordado. La negociación de cierre está pensada para ir acompañada del cierre de la conexión TCP.',
    ],

    'security' => [
        'title' => 'Seguridad',

        '1' => 'El modelo de seguridad de WebSocket es el mismo que utilizan los navegadores web, es decir, el llamado modelo de origen (igual que AJAX). Para un servidor web se restringen las páginas desde las que se puede establecer una conexión, evitando así vulnerabilidades de <em>cross-site scripting</em>. Evidentemente, esto solo tiene sentido cuando el protocolo se utiliza desde una página web.',

        '2' => 'Además, el proceso de negociación está pensado para asegurar que ambas partes están utilizando WebSocket y que, por tanto, no se está intentando establecer una conexión ilícita utilizando, por ejemplo, HTML y AJAX.',
    ],

    'api' => [
        'title' => 'API',

        '1' => 'La API WebSocket HTML5 en Web IDL (un formato para describir interfaces a implementar en navegadores web) aún está siendo normalizada por el World Wide Web Consortium. Esta API orientada a eventos permite a los navegadores web utilizar el protocolo a través de JavaScript en el contexto de una aplicación web.',

        'establishing_the_connection' => [
            'title' => 'Establecimiento de la conexión',

            '1' => 'Para establecer una comunicación WebSocket es necesario crear un objeto <code>WebSocket</code>, que automáticamente intentará abrir una conexión con el servidor. El constructor acepta dos parámetros: el primero es la URL a la que conectarse (obligatorio) y el segundo es una cadena o un <em>array</em> de cadenas indicando subprotocolos que permiten al servidor manejar diferentes tipos de interacción. Este último parámetro es opcional.',

            '2' => 'Si ocurriese un error durante el establecimiento de la conexión, se enviarían dos eventos al objeto: uno de error (invocando al manejador <code>onerror</code>) y otro de cierre de conexión (invocando al manejador <code>onclose</code>).',

            '3' => 'El ejemplo que sigue muestra la forma de crear un objeto <code>WebSocket</code> que inicia una conexión segura sobre TLS (nótese el protocolo <em>wss</em> en lugar de <em>ws</em>) a uno de los servidores utilizados para ofrecer el conocido servicio de mensajería WhatsApp Web.',
        ],

        'sending_information' => [
            'title' => 'Envío de información',

            '1' => 'Una vez abierta la conexión es posible empezar a enviar información a través de ella. Para ello simplemente hay que llamar a la función <code>send()</code> del objeto creado.',

            '2' => 'Sin embargo, no es una buena práctica utilizar este método ignorando que JavaScript ejecuta el código de forma asíncrona. Teniendo en cuenta lo anterior, la solución pasa por definir un manejador proporcionado por la API que es llamado cuando la conexión termina de establecerse.',
        ],

        'receiving_information' => [
            'title' => 'Recepción de información',

            '1' => 'Cuando un mensaje llega, se pasa automáticamente un evento <code>message</code> como parámetro a la función <code>onmessage()</code>. Para empezar a escuchar en el canal de entrada solo hay que definir el manejador de la siguiente forma:',
        ],

        'closing_the_connection' => [
            'title' => 'Cierre de la conexión',

            '1' => 'Cuando se ha terminado de enviar y recibir información es conveniente cerrar la conexión para no desperdiciar recursos tanto de la máquina cliente como del servidor. Cerrar una conexión es tan fácil como llamar al método <code>close()</code>:',
        ],

        'documentation' => [
            'title' => 'Documentación',

            '1' => 'La <a href="http://www.w3.org/TR/websockets/">especificación</a> de la API se encuentra disponible en la página web del World Wide Web Consortium. También existe <a href="https://developer.mozilla.org/en-US/docs/Web/API/WebSockets_API">documentación</a> más amigable desarrollada por la fundación Mozilla y que se encuentra disponible en la Mozilla Developer Network.',
        ],
    ],

    'scope_of_application' => [
        'title' => 'Ámbito de aplicación',

        '1' => 'WebSocket se puede utilizar en prácticamente cualquier plataforma y consta de implementación en otros ámbitos fuera del navegador web. Téngase en cuenta que las aplicaciones web cobran cada vez más importancia y para su desarrollo es necesario, además del navegador web en la parte del cliente, un lado servidor que soporte el protocolo.',

        '2' => 'Gran parte de los lenguajes más utilizados en el año 2015 disponen de API para WebSocket: C (<a href="https://libwebsockets.org">Libwebsockets</a>), Java (<a href="https://docs.oracle.com/javaee/7/api/javax/websocket/package-summary.html">javax.websocket</a>), Objective-C (<a href="https://github.com/square/SocketRocket">SocketRocket</a>), PHP (<a href="http://elephant.io">Elephant.IO</a>) y, obviamente, JavaScript, entre otros. Además, también existen soluciones multiplataforma, como <a href="http://socket.io">Socket.IO</a> para NodeJS.',

        'web_browser_support' => [
            'title' => 'Soporte en navegadores web',

            '1' => 'En la tabla que hay a continuación se muestra, para los navegadores más utilizados actualmente, la versión desde la que soportan cada una de las definiciones de WebSocket. La versión actual de WebSocket es la 17 y es la misma que se define en el <a href="https://tools.ietf.org/html/rfc6455">RFC 6455</a>.',

            'table' => [
                'version'  => 'Versión :number',
                'no'       => 'No',
                'unknown'  => 'Desconocido',
                'disabled' => ':version (desactivado)',
            ],
        ],
    ],

    'advantages_and_disadvantages' => [
        'title' => 'Ventajas y desventajas',

        '1' => 'Como se ha visto, el protocolo permite establecer comunicaciones bidireccionales en tiempo real en la Web, posibilidad que antes solo existía de forma simulada y bastante costosa mediante técnicas como <em>long polling</em>. Optar por este protocolo permite reducir la saturación de cabeceras que ocurriría si se utilizase HTTP en su lugar, especialmente para aplicaciones que requieren un gran volumen de comunicaciones. Además, evita que cada aplicación utilice una solución de integración diferente, con los problemas de compatibilidad que ello conllevaría. Por otra parte, se ha visto que su funcionamiento es extremadamente sencillo: se establece una conexión, se envían/reciben mensajes y se cierra la conexión. Por último, al funcionar bajo los mismos puertos que HTTP evita problemas relacionados con cortafuegos, facilitando así el funcionamiento de productos basados en arquitecturas orientadas a servicios (SOA), entre otros.',

        '2' => 'Por otra parte, es necesario gestionar y mantener un gran número de conexiones que han de permanecer abiertas mientras ambas partes sigan interactuando. Esto puede llegar a ser un problema en determinados casos, teniendo en cuenta que el número máximo de conexiones simultáneas que admite un puerto TCP es de 64.000 y que, además, mantener las conexiones abiertas requiere memoria del servidor.',

        '3' => 'Por tanto, WebSocket es la mejor solución para aplicaciones que necesitan actualizaciones constantes en tiempo real como chats, juegos multijugador en línea o retransmisiones interactivas en directo. Sin embargo, no resulta una opción tan válida para aplicaciones que únicamente necesitan actualizaciones periódicas o basadas en eventos generados por el usuario.',
    ],

    'real_case' => [
        'title' => 'Caso real',

        '1' => 'Después de ver el funcionamiento de WebSocket y todo lo que puede aportar como tecnología de comunicaciones a la integración de aplicaciones, resulta interesante destacar un caso real en el que se utiliza el protocolo: WhatsApp Web.',

        '2' => 'El servicio de mensajería WhatsApp es un servicio distribuido. Su cliente web utiliza WebSocket para comunicarse con los servidores, que se encargan de almacenar información y retransmitir a los clientes web la información que solicitan indirectamente a los dispositivos móviles.',

        '3' => 'Utilizando las herramientas para desarrolladores que proporciona Google Chrome es posible analizar las comunicaciones entre un cliente WhatsApp Web y los servidores del servicio.',

        '4' => 'En la siguiente captura de pantalla se observa la negociación de apertura que inicia el cliente y la respuesta que recibe del servidor:',

        '5' => 'Además, también es posible comprobar los mensajes enviados y recibidos, y de qué tipo son:',
    ],

    'conclusion' => [
        'title' => 'Conclusión',

        '1' => 'WebSocket permite que dos aplicaciones establezcan una comunicación bidireccional independientemente de la plataforma en la que estén ejecutándose y del lenguaje en el que hayan sido escritas. Además, existen multitud de implementaciones para prácticamente cualquier lenguaje que permiten a los desarrolladores centrarse en sus aplicaciones olvidándose de implementar las comunicaciones.',

        '2' => 'Esto abre un abanico de posibilidades para la integración de aplicaciones, permitiendo a estas intercambiar información en tiempo real y de forma sencilla, contribuyendo además a la estandarización de los mecanismos de comunicación.',
    ],

    'figures' => [
        '1' => '<strong>Figura 1</strong>: estructura de una trama WebSocket.',
        '2' => '<strong>Figura 2</strong>: negociación de apertura vista desde la consola de desarrollo de Chrome.',
        '3' => '<strong>Figura 3</strong>: mensajes WebSocket desde la consola de desarrollo de Chrome.',
    ],

];
