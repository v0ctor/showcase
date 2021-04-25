---
title: Coneixent WebSocket
description: Anàlisi de WebSocket, un protocol que permet crear un canal de comunicació bidireccional sobre TCP.
date: 2015-11-15
---

## Introducció

Des del principi de la seua existència, la Web s'ha construït al voltant del paradigma petició/resposta d'HTTP: l'usuari carrega una pàgina i no ocorre res fins que este accedix a la següent. A partir de l'any 2005, AJAX va començar a modificar este paradigma afegint la possibilitat de, una vegada carregada la pàgina, realitzar peticions per a obtenir informació addicional del servidor, siga de forma periòdica o a causa de la interacció de l'usuari. La principal característica d'AJAX és que el servidor no pot iniciar una comunicació amb el client, ja que és este últim qui sempre pren la iniciativa.

En oposició a estes tecnologies (conegudes com a _pull_), en les quals el client realitza la petició d'enviament, existixen les conegudes com _push_, que permeten als servidors enviar informació al client en qualsevol moment; normalment quan tenen nova informació disponible. Cal destacar que este model no té cabuda en la Web a causa de les limitacions del seu propi plantejament, encara que s'han intentat emular aproximacions mitjançant tècniques com _long polling_.

El protocol WebSocket planteja un model elegant i senzill de comunicacions per a la Web que no trenca amb les tecnologies ja existents.

Companyies d'èxit com [Slack](https://slack.com) (missatgeria corporativa), [Trello](https://trello.com) (gestió de projectes), [WhatsApp](https://web.whatsapp.com) (missatgeria personal) o [Pusher](https://pusher.com) (serveis de comunicacions en temps real) utilitzen WebSocket per a oferir els seus serveis.

## Protocol

