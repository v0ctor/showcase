<?php
/**
 * Bitcoin language strings.
 */

return [

    'title'       => 'Bitcoin: planteamiento y protocolo',
    'description' => 'Análisis detallado del planteamiento de la criptodivisa Bitcoin y descripción del protocolo que la hace funcionar, relacionándolo con los conceptos más destacados de la criptografía moderna.',

    'introduction' => [
        '1' => 'Bitcoin es una moneda digital descentralizada, también denominada criptodivisa, concebida por una persona (o grupo de personas) bajo el pseudónimo de Satoshi Nakamoto. La <a href="https://bitcoin.org/bitcoin.pdf">primera publicación</a> con referencia a la moneda y a su protocolo data de 2008, mientras que su primera implementación como software de código abierto fue lanzada en 2009. En la actualidad es la moneda alternativa más utilizada, con un mercado total de cien millones de dólares estadounidenses.',

        '2' => 'El protocolo está pensado para no permitir la existencia de más de veintiún millones de bitcoins —nótese que Bitcoin hace referencia a la moneda y bitcoin a la unidad—, estableciendo que esta se reduzca a la mitad cada aproximadamente cuatro años.',

        '3' => 'La divisa consta de tres elementos fundamentales: las direcciones, el libro mayor de transacciones (o cadena de bloques) y la red. El balance de una cuenta, representada por una dirección, no es más que el sumatorio de sus transacciones entrantes (valor positivo) y salientes (valor negativo). La red es la encargada de verificar la legitimidad y viabilidad de las transacciones, es decir, que estas han sido emitidas por los legítimos propietarios de las cuentas y que ninguna cuenta envíe dinero del que no dispone. Para que todo ello funcione en consonancia hay diseñado todo un protocolo basado en diversas técnicas criptográficas.',

        '4' => 'El objetivo de esta publicación es analizar los detalles de su planteamiento y describir el protocolo que la hace funcionar, relacionándolo con los conceptos más destacados de la criptografía moderna.',
    ],

    'cryptographic_basis' => [
        'title' => 'Fundamento criptográfico',

        '1' => 'Bitcoin se apoya sobre dos elementos criptográficos sin los que su arquitectura sería imposible: las funciones <em>hash</em> y la firma digital basada en la criptografía de clave asimétrica.',

        'hash_functions' => [
            'title' => 'Funciones <em>hash</em> o resumen',

            '1' => 'Una <a href="https://es.wikipedia.org/wiki/Funci%C3%B3n_hash">función <em>hash</em></a> es un algoritmo matemático que dada una entrada de cualquier longitud proporciona una salida de longitud fija, sirviendo así como resumen de dicha información. Nótese que no se trata de una función de compresión, ya que no es <a href="https://es.wikipedia.org/wiki/Funci%C3%B3n_inyectiva">inyectiva</a> y, por tanto, tampoco invertible. De lo anterior se deduce que podrá haber colisiones si el número de elementos del conjunto de entrada es superior al de salida, es decir, la función devolverá la misma salida para dos entradas diferentes.',

            '2' => 'Por ejemplo, la función <a href="https://es.wikipedia.org/wiki/MD5">MD5</a> produce las siguientes salidas, con una longitud fija de 128 bits:',

            'table' => [
                '0' => [
                    'a' => 'Entrada',
                    'b' => 'Salida',
                ],

                '1' => [
                    'a' => 'hola',
                    'b' => '4d186321c1a7f0f354b297e8914ab240',
                ],

                '2' => [
                    'a' => 'Hola',
                    'b' => 'f688ae26e9cfa3ba6235477831d5122e',
                ],

                '3' => [
                    'a' => 'adiós',
                    'b' => '863c922aa361c088e897fdd9c5eb3dad',
                ],
            ],

            '3' => 'Para que las funciones resumen tengan una aplicación práctica en criptografía es necesario que cumplan una serie de características adicionales a la definición básica:',

            '4' => [
                'a' => 'Dada una entrada debe ser muy fácil calcular su salida. Sin embargo, ha de ser computacionalmente impracticable la función inversa, aun conociendo el algoritmo.',

                'b' => 'Deben tener un alto nivel de tolerancia a colisiones. Esto es, las colisiones han de ser muy improbables y, en caso de ocurrir, deben hacerlo para valores de entrada radicalmente diferentes.',

                'c' => 'Han de ser capaces de proporcionar una salida de longitud fija independientemente de la longitud de la entrada.',

                'd' => 'El más mínimo cambio entre dos entradas debe producir salidas totalmente diferentes. En el ejemplo anterior puede apreciarse que las salidas de <code>hola</code> y <code>Hola</code> son esencialmente diferentes a pesar de la similitud de las entradas.',
            ],

            '5' => 'El protocolo Bitcoin hace un uso importante de la función de resumen SHA-256, la variante del conjunto de funciones <a href="https://es.wikipedia.org/wiki/Secure_Hash_Algorithm">Secure Hash Algorithm 2</a> con salida de 256 bits. Esta función, al contrario que MD5, es considerada criptográficamente segura en la actualidad.',
        ],

        'asymmetric_cryptography' => [
            'title' => 'Criptografía asimétrica',

            '1' => 'La <a href="https://es.wikipedia.org/wiki/Criptograf%C3%ADa_asim%C3%A9trica">criptografía asimétrica</a> o de clave pública, en contraposición a la <a href="https://es.wikipedia.org/wiki/Criptograf%C3%ADa_sim%C3%A9trica">criptografía simétrica</a> o de clave secreta, se basa en el uso de dos claves para el intercambio de información. Dichas claves están matemáticamente relacionadas de tal forma que es posible cifrar con la clave pública y solo es computacionalmente practicable descifrar con la clave privada.',

            '2' => 'Por tanto, una persona puede compartir su clave pública a través de un canal inseguro, pudiendo cualquier persona cifrar con ella un mensaje con la garantía de que solo el poseedor de la clave privada podrá descifrarlo.',

            '3' => 'Sin embargo, la aplicación de la criptografía asimétrica en Bitcoin no es el intercambio de información, sino la firma digital.',
        ],

        'digital_signature' => [
            'title' => 'Firma digital',

            '1' => 'La criptografía de clave pública puede ser utilizada para dar soporte a un sistema llamado <a href="https://es.wikipedia.org/wiki/Firma_digital">firma digital</a>, que permite dotar a un mensaje de:',

            '2' => [
                'a' => '<strong>Autenticidad</strong>: garantía de la certeza del origen del mensaje.',

                'b' => '<strong>Integridad</strong>: posibilidad de detectar si el mensaje ha sido modificado o permanece íntegro.',

                'c' => '<strong>No repudio</strong>: imposibilidad de negar la autoría del mensaje.',
            ],

            '3' => 'El primer paso a la hora de firmar un mensaje consiste en obtener un <em>hash</em> o resumen del mismo. Esto se hace para evitar ataques de falsificación que podrían llevarse a cabo en caso de aplicar la firma directamente al mensaje en lugar de hacerlo al <em>hash</em>, además de por razones de eficiencia, compatibilidad e integridad que no caben detallar en el ámbito de esta publicación. A continuación se firma el resumen con la clave privada del emisor, normalmente utilizando RSA. Por último debe adjuntarse el mensaje junto con la firma, pudiendo a partir de ese momento ser comprobada su validez por cualquier persona mediante la clave pública del emisor.',
        ],
    ],

    'protocol' => [
        'title' => 'Protocolo',

        '1' => 'Bitcoin se define como una sucesión de transacciones entre direcciones. Además, todos los procesos son públicos, por lo que cualquier persona puede conocer las transacciones que desee y, en consecuencia, el balance de cualquier cuenta. La privacidad del sistema radica en las medidas que tome cada persona para dificultar su vinculación con una determinada dirección.',

        'addresses' => [
            'title' => 'Direcciones',

            '1' => 'Una dirección está formada por un par de claves (pública y privada) de curva elíptica (<a href="https://es.wikipedia.org/wiki/ECDSA">ECDSA</a>). Este tipo de criptografía asimétrica permite operaciones más rápidas y claves más pequeñas para el mismo nivel de seguridad en comparación con otros algoritmos de firma digital como <a href="https://es.wikipedia.org/wiki/DSA">DSA</a>.',

            '2' => 'Un identificador es una cadena única de entre 26 y 35 caracteres que se calcula a partir de la clave pública aplicándole las funciones <em>hash</em> SHA-256 y <a href="https://es.wikipedia.org/wiki/RIPEMD-160">RIPEMD-160</a>. A continuación se codifica en base 58, que no es más que una codificación en <a href="https://es.wikipedia.org/wiki/Base64">base 64</a> habiéndole eliminado los caracteres no alfanuméricos o que puedan dar lugar a ambigüedades.',

            '3' => 'Este es el aspecto que tiene una dirección Bitcoin una vez generada y transformada la clave pública:',

            '4' => 'Un usuario no necesita estar conectado a la red para generar direcciones y puede tener tantas como desee, ya que para ello únicamente ha de generar pares de claves asimétricas. Es más, el protocolo recomienda la generación de una dirección diferente para cada operación, considerándolas de un solo uso.',

            '5' => 'La propia dirección incluye 32 bits de verificación para evitar errores a la hora de copiar a mano los identificadores. De esta forma, el software puede contemplar el rechazo de una transacción con direcciones inválidas antes de propagarla por la red.',
        ],

        'transactions' => [
            'title' => 'Transacciones',

            '1' => 'Una transacción, que es la unidad atómica de la cadena de bloques (véase más adelante), consiste en un envío de cierta cantidad de moneda de una o más direcciones a sendas direcciones, admitiendo fracciones de hasta 10<sup>-8</sup> bitcoins (denominadas <em>satoshis</em>). Toda transacción se firma digitalmente mediante el proceso explicado anteriormente con la clave privada asociada a la dirección que envía el dinero, por lo que se garantiza que únicamente el legítimo propietario puede emitir transacciones desde una cuenta. Además, se añade una marca temporal única para evitar ataques de repetición.',

            '2' => 'Como cada transacción puede incluir diversas direcciones (tanto de envío como de recepción) y no hay ninguna forma de conocer si esas direcciones pertenecen a una misma persona o entidad, puede afirmarse que el protocolo no permite llevar a cabo la trazabilidad del dinero.',
        ],

        'blocks' => [
            'title' => 'Bloques',

            '1' => 'Las transacciones se agrupan en bloques, los cuales están compuestos por una cabecera y un árbol Merkle o árbol de <em>hashes</em>.',

            '2' => 'En las hojas del árbol se sitúan todas las transacciones que forman parte del bloque. Las hojas no tienen hermanos y su padre es su <em>hash</em>. El rango entre el penúltimo nivel del árbol y la raíz es un subárbol binario donde cada padre es el resultado de aplicar una función <em>hash</em> (SHA-256) a sus dos hijos.',

            '3' => 'La cabecera de un bloque está formada por la raíz del árbol Merkle, el <em>hash</em> de la cabecera del bloque anterior (más adelante se verá que los bloques se encadenan) y un número aleatorio llamado <em>nonce</em>.',

            '4' => 'El campo <em>nonce</em> es una de las partes más importantes del protocolo, ya que es su existencia la que hace posible incentivar la verificación de transacciones, también conocida como minado.',
        ],

        'proof_of_work_test' => [
            'title' => 'Prueba de trabajo',

            '1' => 'El protocolo establece un valor máximo para el <em>hash</em> de la cabecera de los bloques. Téngase en cuenta que cualquier cadena de caracteres puede ser interpretada como un número, por lo que en este caso el requisito es equivalente a que el <em>hash</em> de la cabecera empiece como mínimo por un número dado de ceros.',

            'table' => [
                'block'                  => 'Bloque :number',
                'block_hash'             => '<em>Hash</em> de la cabecera',
                'merkle_root'            => '<em>Hash</em> raíz',
                'number_of_transactions' => 'Transacciones',
                'difficulty'             => 'Dificultad',
                'height'                 => 'Posición en la cadena',
                'size'                   => 'Tamaño',
                'reward'                 => 'Recompensa',
                'version'                => 'Versión',
                'date'                   => 'Fecha',
                'nonce'                  => '<em>Nonce</em>',
            ],

            '2' => 'Cualquier bloque el <em>hash</em> de cuya cabecera no cumpla con el valor objetivo será rechazado por la red. El valor objetivo se ajusta por la propia red automáticamente cada dos semanas para que de media se produzca un bloque cada diez minutos.',

            '3' => 'Para hacer que un bloque cumpla los requisitos que establece el protocolo es fundamental el papel del campo <em>nonce</em>. Se trata de un número entero que se va incrementando a medida que se va volviendo a calcular el <em>hash</em> hasta que se obtiene un valor válido. El minado de bitcoins es sencillamente eso: iterar el cálculo del <em>hash</em> incrementando en cada iteración el <em>nonce</em>.',

            '4' => 'Una vez obtenido un bloque válido se envía al resto de la red. Como la comprobación es trivial el resto de mineros verifican que sea correcta y en caso de serlo lo añaden a su copia local de la cadena de bloques para seguir con el siguiente bloque.',

            '5' => 'Cabe destacar que la primera transacción de cada bloque difiere necesariamente entre mineros, ya que siempre es una emisión de moneda de 25 bitcoins (que se reduce a la mitad por cada 210.000 bloques verificados) destinada a una dirección del propio minero. De esa forma se regula el crecimiento de la moneda y se recompensa a quienes participan en su verificación. Por esa razón el campo <em>nonce</em> para un mismo bloque también será diferente entre mineros. Además, cada minero añade a un bloque las transacciones que le van llegando, por lo que puede haber varios mineros intentando minar a la vez un mismo bloque que sin embargo puede contener diferentes transacciones.',

            '6' => 'La combinación de la prueba de trabajo y el consenso que existe entre los participantes para respetar el protocolo son la solución que Bitcoin ofrece al conocido problema en criptografía de los <a href="https://es.wikipedia.org/wiki/Problema_de_los_dos_generales">generales bizantinos</a>. El protocolo confía en que la generación de bloques falsos está desincentivada, ya que serán rechazados por la red y solo habrán servido para malgastar recursos (hardware y energía, que al fin y al cabo se pagan con dinero real) del atacante. Por tanto, el sistema únicamente queda abierto a que un atacante con suficientes nodos y capacidad de cómputo sea capaz de generar un falso consenso, es decir, un consenso rompiendo el protocolo.',
        ],

        'block_chain' => [
            'title' => 'Cadena de bloques',

            '1' => 'Como se ha indicado anteriormente, todos los bloques válidos van encadenándose en una cadena de bloques pública, también llamada libro mayor de transacciones. Para calcular el balance de una dirección únicamente hay que recorrer todo el libro sumando y restando los valores entrantes y salientes para esa dirección. En consecuencia, la cantidad de moneda de una dirección no se anota como tal en ningún sitio. Por esa razón se dice que la unidad fundamental en Bitcoin son las transacciones.',

            '2' => 'De acuerdo con el análisis realizado de la prueba de trabajo, podría darse una situación en la que dos mineros diferentes encontraran a la vez un bloque válido y lo propagasen por la red, dando lugar a una bifurcación en la cadena de bloques. En ese caso la prueba de trabajo ofrece una solución implícita: el siguiente bloque válido debería producirse necesariamente en primer lugar en una de las dos bifurcaciones, por lo que los mineros (incluyendo los causantes de la bifurcación) pasarían a centrarse en la rama con más consenso, ya que sería la única con recompensas de minado efectivas.',

            '3' => 'En cuanto a la integridad de la cadena, un bloque es más fiable cuanto más antiguo es. Cualquier modificación en una transacción desencadenaría unos cambios en cascada a través del árbol Merkle del bloque que llegarían hasta la propia cabecera. Por tanto, también modificarían el <em>hash</em> de la cabecera del bloque, que se incluye en la cabecera del siguiente, modificándola también. De esa forma, un cambio en cualquier bloque invalidaría todos los siguientes.',

            '4' => 'Dependiendo de la profundidad de un bloque, podría llevar años a un atacante realizar una modificación fraudulenta y volver a calcular toda la cadena. Mientras tanto, el resto de la red seguiría minando bitcoins e incrementando la longitud de la cadena. Además, aunque el atacante tuviera capacidad de cómputo ilimitada no sería capaz de convencer a un número suficiente de nodos para reemplazar bloques antiguos dados por válidos, por lo que el ataque sería inviable. En este sentido la prueba de trabajo entra en juego de nuevo: lo más probable es que el atacante prefiera invertir los recursos del ataque en minar bitcoins en lugar de realizar un ataque computacionalmente impracticable.',
        ],

        'six_confirmations' => [
            'title' => 'Seis confirmaciones',

            '1' => 'Cuando un bloque se añade a la cadena se considera que todas sus transacciones han sido confirmadas y son irreversibles. Sin embargo, dicho bloque puede formar parte de una bifurcación y ser rechazado por la mayoría de nodos posteriormente. Considérese un atacante con el 10 % de capacidad de cómputo de la red y con tanta suerte que consigue calcular en un minuto un bloque fraudulento a priori válido, cosa que debería costarle una media de cien minutos en condiciones normales ―en ese tiempo se habrían añadido de media diez bloques más a la cadena―. Este tipo de situaciones son altamente improbables, pero no imposibles.',

            '2' => 'En la <a href="https://bitcoin.org/bitcoin.pdf">publicación original</a> de Nakamoto se contempla esta situación y se ofrecen cálculos que demuestran que la probabilidad de éxito de un atacante decrece exponencialmente con la profundidad del bloque a modificar.',

            'table' => [
                'control_of_network_capacity' => 'Control del :percent % de capacidad de la red',
                'blocks_to_rewrite'           => 'Bloques a reescribir',
                'probability_of_success'      => 'Probabilidad de éxito',
            ],

            '3' => 'De la tabla anterior puede extraerse que un atacante con el control del 10 % de la capacidad de cómputo de la red tendría un 0,024 % de posibilidades de tener éxito al reescribir seis bloques. Por esa razón, y únicamente para transacciones de grandes cantidades de dinero, se recomienda esperar a que dicha transacción haya alcanzado los seis bloques de profundidad para ser tomada como definitiva. Esto se conoce como seis confirmaciones en el argot de Bitcoin.',
        ],
    ],

    'conclusion' => [
        'title' => 'Conclusión',

        '1' => 'Se han expuesto los aspectos criptográficos detrás del protocolo Bitcoin y se ha analizado el propio protocolo sin entrar en aspectos demasiado técnicos. Sin embargo, Bitcoin es susceptible a más tipos de análisis: <a href="https://mixtifori.wordpress.com/2016/05/03/bitcoin-donde-estamos-y-hacia-donde-vamos/">legales</a>, económicos, macroeconómicos, históricos, políticos, matemáticos e incluso más técnicos a nivel de especificación de protocolo.',

        '2' => 'Es curioso que métodos y conceptos que inicialmente estaban pensados para ocultar información a terceras personas y garantizar comunicaciones fidedignas hayan sido utilizados para dar lugar a un sistema en el que ninguna información es privada.',

        '3' => 'Además, por primera vez en la historia se ha planteado un sistema monetario no fiduciario, es decir, no basado en la fe o confianza. Bitcoin se basa exclusivamente en planteamientos matemáticos y en las aplicaciones de las matemáticas a diferentes ámbitos, concretamente la aplicación de la criptografía a las tecnologías de la información y comunicación. Incluso cuando se confía en cierto comportamiento por parte de los usuarios, se está haciendo en base a planteamientos sociológicos y probabilísticos bastante sólidos.',

        '4' => 'Por último, parece ser fundamental profundizar en el funcionamiento y planteamiento de Bitcoin antes de considerar si usarla y cómo usarla. Puede no ser adecuada para todas las personas y ámbitos de uso, tratándose de una moneda diferente al concepto de dinero que tiene la sociedad.',
    ],

    'figures' => [
        '1' => '<strong>Figura 1</strong>: algoritmo de firma digital.',
        '2' => '<strong>Figura 2</strong>: representación de una posible transacción.',
        '3' => '<strong>Figura 3</strong>: bloque de transacciones.',
        '4' => '<strong>Figura 4</strong>: representación de la cadena de bloques considerando únicamente las cabeceras.',
    ],

];
