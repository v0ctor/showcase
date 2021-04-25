---
title: Conociendo WebSocket
description: Análisis de WebSocket, un protocolo que permite crear un canal de comunicación bidireccional sobre TCP.
date: 2015-11-15
---

## Introducción

Desde el principio de su existencia, la Web se ha construido alrededor del paradigma petición/respuesta de HTTP: el usuario carga una página y no ocurre nada hasta que este accede a la siguiente. A partir del año 2005, AJAX empezó a modificar este paradigma añadiendo la posibilidad de, una vez cargada la página, realizar peticiones para obtener información adicional del servidor, ya sea de forma periódica o debido a la interacción del usuario. La principal característica de AJAX es que el servidor no puede iniciar una comunicación con el cliente, ya que es este último quien siempre toma la iniciativa.

En oposición a estas tecnologías (conocidas como _pull_), en las que el cliente realiza la petición de envío, existen las conocidas como _push_, que permiten a los servidores enviar información al cliente en cualquier momento; normalmente cuando tienen nueva información disponible. Cabe destacar que este modelo no tiene cabida en la Web debido a las limitaciones de su propio planteamiento, aunque se han intentado emular aproximaciones mediante técnicas como _long polling_.

El protocolo WebSocket plantea un modelo elegante y sencillo de comunicaciones para la Web que no rompe con las tecnologías ya existentes.