WebSocket és un protocol que permet crear un canal de comunicació bidireccional sobre una sola connexió TCP. Fou estandarditzat per la Internet Engineering Task Force [[RFC 6455](https://tools.ietf.org/html/rfc6455)] en 2011. Està pensat per a ser implementat en navegadors i servidors web, encara que no hi ha cap impediment a l'hora d'implementar-lo en qualsevol altre tipus d'aplicació que seguisca el model client/servidor.

Les comunicacions es realitzen a través dels mateixos ports que utilitza HTTP amb la finalitat d'oferir compatibilitat amb el programari HTTP del costat del servidor ja existent. És a dir, quan el protocol treballa directament sobre TCP utilitza el port 80 i quan ho fa sobre TLS utilitza el 443. No obstant açò, WebSocket és un protocol independent.

El protocol es dividix en dues parts: la **negociació** i la **transferència de dades**. Com este coexistix amb HTTP, la primera comunicació ha de realitzar-se necessàriament a través d'una <mark>petició</mark> HTTP. Per açò, la negociació d'obertura comença amb una petició _upgrade_ per part del client, que té el següent aspecte:

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

Cal destacar que l'elecció del mètode GET és una decisió arbitrària presa pels autors de l'esborrany que finalment va quedar plasmada en l'RFC. Així i tot, és l'únic mètode que contempla l'estàndard i, per tant, l'únic que s'ha d'utilitzar.

Per la seua banda, si tot va bé, el servidor respon amb un estat 101 (_switching protocols_), que té l'aspecte que seguix:

```http request
HTTP/1.1 101 Switching Protocols
Upgrade: websocket
Connection: Upgrade
Sec-WebSocket-Accept: s3pPLMBiTxaQ9kYGzzhZRbK+xOo=
Sec-WebSocket-Protocol: chat
```

En tots dos casos, tant en la petició com en la resposta, s'inclouen una sèrie de capçaleres: obligatòries d'HTTP/1.1 (`Host`), necessàries per a establir la negociació (`Upgrade`, `Connection` i `Sec-WebSocket-*`) o per qüestions relacionades amb model de seguretat escollit per al protocol (`Origin`).

Una vegada el client i el servidor han complit amb la seua part de la negociació, i únicament si no ha ocorregut cap error, comença la transferència d'informació. A partir d'eixe moment cada part pot enviar informació a plaure sense dependre de l'altra, cosa impossible de fer amb HTTP, AJAX, les tecnologies push en general o tècniques més específiques com _long polling_. A més, WebSocket aporta avantatges respecte a models com Comet, la implementació dels quals no és trivial i és ineficient per a missatges xicotets.

En WebSocket, la unitat elemental de transferència d'informació són els missatges, que estan compostos per una o més trames, cadascuna de les quals té un tipus de dades associat que coincidirà amb el qual tinguen la resta de trames del mateix missatge. Existixen trames que contenen text (que s'interpreta com UTF-8) o informació binària, entre altres tipus. També existixen trames de control, pensades per a ser usades pel mateix protocol. La versió més recent de WebSocket definix sis tipus de trama i deixa deu més reservats per a ús futur.

La següent figura mostra una visió general d'alt nivell de l'estructura de les trames. Tinga's en compte que el format efectiu de la transferència de dades és binari (no ASCII) i està descrit per les ABNF (_Augmented BNF for Syntax Specifications_) [[RFC 5234](https://tools.ietf.org/html/rfc5234)].

![](/static/articles/websocket/images/frame-format.png)

**Figura 1**: estructura d'una trama WebSocket.

A continuació es descriu a grans trets el significat de cada camp:
- `FIN` indica si la trama és l'última del missatge. Note's que la primera trama pot ser també l'última.
- `RSV1`, `RSV2` i `RSV3` estan reservats per al seu ús per part d'extensions.
- `Opcode` definix el tipus de dades que conté la trama, explicat anteriorment.
- `Mask` indica si el camp `Payload data` està emmascarat. Totes les trames que van dirigides del client al servidor ho estan.
- `Payload length` definix la longitud del camp `Payload data` en bytes. El protocol establix un mecanisme per a poder utilitzar el camp `Extended payload length` per a indicar longituds majors que 127 bytes.
- `Masking-key` conté la màscara utilitzada per a emmascarar el camp `Payload data` i solament està present quan el camp `Mask` és 1.
- `Payload data` conté la informació en si.

D'això anterior es deduïx que la fragmentació és una cosa corrent (i, en cas de missatges molt grans, inevitable) en WebSocket. No obstant açò, el protocol està pensat perquè la fragmentació s'utilitze el mínim possible. De fet, s'ha escollit un model basat en fragments per no escollir un basat en fluxos d'informació, a més de per poder distingir entre tipus d'informació. Cal assenyalar que en un protocol de nivell d'aplicació no tindria molt sentit fragmentar sense una raó.

Finalment, quan una de les parts decidix que ja no hi ha res més per transmetre, és possible tancar la connexió mitjançant una negociació de tancament. Este s'inicia enviant un missatge de control específic, al qual l'altre extrem respon amb un altre missatge de control per a confirmar que el tancament és acordat. La negociació de tancament està pensada per a anar acompanyada del tancament de la connexió TCP.

## Seguretat

El model de seguretat de WebSocket és el mateix que utilitzen els navegadors web, és a dir, l'anomenat model d'origen (igual que AJAX). Per a un servidor web es restringixen les pàgines des de les quals es pot establir una connexió, evitant així vulnerabilitats de _cross-site scripting_. Evidentment, açò solament té sentit quan el protocol s'utilitza des d'una pàgina web.

A més, el procés de negociació està pensat per a assegurar que ambdues parts estan utilitzant WebSocket i que, per tant, no s'està intentant establir una connexió il·lícita utilitzant, per exemple, HTML i AJAX.

## API

L'API WebSocket HTML5 en Web IDL (un format per a descriure interfícies a implementar en navegadors web) encara està sent normalitzada pel World Wide Web Consortium. Esta API orientada a esdeveniments permet als navegadors web utilitzar el protocol a través de JavaScript en el context d'una aplicació web.

### Establiment de la connexió

Per a establir una comunicació WebSocket és necessari crear un objecte `WebSocket`, que automàticament intentarà obrir una connexió amb el servidor. El constructor accepta dos paràmetres: el primer és l'URL a la qual connectar-se (obligatori) i el segon és una cadena o un vector de cadenes indicant subprotocols que permeten al servidor manejar diferents tipus d'interacció. Este últim paràmetre és opcional.

```
WebSocket WebSocket(
    in DOMString url,
    in optional DOMString protocols
);
```

Si ocorreguera un error durant l'establiment de la connexió, s'enviarien dos esdeveniments a l'objecte: un d'error (invocant al controlador `onerror`) i un altre de tancament de connexió (invocant al controlador `onclose`).

L'exemple que seguix mostra la forma de crear un objecte `WebSocket` que inicia una connexió segura sobre TLS (note's el protocol _wss_ en lloc de _ws_) a un dels servidors utilitzats per a oferir el conegut servei de missatgeria WhatsApp Web.

