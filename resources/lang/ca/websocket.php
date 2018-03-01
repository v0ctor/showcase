<?php
/**
 * WebSocket language strings.
 */

return [

    'title'       => 'Coneixent WebSocket',
    'description' => 'Anàlisi de WebSocket, un protocol que permet crear un canal de comunicació bidireccional sobre TCP.',

    'introduction' => [
        '1' => 'Des del principi de la seua existència, la Web s\'ha construït al voltant del paradigma petició/resposta d\'HTTP: l\'usuari carrega una pàgina i no ocorre res fins que este accedix a la següent. A partir de l\'any 2005, AJAX va començar a modificar este paradigma afegint la possibilitat de, una vegada carregada la pàgina, realitzar peticions per a obtenir informació addicional del servidor, siga de forma periòdica o a causa de la interacció de l\'usuari. La principal característica d\'AJAX és que el servidor no pot iniciar una comunicació amb el client, ja que és este últim qui sempre pren la iniciativa.',

        '2' => 'En oposició a estes tecnologies (conegudes com a <em>pull</em>), en les quals el client realitza la petició d\'enviament, existixen les conegudes com <em>push</em>, que permeten als servidors enviar informació al client en qualsevol moment; normalment quan tenen nova informació disponible. Cal destacar que este model no té cabuda en la Web a causa de les limitacions del seu propi plantejament, encara que s\'han intentat emular aproximacions mitjançant tècniques com <em>long polling</em>.',

        '3' => 'El protocol WebSocket planteja un model elegant i senzill de comunicacions per a la Web que no trenca amb les tecnologies ja existents.',

        '4' => 'Companyies d\'èxit com <a href="https://slack.com">Slack</a> (missatgeria corporativa), <a href="https://trello.com">Trello</a> (gestió de projectes), <a href="https://web.whatsapp.com">WhatsApp</a> (missatgeria personal) o <a href="https://pusher.com">Pusher</a> (serveis de comunicacions en temps real) utilitzen WebSocket per a oferir els seus serveis.',
    ],

    'protocol' => [
        'title' => 'Protocol',

        '1' => 'WebSocket és un protocol que permet crear un canal de comunicació bidireccional sobre una sola connexió TCP. Fou estandarditzat per la Internet Engineering Task Force [<a href="https://tools.ietf.org/html/rfc6455">RFC 6455</a>] en 2011. Està pensat per a ser implementat en navegadors i servidors web, encara que no hi ha cap impediment a l\'hora d\'implementar-lo en qualsevol altre tipus d\'aplicació que seguisca el model client/servidor.',

        '2' => 'Les comunicacions es realitzen a través dels mateixos ports que utilitza HTTP amb la finalitat d\'oferir compatibilitat amb el programari HTTP del costat del servidor ja existent. És a dir, quan el protocol treballa directament sobre TCP utilitza el port 80 i quan ho fa sobre TLS utilitza el 443. No obstant açò, WebSocket és un protocol independent.',

        '3' => 'El protocol es dividix en dues parts: la <strong>negociació</strong> i la <strong>transferència de dades</strong>. Com este coexistix amb HTTP, la primera comunicació ha de realitzar-se necessàriament a través d\'una <mark>petició</mark> HTTP. Per açò, la negociació d\'obertura comença amb una petició <em>upgrade</em> per part del client, que té el següent aspecte:',

        '4' => 'Cal destacar que l\'elecció del mètode GET és una decisió arbitrària presa pels autors de l\'esborrany que finalment va quedar plasmada en l\'RFC. Així i tot, és l\'únic mètode que contempla l\'estàndard i, per tant, l\'únic que s\'ha d\'utilitzar.',

        '5' => 'Per la seua banda, si tot va bé, el servidor respon amb un estat 101 (<em>switching protocols</em>), que té l\'aspecte que seguix:',

        '6' => 'En tots dos casos, tant en la petició com en la resposta, s\'inclouen una sèrie de capçaleres: obligatòries d\'HTTP/1.1 (<code>Host</code>), necessàries per a establir la negociació (<code>Upgrade</code>, <code>Connection</code> i <code>Sec-WebSocket-*</code>) o per qüestions relacionades amb model de seguretat escollit per al protocol (<code>Origin</code>).',

        '7' => 'Una vegada el client i el servidor han complit amb la seua part de la negociació, i únicament si no ha ocorregut cap error, comença la transferència d\'informació. A partir d\'eixe moment cada part pot enviar informació a plaure sense dependre de l\'altra, cosa impossible de fer amb HTTP, AJAX, les tecnologies push en general o tècniques més específiques com <em>long polling</em>. A més, WebSocket aporta avantatges respecte a models com Comet, la implementació dels quals no és trivial i és ineficient per a missatges xicotets.',

        '8' => 'En WebSocket, la unitat elemental de transferència d\'informació són els missatges, que estan compostos per una o més trames, cadascuna de les quals té un tipus de dades associat que coincidirà amb el qual tinguen la resta de trames del mateix missatge. Existixen trames que contenen text (que s\'interpreta com UTF-8) o informació binària, entre altres tipus. També existixen trames de control, pensades per a ser usades pel mateix protocol. La versió més recent de WebSocket definix sis tipus de trama i deixa deu més reservats per a ús futur.',

        '9' => 'La següent figura mostra una visió general d\'alt nivell de l\'estructura de les trames. Tinga\'s en compte que el format efectiu de la transferència de dades és binari (no ASCII) i està descrit per les ABNF (<em>Augmented BNF for Syntax Specifications</em>) [<a href="https://tools.ietf.org/html/rfc5234">RFC 5234</a>].',

        '10' => 'A continuació es descriu a grans trets el significat de cada camp:',

        '11' => [
            'a' => '<code>FIN</code> indica si la trama és l\'última del missatge. Note\'s que la primera trama pot ser també l\'última.',
            'b' => '<code>RSV1</code>, <code>RSV2</code> i <code>RSV3</code> estan reservats per al seu ús per part d\'extensions.',
            'c' => '<code>Opcode</code> definix el tipus de dades que conté la trama, explicat anteriorment.',
            'd' => '<code>Mask</code> indica si el camp <code>Payload data</code> està emmascarat. Totes les trames que van dirigides del client al servidor ho estan.',
            'e' => '<code>Payload length</code> definix la longitud del camp <code>Payload data</code> en bytes. El protocol establix un mecanisme per a poder utilitzar el camp <code>Extended payload length</code> per a indicar longituds majors que 127 bytes.',
            'f' => '<code>Masking-key</code> conté la màscara utilitzada per a emmascarar el camp <code>Payload data</code> i solament està present quan el camp <code>Mask</code> és 1.',
            'g' => '<code>Payload data</code> conté la informació en si.',
        ],

        '12' => 'D\'això anterior es deduïx que la fragmentació és una cosa corrent (i, en cas de missatges molt grans, inevitable) en WebSocket. No obstant açò, el protocol està pensat perquè la fragmentació s\'utilitze el mínim possible. De fet, s\'ha escollit un model basat en fragments per no escollir un basat en fluxos d\'informació, a més de per poder distingir entre tipus d\'informació. Cal assenyalar que en un protocol de nivell d\'aplicació no tindria molt sentit fragmentar sense una raó.',

        '13' => 'Finalment, quan una de les parts decidix que ja no hi ha res més per transmetre, és possible tancar la connexió mitjançant una negociació de tancament. Este s\'inicia enviant un missatge de control específic, al qual l\'altre extrem respon amb un altre missatge de control per a confirmar que el tancament és acordat. La negociació de tancament està pensada per a anar acompanyada del tancament de la connexió TCP.',
    ],

    'security' => [
        'title' => 'Seguretat',

        '1' => 'El model de seguretat de WebSocket és el mateix que utilitzen els navegadors web, és a dir, l\'anomenat model d\'origen (igual que AJAX). Per a un servidor web es restringixen les pàgines des de les quals es pot establir una connexió, evitant així vulnerabilitats de <em>cross-site scripting</em>. Evidentment, açò solament té sentit quan el protocol s\'utilitza des d\'una pàgina web.',

        '2' => 'A més, el procés de negociació està pensat per a assegurar que ambdues parts estan utilitzant WebSocket i que, per tant, no s\'està intentant establir una connexió il·lícita utilitzant, per exemple, HTML i AJAX.',
    ],

    'api' => [
        'title' => 'API',

        '1' => 'L\'API WebSocket HTML5 en Web IDL (un format per a descriure interfícies a implementar en navegadors web) encara està sent normalitzada pel World Wide Web Consortium. Esta API orientada a esdeveniments permet als navegadors web utilitzar el protocol a través de JavaScript en el context d\'una aplicació web.',

        'establishing_the_connection' => [
            'title' => 'Establiment de la connexió',

            '1' => 'Per a establir una comunicació WebSocket és necessari crear un objecte <code>WebSocket</code>, que automàticament intentarà obrir una connexió amb el servidor. El constructor accepta dos paràmetres: el primer és l\'URL a la qual connectar-se (obligatori) i el segon és una cadena o un vector de cadenes indicant subprotocols que permeten al servidor manejar diferents tipus d\'interacció. Este últim paràmetre és opcional.',

            '2' => 'Si ocorreguera un error durant l\'establiment de la connexió, s\'enviarien dos esdeveniments a l\'objecte: un d\'error (invocant al controlador <code>onerror</code>) i un altre de tancament de connexió (invocant al controlador <code>onclose</code>).',

            '3' => 'L\'exemple que seguix mostra la forma de crear un objecte <code>WebSocket</code> que inicia una connexió segura sobre TLS (note\'s el protocol <em>wss</em> en lloc de <em>ws</em>) a un dels servidors utilitzats per a oferir el conegut servei de missatgeria WhatsApp Web.',
        ],

        'sending_information' => [
            'title' => 'Enviament d\'informació',

            '1' => 'Una vegada oberta la connexió és possible començar a enviar informació a través d\'ella. Per a açò simplement cal cridar a la funció <code>send()</code> de l\'objecte creat.',

            '2' => 'No obstant açò, no és una bona pràctica utilitzar este mètode ignorant que JavaScript executa el codi de forma asíncrona. Tenint en compte l\'anterior, la solució implica definir un controlador proporcionat per l\'API que és cridat quan la connexió acaba d\'establir-se.',
        ],

        'receiving_information' => [
            'title' => 'Recepció d\'informació',

            '1' => 'Quan un missatge arriba, es passa automàticament un esdeveniment <code>message</code> com a paràmetre a la funció <code>onmessage()</code>. Per a començar a escoltar en el canal d\'entrada solament cal definir el controlador de la següent forma:',
        ],

        'closing_the_connection' => [
            'title' => 'Tancament de la connexió',

            '1' => 'Quan s\'ha acabat d\'enviar i rebre informació és convenient tancar la connexió per a no malgastar recursos tant de la màquina client com del servidor. Tancar una connexió és tan fàcil com cridar al mètode <code>close()</code>:',
        ],

        'documentation' => [
            'title' => 'Documentació',

            '1' => 'L\'<a href="http://www.w3.org/TR/websockets/">especificació</a> de l\'API es troba disponible en la pàgina web del World Wide Web Consortium. També existix <a href="https://developer.mozilla.org/en-US/docs/Web/API/WebSockets_API">documentació</a> més amigable desenvolupada per la fundació Mozilla i que es troba disponible en la Mozilla Developer Network.',
        ],
    ],

    'scope_of_application' => [
        'title' => 'Àmbit d\'aplicació',

        '1' => 'WebSocket es pot utilitzar en pràcticament qualsevol plataforma i consta d\'implementació en altres àmbits fóra del navegador web. Tinga\'s en compte que les aplicacions web cobren cada vegada més importància i per al seu desenvolupament és necessari, a més del navegador web en la part del client, un costat servidor que suporte el protocol.',

        '2' => 'Gran part dels llenguatges més utilitzats l\'any 2015 disposen d\'API per a WebSocket: C (<a href="https://libwebsockets.org">Libwebsockets</a>), Java (<a href="https://docs.oracle.com/javaee/7/api/javax/websocket/package-summary.html">javax.websocket</a>), Objective-C (<a href="https://github.com/square/SocketRocket">SocketRocket</a>), PHP (<a href="http://elephant.io">Elephant.IO</a>) i, òbviament, JavaScript, entre altres. A més, també existixen solucions multiplataforma, com <a href="http://socket.io">Socket.IO</a> per a NodeJS.',

        'web_browser_support' => [
            'title' => 'Suport en navegadors web',

            '1' => 'En la taula que hi ha a continuació es mostra, per als navegadors més utilitzats actualment, la versió des de la qual suporten cadascuna de les definicions de WebSocket. La versió actual de WebSocket és la 17 i és la mateixa que es definix en l\'<a href="https://tools.ietf.org/html/rfc6455">RFC 6455</a>.',

            'table' => [
                'version'  => 'Versió :number',
                'no'       => 'No',
                'unknown'  => 'Desconegut',
                'disabled' => ':version (desactivat)',
            ],
        ],
    ],

    'advantages_and_disadvantages' => [
        'title' => 'Avantatges i desavantatges',

        '1' => 'Com s\'ha vist, el protocol permet establir comunicacions bidireccionals en temps real en la Web, possibilitat que abans solament existia de forma simulada i bastant costosa mitjançant tècniques com <em>long polling</em>. Optar per este protocol permet reduir la saturació de capçaleres que ocorreria si s\'utilitzara HTTP en el seu lloc, especialment per a aplicacions que requerixen un gran volum de comunicacions. A més, evita que cada aplicació utilitze una solució d\'integració diferent, amb els problemes de compatibilitat que això comportaria. D\'altra banda, s\'ha vist que el seu funcionament és extremadament senzill: s\'establix una connexió, s\'envien/reben missatges i es tanca la connexió. Finalment, en funcionar baix els mateixos ports que HTTP evita problemes relacionats amb tallafocs, facilitant així el funcionament de productes basats en arquitectures orientades a serveis (SOA), entre altres.',

        '2' => 'D\'altra banda, és necessari gestionar i mantindre un gran nombre de connexions que han de romandre obertes mentre ambdues parts seguisquen interactuant. Açò pot arribar a ser un problema en determinats casos, tenint en compte que el nombre màxim de connexions simultànies que admet un port TCP és de 64.000 i que, a més, mantindre les connexions obertes requerix memòria del servidor.',

        '3' => 'Per tant, WebSocket és la millor solució per a aplicacions que necessiten actualitzacions constants en temps real com xats, jocs multijugador en línia o retransmissions interactives en directe. No obstant açò, no resulta una opció tan vàlida per a aplicacions que únicament necessiten actualitzacions periòdiques o basades en esdeveniments generats per l\'usuari.',
    ],

    'real_case' => [
        'title' => 'Cas real',

        '1' => 'Després de veure el funcionament de WebSocket i tot el que pot aportar com a tecnologia de comunicacions a la integració d\'aplicacions, resulta interessant destacar un cas real en el qual s\'utilitza el protocol: WhatsApp Web.',

        '2' => 'El servei de missatgeria WhatsApp és un servei distribuït. El seu client web utilitza WebSocket per a comunicar-se amb els servidors, que s\'encarreguen d\'emmagatzemar informació i retransmetre als clients web la informació que sol·liciten indirectament als dispositius mòbils.',

        '3' => 'Utilitzant les eines per a desenvolupadors que proporciona Google Chrome és possible analitzar les comunicacions entre un client WhatsApp Web i els servidors del servei.',

        '4' => 'En la següent captura de pantalla s\'observa la negociació d\'obertura que inicia el client i la resposta que rep del servidor:',

        '5' => 'A més, també és possible comprovar els missatges enviats i rebuts, i de quin tipus són:',
    ],

    'conclusion' => [
        'title' => 'Conclusió',

        '1' => 'WebSocket permet que dues aplicacions establisquen una comunicació bidireccional independentment de la plataforma en la qual estiguen executant-se i del llenguatge en el qual hagen sigut escrites. A més, existixen multitud d\'implementacions per a pràcticament qualsevol llenguatge que permeten als desenvolupadors centrar-se en les seues aplicacions oblidant-se d\'implementar les comunicacions.',

        '2' => 'Açò obri un ventall de possibilitats per a la integració d\'aplicacions, permetent a estes intercanviar informació en temps real i de forma senzilla, contribuint a més a l\'estandardització dels mecanismes de comunicació.',
    ],

    'figures' => [
        '1' => '<strong>Figura 1</strong>: estructura d\'una trama WebSocket.',
        '2' => '<strong>Figura 2</strong>: negociació d\'obertura vista des de la consola de desenvolupament de Chrome.',
        '3' => '<strong>Figura 3</strong>: missatges WebSocket des de la consola de desenvolupament de Chrome.',
    ],

];