Compañías de éxito como [Slack](https://slack.com) (mensajería corporativa), [Trello](https://trello.com) (gestión de proyectos), [WhatsApp](https://web.whatsapp.com) (mensajería personal) o [Pusher](https://pusher.com) (servicios de comunicaciones en tiempo real) utilizan WebSocket para ofrecer sus servicios.

## Protocolo

WebSocket es un protocolo que permite crear un canal de comunicación bidireccional sobre una sola conexión TCP. Fue estandarizado por la Internet Engineering Task Force [[RFC 6455](https://tools.ietf.org/html/rfc6455)] en 2011. Está pensado para ser implementado en navegadores y servidores web, aunque no hay ningún impedimento a la hora de implementarlo en cualquier otro tipo de aplicación que siga el modelo cliente/servidor.

Las comunicaciones se realizan a través de los mismos puertos que utiliza HTTP con el fin de ofrecer compatibilidad con el software HTTP del lado del servidor ya existente. Es decir, cuando el protocolo trabaja directamente sobre TCP utiliza el puerto 80 y cuando lo hace sobre TLS utiliza el 443. No obstante, WebSocket es un protocolo independiente.

El protocolo se divide en dos partes: la **negociación** y la **transferencia de datos**. Como este coexiste con HTTP, la primera comunicación debe realizarse necesariamente a través de una <mark>petición</mark> HTTP. Por ello, la negociación de apertura comienza con una petición _upgrade_ por parte del cliente, que tiene el siguiente aspecto:

```http request
GET /chat HTTP/1.1
Host: server.example.com
Upgrade: websocket
Connection: Upgrade
Sec-WebSocket-Key: dGhlIHNhbXBsZSBub25jZQ==
Origin: http://example.com
Sec-WebSocket-Protocol: chat, superchat
Sec-WebSocket-Version: 13
```

Cabe destacar que la elección del método GET es una decisión arbitraria tomada por los autores del borrador que finalmente quedó plasmada en el RFC. Aun así, es el único método que contempla el estándar y, por tanto, el único que se debe utilizar.

Por su parte, si todo va bien, el servidor responde con un estado 101 (_switching protocols_), que tiene el aspecto que sigue:

```http request
HTTP/1.1 101 Switching Protocols
Upgrade: websocket
Connection: Upgrade
Sec-WebSocket-Accept: s3pPLMBiTxaQ9kYGzzhZRbK+xOo=
Sec-WebSocket-Protocol: chat
```

En ambos casos, tanto en la petición como en la respuesta, se incluyen una serie de cabeceras: obligatorias de HTTP/1.1 (`Host`), necesarias para establecer la negociación (`Upgrade`, `Connection` y `Sec-WebSocket-*`) o por cuestiones relacionadas con modelo de seguridad escogido para el protocolo (`Origin`).

Una vez el cliente y el servidor han cumplido con su parte de la negociación, y únicamente si no ha ocurrido ningún error, comienza la transferencia de información. A partir de ese momento cada parte puede enviar información a placer sin depender de la otra, cosa imposible de hacer con HTTP, AJAX, las tecnologías push en general o técnicas más específicas como _long polling_. Además, WebSocket aporta ventajas respecto a modelos como Comet, cuya implementación no es trivial y es ineficiente para mensajes pequeños.

En WebSocket, la unidad elemental de transferencia de información son los mensajes, que están compuestos por una o más tramas, cada una de las cuales tiene un tipo de datos asociado que coincidirá con el que tengan el resto de tramas del mismo mensaje. Existen tramas que contienen texto (que se interpreta como UTF-8) o información binaria, entre otros tipos. También existen tramas de control, pensadas para ser usadas por el propio protocolo. La versión más reciente de WebSocket define seis tipos de trama y deja diez más reservados para uso futuro.

La siguiente figura muestra una visión general de alto nivel de la estructura de las tramas. Téngase en cuenta que el formato efectivo de la transferencia de datos es binario (no ASCII) y está descrito por las ABNF (_Augmented BNF for Syntax Specifications_) [[RFC 5234](https://tools.ietf.org/html/rfc5234)].

![](/static/articles/websocket/images/frame-format.png)

**Figura 1**: estructura de una trama WebSocket.

A continuación se describe a grandes rasgos el significado de cada campo:
- `FIN` indica si la trama es la última del mensaje. Nótese que la primera trama puede ser también la última.
- `RSV1`, `RSV2` y `RSV3` están reservados para su uso por parte de extensiones.
- `Opcode` define el tipo de datos que contiene la trama, explicado anteriormente.
- `Mask` indica si el campo `Payload data` está enmascarado. Todas las tramas que van dirigidas del cliente al servidor lo están.
- `Payload length` define la longitud del campo `Payload data` en bytes. El protocolo establece un mecanismo para poder utilizar el campo `Extended payload length` para indicar longitudes mayores que 127 bytes.
- `Masking-key` contiene la máscara utilizada para enmascarar el campo `Payload data` y solo está presente cuando el campo `Mask` es 1.
- `Payload data` contiene la información en sí.

De lo anterior se deduce que la fragmentación es algo corriente (y, en caso de mensajes muy grandes, inevitable) en WebSocket. Sin embargo, el protocolo está pensado para que la fragmentación se utilice lo mínimo posible. De hecho, se ha escogido un modelo basado en fragmentos por no escoger uno basado en flujos de información, además de para poder distinguir entre tipos de información. Cabe señalar que en un protocolo de nivel de aplicación no tendría mucho sentido fragmentar sin una razón.

Por último, cuando una de las partes decide que ya no hay nada más que transmitir, es posible cerrar la conexión mediante una negociación de cierre. Esta se inicia enviando un mensaje de control específico, al cual el otro extremo responde con otro mensaje de control para confirmar que el cierre es acordado. La negociación de cierre está pensada para ir acompañada del cierre de la conexión TCP.

## Seguridad

El modelo de seguridad de WebSocket es el mismo que utilizan los navegadores web, es decir, el llamado modelo de origen (igual que AJAX). Para un servidor web se restringen las páginas desde las que se puede establecer una conexión, evitando así vulnerabilidades de _cross-site scripting_. Evidentemente, esto solo tiene sentido cuando el protocolo se utiliza desde una página web.

Además, el proceso de negociación está pensado para asegurar que ambas partes están utilizando WebSocket y que, por tanto, no se está intentando establecer una conexión ilícita utilizando, por ejemplo, HTML y AJAX.

## API

La API WebSocket HTML5 en Web IDL (un formato para describir interfaces a implementar en navegadores web) aún está siendo normalizada por el World Wide Web Consortium. Esta API orientada a eventos permite a los navegadores web utilizar el protocolo a través de JavaScript en el contexto de una aplicación web.

### Establecimiento de la conexión

Para establecer una comunicación WebSocket es necesario crear un objeto `WebSocket`, que automáticamente intentará abrir una conexión con el servidor. El constructor acepta dos parámetros: el primero es la URL a la que conectarse (obligatorio) y el segundo es una cadena o un _array_ de cadenas indicando subprotocolos que permiten al servidor manejar diferentes tipos de interacción. Este último parámetro es opcional.

```
WebSocket WebSocket(
    in DOMString url,
    in optional DOMString protocols
);
```

Si ocurriese un error durante el establecimiento de la conexión, se enviarían dos eventos al objeto: uno de error (invocando al manejador `onerror`) y otro de cierre de conexión (invocando al manejador `onclose`).

El ejemplo que sigue muestra la forma de crear un objeto `WebSocket` que inicia una conexión segura sobre TLS (nótese el protocolo _wss_ en lugar de _ws_) a uno de los servidores utilizados para ofrecer el conocido servicio de mensajería WhatsApp Web.

```javascript
var socket = new WebSocket("wss://w7.web.whatsapp.com/ws");
```

### Envío de información

Una vez abierta la conexión es posible empezar a enviar información a través de ella. Para ello simplemente hay que llamar a la función `send()` del objeto creado.

```javascript
socket.send("Hi! 👋");
```

Sin embargo, no es una buena práctica utilizar este método ignorando que JavaScript ejecuta el código de forma asíncrona. Teniendo en cuenta lo anterior, la solución pasa por definir un manejador proporcionado por la API que es llamado cuando la conexión termina de establecerse.

```javascript
socket.onopen = function (event) {
    socket.send("Hi! 👋");
};
```

### Recepción de información

Cuando un mensaje llega, se pasa automáticamente un evento `message` como parámetro a la función `onmessage()`. Para empezar a escuchar en el canal de entrada solo hay que definir el manejador de la siguiente forma:

```javascript
socket.onmessage = function (event) {
    console.log(event.data);
};
```

### Cierre de la conexión

Cuando se ha terminado de enviar y recibir información es conveniente cerrar la conexión para no desperdiciar recursos tanto de la máquina cliente como del servidor. Cerrar una conexión es tan fácil como llamar al método `close()`:

```javascript
socket.close();
```

### Documentación

La [especificación](https://www.w3.org/TR/websockets/) de la API se encuentra disponible en la página web del World Wide Web Consortium. También existe [documentación](https://developer.mozilla.org/en-US/docs/Web/API/WebSockets_API) más amigable desarrollada por la fundación Mozilla y que se encuentra disponible en la Mozilla Developer Network.

## Ámbito de aplicación

WebSocket se puede utilizar en prácticamente cualquier plataforma y consta de implementación en otros ámbitos fuera del navegador web. Téngase en cuenta que las aplicaciones web cobran cada vez más importancia y para su desarrollo es necesario, además del navegador web en la parte del cliente, un lado servidor que soporte el protocolo.

Gran parte de los lenguajes más utilizados en el año 2015 disponen de API para WebSocket: C ([Libwebsockets](https://libwebsockets.org)), Java ([javax.websocket](https://docs.oracle.com/javaee/7/api/javax/websocket/package-summary.html)), Objective-C ([SocketRocket](https://github.com/square/SocketRocket)), PHP ([Elephant.IO](https://wisembly.github.io/elephant.io)) y, obviamente, JavaScript, entre otros. Además, también existen soluciones multiplataforma, como [Socket.IO](https://socket.io) para NodeJS.

### Soporte en navegadores web

En la tabla que hay a continuación se muestra, para los navegadores más utilizados actualmente, la versión desde la que soportan cada una de las definiciones de WebSocket. La versión actual de WebSocket es la 17 y es la misma que se define en el [RFC 6455](https://tools.ietf.org/html/rfc6455).

|            | Chrome | Firefox | Opera            | Safari      | Internet Explorer |
| ---------- | :----: | :-----: | :--------------: | :---------: | :---------------: |
| Versión 0  | 6      | 4       | 11 (desactivado) | 5.0.1       | No                |
| Versión 7  | No     | 6       | No               | No          | No                |
| Versión 10 | 14     | 7       | Desconocido      | Desconocido | No                |
| Versión 17 | 16     | 37      | 12.10            | 6           | 10                |

## Ventajas e inconvenientes

Como se ha visto, el protocolo permite establecer comunicaciones bidireccionales en tiempo real en la Web, posibilidad que antes solo existía de forma simulada y bastante costosa mediante técnicas como _long polling_. Optar por este protocolo permite reducir la saturación de cabeceras que ocurriría si se utilizase HTTP en su lugar, especialmente para aplicaciones que requieren un gran volumen de comunicaciones. Además, evita que cada aplicación utilice una solución de integración diferente, con los problemas de compatibilidad que ello conllevaría. Por otra parte, se ha visto que su funcionamiento es extremadamente sencillo: se establece una conexión, se envían/reciben mensajes y se cierra la conexión. Por último, al funcionar bajo los mismos puertos que HTTP evita problemas relacionados con cortafuegos, facilitando así el funcionamiento de productos basados en arquitecturas orientadas a servicios (SOA), entre otros.

Por otra parte, es necesario gestionar y mantener un gran número de conexiones que han de permanecer abiertas mientras ambas partes sigan interactuando. Esto puede llegar a ser un problema en determinados casos, teniendo en cuenta que el número máximo de conexiones simultáneas que admite un puerto TCP es de 64.000 y que, además, mantener las conexiones abiertas requiere memoria del servidor.

Por tanto, WebSocket es la mejor solución para aplicaciones que necesitan actualizaciones constantes en tiempo real como chats, juegos multijugador en línea o retransmisiones interactivas en directo. Sin embargo, no resulta una opción tan válida para aplicaciones que únicamente necesitan actualizaciones periódicas o basadas en eventos generados por el usuario.

## Caso real

Después de ver el funcionamiento de WebSocket y todo lo que puede aportar como tecnología de comunicaciones a la integración de aplicaciones, resulta interesante destacar un caso real en el que se utiliza el protocolo: WhatsApp Web.

El servicio de mensajería WhatsApp es un servicio distribuido. Su cliente web utiliza WebSocket para comunicarse con los servidores, que se encargan de almacenar información y retransmitir a los clientes web la información que solicitan indirectamente a los dispositivos móviles.

Utilizando las herramientas para desarrolladores que proporciona Google Chrome es posible analizar las comunicaciones entre un cliente WhatsApp Web y los servidores del servicio.

En la siguiente captura de pantalla se observa la negociación de apertura que inicia el cliente y la respuesta que recibe del servidor:

![](/static/articles/websocket/images/chrome-preview-1.png)

**Figura 2**: negociación de apertura vista desde la consola de desarrollo de Chrome.

Además, también es posible comprobar los mensajes enviados y recibidos, y de qué tipo son:

![](/static/articles/websocket/images/chrome-preview-2.png)

**Figura 3**: mensajes WebSocket desde la consola de desarrollo de Chrome.

## Conclusión

WebSocket permite que dos aplicaciones establezcan una comunicación bidireccional independientemente de la plataforma en la que estén ejecutándose y del lenguaje en el que hayan sido escritas. Además, existen multitud de implementaciones para prácticamente cualquier lenguaje que permiten a los desarrolladores centrarse en sus aplicaciones olvidándose de implementar las comunicaciones.

Esto abre un abanico de posibilidades para la integración de aplicaciones, permitiendo a estas intercambiar información en tiempo real y de forma sencilla, contribuyendo además a la estandarización de los mecanismos de comunicación.

## Bibliografía

- **Engine Yard.** [WebSocket: 5 Advantages of Using WebSockets](https://www.engineyard.com/articles/websocket). Consulta: 8 de noviembre de 2015.
- **Fette, I. y Melnikov, A. (2011).** [The WebSocket Protocol](https://tools.ietf.org/html/rfc6455). Internet Engineering Task Force. Consulta: 28 de octubre de 2015.
- **Hickson, I. (2012).** [The WebSocket API](https://www.w3.org/TR/websockets). W3C. Consulta: 1 de noviembre de 2015.
- **Kitamura, E. y Ubl, M. (2010).** [Introducing WebSockets: Bringing Sockets to the Web](https://www.html5rocks.com/en/tutorials/websockets/basics/). HTML5 Rocks. Consulta: 28 de octubre de 2015.
- **Mozilla Foundation (2015).** [WebSockets](https://developer.mozilla.org/en-US/docs/Web/API/WebSockets_API). Consulta: 8 de noviembre de 2015.
- **Tiobe Software (2015).** [TIOBE Index for November 2015](https://www.tiobe.com/index.php/content/paperinfo/tpci/index.html). Consulta: 8 de noviembre de 2015.
- **Web Hypertext Application Technology Working Group (2015).** "Web sockets" en [HTML5 Living Standard](https://html.spec.whatwg.org/multipage/comms.html#network), 9.3. Consulta: 1 de noviembre de 2015.