```javascript
var socket = new WebSocket("wss://w7.web.whatsapp.com/ws");
```

### Enviament d'informació

Una vegada oberta la connexió és possible començar a enviar informació a través d'ella. Per a açò simplement cal cridar a la funció `send()` de l'objecte creat.

```javascript
socket.send("Hi! 👋");
```

No obstant açò, no és una bona pràctica utilitzar este mètode ignorant que JavaScript executa el codi de forma asíncrona. Tenint en compte l'anterior, la solució implica definir un controlador proporcionat per l'API que és cridat quan la connexió acaba d'establir-se.

```javascript
socket.onopen = function (event) {
    socket.send("Hi! 👋");
};
```

### Recepció d'informació

Quan un missatge arriba, es passa automàticament un esdeveniment `message` com a paràmetre a la funció `onmessage()`. Per a començar a escoltar en el canal d'entrada solament cal definir el controlador de la següent forma:

```javascript
socket.onmessage = function (event) {
    console.log(event.data);
};
```

### Tancament de la connexió

Quan s'ha acabat d'enviar i rebre informació és convenient tancar la connexió per a no malgastar recursos tant de la màquina client com del servidor. Tancar una connexió és tan fàcil com cridar al mètode `close()`:

```javascript
socket.close();
```

### Documentació

