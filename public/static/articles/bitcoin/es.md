---
title: 'Bitcoin: planteamiento y protocolo'
description: Análisis detallado del planteamiento de la criptodivisa Bitcoin y descripción del protocolo que la hace funcionar, relacionándolo con los conceptos más destacados de la criptografía moderna.
date: 2016-04-13
---

## Introducción

Bitcoin es una moneda digital descentralizada, también denominada criptodivisa, concebida por una persona (o grupo de personas) bajo el pseudónimo de Satoshi Nakamoto. La [primera publicación](https://bitcoin.org/bitcoin.pdf) con referencia a la moneda y a su protocolo data de 2008, mientras que su primera implementación como software de código abierto fue lanzada en 2009. En la actualidad es la moneda alternativa más utilizada, con un mercado total de cien millones de dólares estadounidenses.

El protocolo está pensado para no permitir la existencia de más de veintiún millones de bitcoins —nótese que Bitcoin hace referencia a la moneda y bitcoin a la unidad—, estableciendo que esta se reduzca a la mitad cada aproximadamente cuatro años.

La divisa consta de tres elementos fundamentales: las direcciones, el libro mayor de transacciones (o cadena de bloques) y la red. El balance de una cuenta, representada por una dirección, no es más que el sumatorio de sus transacciones entrantes (valor positivo) y salientes (valor negativo). La red es la encargada de verificar la legitimidad y viabilidad de las transacciones, es decir, que estas han sido emitidas por los legítimos propietarios de las cuentas y que ninguna cuenta envíe dinero del que no dispone. Para que todo ello funcione en consonancia hay diseñado todo un protocolo basado en diversas técnicas criptográficas.

El objetivo de esta publicación es analizar los detalles de su planteamiento y describir el protocolo que la hace funcionar, relacionándolo con los conceptos más destacados de la criptografía moderna.

## Fundamento criptográfico

Bitcoin se apoya sobre dos elementos criptográficos sin los que su arquitectura sería imposible: las funciones _hash_ y la firma digital basada en la criptografía de clave asimétrica.

### Funciones _hash_ o resumen

Una [función _hash_](https://es.wikipedia.org/wiki/Funci%C3%B3n_hash) es un algoritmo matemático que dada una entrada de cualquier longitud proporciona una salida de longitud fija, sirviendo así como resumen de dicha información. Nótese que no se trata de una función de compresión, ya que no es [inyectiva](https://es.wikipedia.org/wiki/Funci%C3%B3n_inyectiva) y, por tanto, tampoco invertible. De lo anterior se deduce que podrá haber colisiones si el número de elementos del conjunto de entrada es superior al de salida, es decir, la función devolverá la misma salida para dos entradas diferentes.

Por ejemplo, la función [MD5](https://es.wikipedia.org/wiki/MD5) produce las siguientes salidas, con una longitud fija de 128 bits:

| Entrada | Salida                             |
| :-----: | :--------------------------------: |
| `hola`  | `4d186321c1a7f0f354b297e8914ab240` |
| `Hola`  | `f688ae26e9cfa3ba6235477831d5122e` |
| `adiós` | `863c922aa361c088e897fdd9c5eb3dad` |

Para que las funciones resumen tengan una aplicación práctica en criptografía es necesario que cumplan una serie de características adicionales a la definición básica:
- 'Dada una entrada debe ser muy fácil calcular su salida. Sin embargo, ha de ser computacionalmente impracticable la función inversa, aun conociendo el algoritmo.
- Deben tener un alto nivel de tolerancia a colisiones. Esto es, las colisiones han de ser muy improbables y, en caso de ocurrir, deben hacerlo para valores de entrada radicalmente diferentes.
- Han de ser capaces de proporcionar una salida de longitud fija independientemente de la longitud de la entrada.
- El más mínimo cambio entre dos entradas debe producir salidas totalmente diferentes. En el ejemplo anterior puede apreciarse que las salidas de `hola` y `Hola` son esencialmente diferentes a pesar de la similitud de las entradas.

El protocolo Bitcoin hace un uso importante de la función de resumen SHA-256, la variante del conjunto de funciones [Secure Hash Algorithm 2](https://es.wikipedia.org/wiki/Secure_Hash_Algorithm) con salida de 256 bits. Esta función, al contrario que MD5, es considerada criptográficamente segura en la actualidad.

### Criptografía asimétrica

La [criptografía asimétrica](https://es.wikipedia.org/wiki/Criptograf%C3%ADa_asim%C3%A9trica) o de clave pública, en contraposición a la [criptografía simétrica](https://es.wikipedia.org/wiki/Criptograf%C3%ADa_sim%C3%A9trica) o de clave secreta, se basa en el uso de dos claves para el intercambio de información. Dichas claves están matemáticamente relacionadas de tal forma que es posible cifrar con la clave pública y solo es computacionalmente practicable descifrar con la clave privada.

Por tanto, una persona puede compartir su clave pública a través de un canal inseguro, pudiendo cualquier persona cifrar con ella un mensaje con la garantía de que solo el poseedor de la clave privada podrá descifrarlo.

Sin embargo, la aplicación de la criptografía asimétrica en Bitcoin no es el intercambio de información, sino la firma digital.

### Firma digital

La criptografía de clave pública puede ser utilizada para dar soporte a un sistema llamado [firma digital](https://es.wikipedia.org/wiki/Firma_digital), que permite dotar a un mensaje de:
- **Autenticidad**: garantía de la certeza del origen del mensaje.
- **Integridad**: posibilidad de detectar si el mensaje ha sido modificado o permanece íntegro.
- **No repudio**: imposibilidad de negar la autoría del mensaje.

El primer paso a la hora de firmar un mensaje consiste en obtener un _hash_ o resumen del mismo. Esto se hace para evitar ataques de falsificación que podrían llevarse a cabo en caso de aplicar la firma directamente al mensaje en lugar de hacerlo al _hash_, además de por razones de eficiencia, compatibilidad e integridad que no caben detallar en el ámbito de esta publicación. A continuación se firma el resumen con la clave privada del emisor, normalmente utilizando RSA. Por último debe adjuntarse el mensaje junto con la firma, pudiendo a partir de ese momento ser comprobada su validez por cualquier persona mediante la clave pública del emisor.

![](/static/articles/bitcoin/images/digital-signature-es.png)

**Figura 1**: algoritmo de firma digital.

## Protocolo

Bitcoin se define como una sucesión de transacciones entre direcciones. Además, todos los procesos son públicos, por lo que cualquier persona puede conocer las transacciones que desee y, en consecuencia, el balance de cualquier cuenta. La privacidad del sistema radica en las medidas que tome cada persona para dificultar su vinculación con una determinada dirección.

### Direcciones

Una dirección está formada por un par de claves (pública y privada) de curva elíptica ([ECDSA](https://es.wikipedia.org/wiki/ECDSA)). Este tipo de criptografía asimétrica permite operaciones más rápidas y claves más pequeñas para el mismo nivel de seguridad en comparación con otros algoritmos de firma digital como [DSA](https://es.wikipedia.org/wiki/DSA).

Un identificador es una cadena única de entre 26 y 35 caracteres que se calcula a partir de la clave pública aplicándole las funciones _hash_ SHA-256 y [RIPEMD-160](https://es.wikipedia.org/wiki/RIPEMD-160). A continuación se codifica en base 58, que no es más que una codificación en [base 64](https://es.wikipedia.org/wiki/Base64) habiéndole eliminado los caracteres no alfanuméricos o que puedan dar lugar a ambigüedades.

```
i = base58(ripemd160(sha256(pk)))
```

Este es el aspecto que tiene una dirección Bitcoin una vez generada y transformada la clave pública:

```
1SdBftaLuBGECamx5Dob6js9PxQ2w1Rhe
```

Un usuario no necesita estar conectado a la red para generar direcciones y puede tener tantas como desee, ya que para ello únicamente ha de generar pares de claves asimétricas. Es más, el protocolo recomienda la generación de una dirección diferente para cada operación, considerándolas de un solo uso.

La propia dirección incluye 32 bits de verificación para evitar errores a la hora de copiar a mano los identificadores. De esta forma, el software puede contemplar el rechazo de una transacción con direcciones inválidas antes de propagarla por la red.

### Transacciones

Una transacción, que es la unidad atómica de la cadena de bloques (véase más adelante), consiste en un envío de cierta cantidad de moneda de una o más direcciones a sendas direcciones, admitiendo fracciones de hasta 10<sup>-8</sup> bitcoins (denominadas _satoshis_). Toda transacción se firma digitalmente mediante el proceso explicado anteriormente con la clave privada asociada a la dirección que envía el dinero, por lo que se garantiza que únicamente el legítimo propietario puede emitir transacciones desde una cuenta. Además, se añade una marca temporal única para evitar ataques de repetición.

Como cada transacción puede incluir diversas direcciones (tanto de envío como de recepción) y no hay ninguna forma de conocer si esas direcciones pertenecen a una misma persona o entidad, puede afirmarse que el protocolo no permite llevar a cabo la trazabilidad del dinero.

![](/static/articles/bitcoin/images/transaction.png)

**Figura 2**: representación de una posible transacción.

### Bloques

Las transacciones se agrupan en bloques, los cuales están compuestos por una cabecera y un árbol Merkle o árbol de _hashes_.

En las hojas del árbol se sitúan todas las transacciones que forman parte del bloque. Las hojas no tienen hermanos y su padre es su _hash_. El rango entre el penúltimo nivel del árbol y la raíz es un subárbol binario donde cada padre es el resultado de aplicar una función _hash_ (SHA-256) a sus dos hijos.

La cabecera de un bloque está formada por la raíz del árbol Merkle, el _hash_ de la cabecera del bloque anterior (más adelante se verá que los bloques se encadenan) y un número aleatorio llamado _nonce_.

El campo _nonce_ es una de las partes más importantes del protocolo, ya que es su existencia la que hace posible incentivar la verificación de transacciones, también conocida como minado.

![](/static/articles/bitcoin/images/block-ca.png)

**Figura 3**: bloque de transacciones.

### Prueba de trabajo

El protocolo establece un valor máximo para el _hash_ de la cabecera de los bloques. Téngase en cuenta que cualquier secuencia de bits (representada en hexadecimal en este caso) puede ser interpretada como un número, por lo que en este caso el requisito es equivalente a que el _hash_ de la cabecera empiece como mínimo por un número dado de ceros.

| Metadato                  | Valor para el bloque 405.506                                                  |
| :------------------------ | :---------------------------------------------------------------------------- |
| **_Hash_ de la cabecera** | <mark>00000000000000000</mark>4dc4a5c870352f14a67c4bd54fcee28240775d3bc4f431c |
| **_Hash_ raíz**           | 11171e15a04559474885b540acc9ece5f649c519618745c7ca1cd31d62c5a7a9              |
| **Transacciones**         | 1.653                                                                         |
| **Posición en la cadena** | 405.506                                                                       |
| **Recompensa**            | 25 bitcoins                                                                   |
| **Fecha**                 | 3 d'abril de 2016 a les 09:37                                                 |
| **Dificultad**            | 166.851.513.282,7772                                                          |
| **Tamaño**                | 994.707 bytes                                                                 |
| **Versión**               | 4                                                                             |
| **_Nonce_**               | 1.405.982.784                                                                 |

Cualquier bloque el _hash_ de cuya cabecera no cumpla con el valor objetivo será rechazado por la red. El valor objetivo se ajusta por la propia red automáticamente cada dos semanas para que de media se produzca un bloque cada diez minutos.

Para hacer que un bloque cumpla los requisitos que establece el protocolo es fundamental el papel del campo _nonce_. Se trata de un número entero que se va incrementando a medida que se va volviendo a calcular el _hash_ hasta que se obtiene un valor válido. El minado de bitcoins es sencillamente eso: iterar el cálculo del _hash_ incrementando en cada iteración el _nonce_.

Una vez obtenido un bloque válido se envía al resto de la red. Como la comprobación es trivial el resto de mineros verifican que sea correcta y en caso de serlo lo añaden a su copia local de la cadena de bloques para seguir con el siguiente bloque.

Cabe destacar que la primera transacción de cada bloque difiere necesariamente entre mineros, ya que siempre es una emisión de moneda de 25 bitcoins (que se reduce a la mitad por cada 210.000 bloques verificados) destinada a una dirección del propio minero. De esa forma se regula el crecimiento de la moneda y se recompensa a quienes participan en su verificación. Por esa razón el campo _nonce_ para un mismo bloque también será diferente entre mineros. Además, cada minero añade a un bloque las transacciones que le van llegando, por lo que puede haber varios mineros intentando minar a la vez un mismo bloque que sin embargo puede contener diferentes transacciones.

La combinación de la prueba de trabajo y el consenso que existe entre los participantes para respetar el protocolo son la solución que Bitcoin ofrece al conocido problema en criptografía de los [generales bizantinos](https://es.wikipedia.org/wiki/Problema_de_los_dos_generales). El protocolo confía en que la generación de bloques falsos está desincentivada, ya que serán rechazados por la red y solo habrán servido para malgastar recursos (hardware y energía, que al fin y al cabo se pagan con dinero real) del atacante. Por tanto, el sistema únicamente queda abierto a que un atacante con suficientes nodos y capacidad de cómputo sea capaz de generar un falso consenso, es decir, un consenso rompiendo el protocolo.

### Cadena de bloques

Como se ha indicado anteriormente, todos los bloques válidos van encadenándose en una cadena de bloques pública, también llamada libro mayor de transacciones. Para calcular el balance de una dirección únicamente hay que recorrer todo el libro sumando y restando los valores entrantes y salientes para esa dirección. En consecuencia, la cantidad de moneda de una dirección no se anota como tal en ningún sitio. Por esa razón se dice que la unidad fundamental en Bitcoin son las transacciones.

De acuerdo con el análisis realizado de la prueba de trabajo, podría darse una situación en la que dos mineros diferentes encontraran a la vez un bloque válido y lo propagasen por la red, dando lugar a una bifurcación en la cadena de bloques. En ese caso la prueba de trabajo ofrece una solución implícita: el siguiente bloque válido debería producirse necesariamente en primer lugar en una de las dos bifurcaciones, por lo que los mineros (incluyendo los causantes de la bifurcación) pasarían a centrarse en la rama con más consenso, ya que sería la única con recompensas de minado efectivas.

En cuanto a la integridad de la cadena, un bloque es más fiable cuanto más antiguo es. Cualquier modificación en una transacción desencadenaría unos cambios en cascada a través del árbol Merkle del bloque que llegarían hasta la propia cabecera. Por tanto, también modificarían el _hash_ de la cabecera del bloque, que se incluye en la cabecera del siguiente, modificándola también. De esa forma, un cambio en cualquier bloque invalidaría todos los siguientes.

Dependiendo de la profundidad de un bloque, podría llevar años a un atacante realizar una modificación fraudulenta y volver a calcular toda la cadena. Mientras tanto, el resto de la red seguiría minando bitcoins e incrementando la longitud de la cadena. Además, aunque el atacante tuviera capacidad de cómputo ilimitada no sería capaz de convencer a un número suficiente de nodos para reemplazar bloques antiguos dados por válidos, por lo que el ataque sería inviable. En este sentido la prueba de trabajo entra en juego de nuevo: lo más probable es que el atacante prefiera invertir los recursos del ataque en minar bitcoins en lugar de realizar un ataque computacionalmente impracticable.

![](/static/articles/bitcoin/images/chain-ca.png)

**Figura 4**: representación de la cadena de bloques considerando únicamente las cabeceras.

### Seis confirmaciones

Cuando un bloque se añade a la cadena se considera que todas sus transacciones han sido confirmadas y son irreversibles. Sin embargo, dicho bloque puede formar parte de una bifurcación y ser rechazado por la mayoría de nodos posteriormente. Considérese un atacante con el 10 % de capacidad de cómputo de la red y con tanta suerte que consigue calcular en un minuto un bloque fraudulento a priori válido, cosa que debería costarle una media de cien minutos en condiciones normales ―en ese tiempo se habrían añadido de media diez bloques más a la cadena―. Este tipo de situaciones son altamente improbables, pero no imposibles.

En la [publicación original](https://bitcoin.org/bitcoin.pdf) de Nakamoto se contempla esta situación y se ofrecen cálculos que demuestran que la probabilidad de éxito de un atacante decrece exponencialmente con la profundidad del bloque a modificar. Por ejemplo, para un atacante con el control del 10 % de capacidad de la red:

| Bloques a reescribir | Probabilidad de éxito |
| -------------------- | --------------------- |
| 0	                   | 1                     |
| 1	                   | 0,2045873             |
| 2	                   | 0,0509779             |
| 3	                   | 0,0131722             |
| 4	                   | 0,0034552             |
| 5	                   | 0,0009137             |
| 6	                   | 0,0002428             |
| 7	                   | 0,0000647             |
| 8	                   | 0,0000173             |
| 9	                   | 0,0000046             |
| 10                   | 0,0000012             |

Y en el caso de tener el control del 30 % de capacidad de la red:

| Bloques a reescribir | Probabilidad de éxito |
| -------------------- | --------------------- |
| 0                    | 1                     |
| 5                    | 0,1773523             |
| 10                   | 0,0416605             |
| 15                   | 0,0101008             |
| 20                   | 0,0024804             |
| 25                   | 0,0006132             |
| 30                   | 0,0001522             |
| 35                   | 0,0000379             |
| 40                   | 0,0000095             |
| 45                   | 0,0000024             |
| 50                   | 0,0000006             |

De las tablas anteriores puede extraerse que un atacante con el control del 10 % de la capacidad de cómputo de la red tendría un 0,024 % de posibilidades de tener éxito al reescribir seis bloques. Por esa razón, y únicamente para transacciones de grandes cantidades de dinero, se recomienda esperar a que dicha transacción haya alcanzado los seis bloques de profundidad para ser tomada como definitiva. Esto se conoce como seis confirmaciones en el argot de Bitcoin.

## Conclusión

Se han expuesto los aspectos criptográficos detrás del protocolo Bitcoin y se ha analizado el propio protocolo sin entrar en aspectos demasiado técnicos. Sin embargo, Bitcoin es susceptible a más tipos de análisis: [legales](https://mixtifori.wordpress.com/2016/05/03/bitcoin-donde-estamos-y-hacia-donde-vamos/), económicos, macroeconómicos, históricos, políticos, matemáticos e incluso más técnicos a nivel de especificación de protocolo.

Es curioso que métodos y conceptos que inicialmente estaban pensados para ocultar información a terceras personas y garantizar comunicaciones fidedignas hayan sido utilizados para dar lugar a un sistema en el que ninguna información es privada.

Además, por primera vez en la historia se ha planteado un sistema monetario no fiduciario, es decir, no basado en la fe o confianza. Bitcoin se basa exclusivamente en planteamientos matemáticos y en las aplicaciones de las matemáticas a diferentes ámbitos, concretamente la aplicación de la criptografía a las tecnologías de la información y comunicación. Incluso cuando se confía en cierto comportamiento por parte de los usuarios, se está haciendo en base a planteamientos sociológicos y probabilísticos bastante sólidos.

Por último, parece ser fundamental profundizar en el funcionamiento y planteamiento de Bitcoin antes de considerar si usarla y cómo usarla. Puede no ser adecuada para todas las personas y ámbitos de uso, tratándose de una moneda diferente al concepto de dinero que tiene la sociedad.

## Bibliografía

- **Badev, A. y Chen, M. (2014).** [Bitcoin: Technical Background and Data Analysis](https://www.federalreserve.gov/econresdata/feds/2014/files/2014104pap.pdf). Board of Governors of the Federal Reserve System. Consulta: 28 de marzo de 2016.
- **Fernández-Villaverde, J. (2015).** [Mis Aventuras con Bitcoin II: El Funcionamiento de Bitcoin](https://nadaesgratis.es/fernandez-villaverde/mis-aventuras-con-bitcoin-ii). Nada es gratis. Consulta: 28 de marzo de 2016.
- **Franco, P. (2014).** Understanding Bitcoin: Cryptography, Engineering and Economics. Chichester: John Wiley & Sons.
- **Nakamoto, S. (2008).** [Bitcoin: A Peer-to-Peer Electronic Cash System](https://bitcoin.org/bitcoin.pdf). Bitcoin. Consulta: 28 de marzo de 2016.
- **Nielsen, M. (2013).** [How the Bitcoin protocol actually works](https://www.michaelnielsen.org/ddi/how-the-bitcoin-protocol-actually-works). Data-driven intelligence. Consulta: 31 de marzo de 2016.
- **Pacia, C. (2013).** [Bitcoin Mining Explained Like You’re Five: Part 1 – Incentives](https://chrispacia.wordpress.com/2013/09/02/bitcoin-mining-explained-like-youre-five-part-1-incentives). Escape Velocity. Consulta: 4 de abril de 2016.
- **Pacia, C. (2013).** [Bitcoin Mining Explained Like You’re Five: Part 2 – Mechanics](https://chrispacia.wordpress.com/2013/09/02/bitcoin-mining-explained-like-youre-five-part-2-mechanics). Escape Velocity. Consulta: 4 de abril de 2016.
- **Pacia, C. (2013).** [Bitcoin Explained Like You’re Five: Part 3 – Cryptography](https://chrispacia.wordpress.com/2013/09/07/bitcoin-cryptography-digital-signatures-explained). Escape Velocity. Consulta: 4 de abril de 2016.