L'[especificació](https://www.w3.org/TR/websockets/) de l'API es troba disponible en la pàgina web del World Wide Web Consortium. També existix [documentació](https://developer.mozilla.org/en-US/docs/Web/API/WebSockets_API) més amigable desenvolupada per la fundació Mozilla i que es troba disponible en la Mozilla Developer Network.

## Àmbit d'aplicació

WebSocket es pot utilitzar en pràcticament qualsevol plataforma i consta d'implementació en altres àmbits fóra del navegador web. Tinga's en compte que les aplicacions web cobren cada vegada més importància i per al seu desenvolupament és necessari, a més del navegador web en la part del client, un costat servidor que suporte el protocol.

Gran part dels llenguatges més utilitzats l'any 2015 disposen d'API per a WebSocket: C ([Libwebsockets](https://libwebsockets.org)), Java ([javax.websocket](https://docs.oracle.com/javaee/7/api/javax/websocket/package-summary.html)), Objective-C ([SocketRocket](https://github.com/square/SocketRocket)), PHP ([Elephant.IO](https://wisembly.github.io/elephant.io)) i, òbviament, JavaScript, entre altres. A més, també existixen solucions multiplataforma, com [Socket.IO](https://socket.io) per a NodeJS.

### Suport en navegadors web

En la taula que hi ha a continuació es mostra, per als navegadors més utilitzats actualment, la versió des de la qual suporten cadascuna de les definicions de WebSocket. La versió actual de WebSocket és la 17 i és la mateixa que es definix en l'[RFC 6455](https://tools.ietf.org/html/rfc6455).

|           | Chrome | Firefox | Opera           | Safari     | Internet Explorer |
| --------- | :----: | :-----: | :-------------: | :--------: | :---------------: |
| Versió 0  | 6      | 4       | 11 (desactivat) | 5.0.1      | No                |
| Versió 7  | No     | 6       | No              | No         | No                |
| Versió 10 | 14     | 7       | Desconegut      | Desconegut | No                |
| Versió 17 | 16     | 37      | 12.10           | 6          | 10                |

## Avantatges i inconvenients

Com s'ha vist, el protocol permet establir comunicacions bidireccionals en temps real en la Web, possibilitat que abans solament existia de forma simulada i bastant costosa mitjançant tècniques com _long polling_. Optar per este protocol permet reduir la saturació de capçaleres que ocorreria si s'utilitzara HTTP en el seu lloc, especialment per a aplicacions que requerixen un gran volum de comunicacions. A més, evita que cada aplicació utilitze una solució d'integració diferent, amb els problemes de compatibilitat que això comportaria.

D'altra banda, s'ha vist que el seu funcionament és extremadament senzill: s'establix una connexió, s'envien/reben missatges i es tanca la connexió. Finalment, en funcionar baix els mateixos ports que HTTP evita problemes relacionats amb tallafocs, facilitant així el funcionament de productes basats en arquitectures orientades a serveis (SOA), entre altres.

Per tant, WebSocket és la millor solució per a aplicacions que necessiten actualitzacions constants en temps real com xats, jocs multijugador en línia o retransmissions interactives en directe. No obstant açò, no resulta una opció tan vàlida per a aplicacions que únicament necessiten actualitzacions periòdiques o basades en esdeveniments generats per l'usuari.

## Cas real

Després de veure el funcionament de WebSocket i tot el que pot aportar com a tecnologia de comunicacions a la integració d'aplicacions, resulta interessant destacar un cas real en el qual s'utilitza el protocol: WhatsApp Web.

El servei de missatgeria WhatsApp és un servei distribuït. El seu client web utilitza WebSocket per a comunicar-se amb els servidors, que s'encarreguen d'emmagatzemar informació i retransmetre als clients web la informació que sol·liciten indirectament als dispositius mòbils.

Utilitzant les eines per a desenvolupadors que proporciona Google Chrome és possible analitzar les comunicacions entre un client WhatsApp Web i els servidors del servei.

En la següent captura de pantalla s'observa la negociació d'obertura que inicia el client i la resposta que rep del servidor:

![](/static/articles/websocket/images/chrome-preview-1.png)

**Figura 2**: negociació d'obertura vista des de la consola de desenvolupament de Chrome.

A més, també és possible comprovar els missatges enviats i rebuts, i de quin tipus són:

![](/static/articles/websocket/images/chrome-preview-2.png)

**Figura 3**: missatges WebSocket des de la consola de desenvolupament de Chrome.

## Conclusió

WebSocket permet que dues aplicacions establisquen una comunicació bidireccional independentment de la plataforma en la qual estiguen executant-se i del llenguatge en el qual hagen sigut escrites. A més, existixen multitud d'implementacions per a pràcticament qualsevol llenguatge que permeten als desenvolupadors centrar-se en les seues aplicacions oblidant-se d'implementar les comunicacions.

Açò obri un ventall de possibilitats per a la integració d'aplicacions, permetent a estes intercanviar informació en temps real i de forma senzilla, contribuint a més a l'estandardització dels mecanismes de comunicació.

## Bibliografia

- **Engine Yard.** [WebSocket: 5 Advantages of Using WebSockets](https://www.engineyard.com/articles/websocket). Consulta: 8 de novembre de 2015.
- **Fette, I. i Melnikov, A. (2011).** [The WebSocket Protocol](https://tools.ietf.org/html/rfc6455). Internet Engineering Task Force. Consulta: 28 d'octubre de 2015.
- **Hickson, I. (2012).** [The WebSocket API](https://www.w3.org/TR/websockets). W3C. Consulta: 1 de novembre de 2015.
- **Kitamura, E. i Ubl, M. (2010).** [Introducing WebSockets: Bringing Sockets to the Web](https://www.html5rocks.com/en/tutorials/websockets/basics/). HTML5 Rocks. Consulta: 28 d'octubre de 2015.
- **Mozilla Foundation (2015).** [WebSockets](https://developer.mozilla.org/en-US/docs/Web/API/WebSockets_API). Consulta: 8 de novembre de 2015.
- **Tiobe Software (2015).** [TIOBE Index for November 2015](https://www.tiobe.com/index.php/content/paperinfo/tpci/index.html). Consulta: 8 de novembre de 2015.
- **Web Hypertext Application Technology Working Group (2015).** "Web sockets" en [HTML5 Living Standard](https://html.spec.whatwg.org/multipage/comms.html#network), 9.3. Consulta: 1 de novembre de 2015.
