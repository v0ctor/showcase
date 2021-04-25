---
title: 'Bitcoin: plantejament i protocol'
description: Anàlisi detallada del plantejament de la criptodivisa Bitcoin i descripció del protocol que la fa funcionar, relacionant-ho amb els conceptes més destacats de la criptografia moderna.
date: 2016-04-13
---

## Introducció

Bitcoin és una moneda digital descentralitzada, també denominada criptodivisa, concebuda per una persona (o grup de persones) sota el pseudònim de Satoshi Nakamoto. La [primera publicació](https://bitcoin.org/bitcoin.pdf) amb referència a la moneda i al seu protocol data de 2008, mentre que la seua primera implementació com a programari de codi obert fou llançada en 2009. En l'actualitat és la moneda alternativa més utilitzada, amb un mercat total de cent milions de dòlars estatunidencs.

El protocol està pensat per a no permetre l'existència de més de vint-i-un milions de bitcoins —note's que Bitcoin fa referència a la moneda i bitcoin a la unitat—, establint que esta es reduïsca a la meitat cada aproximadament quatre anys.

La divisa consta de tres elements fonamentals: les adreces, el llibre major de transaccions (o cadena de blocs) i la xarxa. El balanç d'un compte, representat per una adreça, no és més que el sumatori de les seues transaccions entrants (valor positiu) i ixents (valor negatiu). La xarxa és l'encarregada de verificar la legitimitat i viabilitat de les transaccions, és a dir, que estes han sigut emeses pels legítims propietaris dels comptes i que cap compte envie diners dels quals no disposa. Perquè tot açò funcione en consonància existix tot un protocol basat en diverses tècniques criptogràfiques.

L'objectiu d'esta publicació és analitzar els detalls del seu plantejament i descriure el protocol que la fa funcionar, relacionant-ho amb els conceptes més destacats de la criptografia moderna.

## Fonament criptogràfic

Bitcoin es recolza sobre dos elements criptogràfics sense els quals la seua arquitectura seria impossible: les funcions _hash_ i la signatura digital basada en la criptografia de clau asimètrica.

### Funcions _hash_ o resum

Una [funció _hash_](https://ca.wikipedia.org/wiki/Funci%C3%B3_hash) és un algorisme matemàtic que donada una entrada de qualsevol longitud proporciona una eixida de longitud fixa, servint així com a resum d'esta informació. Note's que no es tracta d'una funció de compressió, ja que no és [injectiva](https://ca.wikipedia.org/wiki/Funci%C3%B3_injectiva) i, per tant, tampoc invertible. Del fet anterior es deduïx que podrà haver-hi col·lisions si el nombre d'elements del conjunt d'entrada és superior al d'eixida, és a dir, la funció tornarà la mateixa eixida per a dues entrades diferents.

Per exemple, la funció [MD5](https://ca.wikipedia.org/wiki/MD5) produïx les següents eixides, amb una longitud fixa de 128 bits:

| Entrada | Eixida                             |
| :-----: | :--------------------------------: |
| `hola`  | `4d186321c1a7f0f354b297e8914ab240` |
| `Hola`  | `f688ae26e9cfa3ba6235477831d5122e` |
| `adéu`  | `00e18965352790f2264ca0ebd07ee014` |

Perquè les funcions resum tinguen una aplicació pràctica en criptografia és necessari que complisquen una sèrie de característiques addicionals a la definició bàsica:
- Donada una entrada ha de ser molt fàcil calcular la seua eixida. No obstant açò, ha de ser computacionalment impracticable la funció inversa, tot coneixent l'algorisme.
- Han de tindre un alt nivell de tolerància a col·lisions. Açò és, les col·lisions han de ser molt improbables i, en cas d'ocórrer, han de fer-ho per a valors d'entrada radicalment diferents.
- Han de ser capaços de proporcionar una eixida de longitud fixa independentment de la longitud de l'entrada.
- El més mínim canvi entre dues entrades ha de produir eixides totalment diferents. En l'exemple anterior pot apreciar-se que les eixides d'`hola` i `Hola` són essencialment diferents malgrat la similitud de les entrades.

El protocol Bitcoin fa un ús important de la funció de resum SHA-256, la variant del conjunt de funcions [Secure Hash Algorithm 2](https://ca.wikipedia.org/wiki/Secure_Hash_Algorithm) amb eixida de 256 bits. Esta funció, al contrari que MD5, és considerada criptogràficament segura en l'actualitat.

### Criptografia asimètrica

La [criptografia asimètrica](https://ca.wikipedia.org/wiki/Criptografia_de_clau_p%C3%BAblica) o de clau pública, en contraposició a la [criptografia simètrica](https://ca.wikipedia.org/wiki/Criptografia_sim%C3%A8trica) o de clau secreta, es basa en l'ús de dues claus per a l'intercanvi d'informació. Estes claus estan matemàticament relacionades de tal forma que és possible xifrar amb la clau pública i solament és computacionalment practicable desxifrar amb la clau privada.

Per tant, una persona pot compartir la seua clau pública a través d'un canal insegur, podent qualsevol persona xifrar amb ella un missatge amb la garantia que solament el posseïdor de la clau privada podrà desxifrar-ho.

No obstant açò, l'aplicació de la criptografia asimètrica en Bitcoin no és l'intercanvi d'informació, sinó la signatura digital.

### Signatura digital

La criptografia de clau pública pot ser utilitzada per a donar suport a un sistema anomenat [signatura digital](https://ca.wikipedia.org/wiki/Signatura_digital), que permet dotar a un missatge de:
- **Autenticitat**: garantia de la certesa de l'origen del missatge.
- **Integritat**: possibilitat de detectar si el missatge ha sigut modificat o roman íntegre.
- **No repudi**: impossibilitat de negar l'autoria del missatge.

El primer pas a l'hora de signar un missatge consistix a obtenir un _hash_ o resum del mateix. Açò es fa per a evitar atacs de falsificació que podrien dur-se a terme en cas d'aplicar la signatura directament al missatge en lloc de fer-ho al _hash_, a més de per raons d'eficiència, compatibilitat i integritat que no calen detallar en l'àmbit d'esta publicació. A continuació se signa el resum amb la clau privada de l'emissor, normalment utilitzant RSA. Finalment ha d'adjuntar-se el missatge juntament amb la signatura, podent a partir d'eixe moment ser comprovada la seua validesa per qualsevol persona mitjançant la clau pública de l'emissor.

![](/static/articles/bitcoin/images/digital-signature-ca.png)

**Figura 1**: algorisme de signatura digital.

## Protocol

Bitcoin es definix com una successió de transaccions entre adreces. A més, tots els processos són públics, per la qual cosa qualsevol persona pot conéixer les transaccions que desitge i, en conseqüència, el balanç de qualsevol compte. La privadesa del sistema radica en les mesures que prenga cada persona per a dificultar la seua vinculació amb una determinada adreça.

### Adreces

Una adreça està formada per un parell de claus (pública i privada) de corba el·líptica (ECDSA). Este tipus de criptografia asimètrica permet operacions més ràpides i claus més xicotetes per al mateix nivell de seguretat en comparació d'altres algorismes de signatura digital com [DSA](https://ca.wikipedia.org/wiki/DSA).

Un identificador és una cadena única d'entre 26 i 35 caràcters que es calcula a partir de la clau pública aplicant-li les funcions _hash_ SHA-256 i RIPEMD-160. A continuació es codifica en base 58, que no és més que una codificació en [base 64](https://ca.wikipedia.org/wiki/Base64) havent-li eliminat els caràcters no alfanumèrics o que puguen donar lloc a ambigüitats.

```
i = base58(ripemd160(sha256(pk)))
```

Este és l'aspecte que té una adreça Bitcoin una vegada generada i transformada la clau pública:

```
1SdBftaLuBGECamx5Dob6js9PxQ2w1Rhe
```

Un usuari no necessita estar connectat a la xarxa per a generar adreces i pot tindre tantes com desitge, ja que per a això únicament ha de generar parells de claus asimètriques. És més, el protocol recomana la generació d'una adreça diferent per a cada operació, considerant-les d'un sol ús.

La mateixa adreça inclou 32 bits de verificació per a evitar errors a l'hora de copiar a mà els identificadors. D'esta forma, el programari pot contemplar el rebuig d'una transacció amb adreces invàlides abans de propagar-la per la xarxa.

### Transaccions

Una transacció, que és la unitat atòmica de la cadena de blocs (vegeu més endavant), consistix en un enviament de certa quantitat de moneda d'una o més adreces a sengles adreces, admetent fraccions de fins a 10<sup>-8</sup> bitcoins (denominades _satoshis_). Tota transacció se signa digitalment mitjançant el procés explicat anteriorment amb la clau privada associada a l'adreça que envia els diners, per la qual cosa es garantix que únicament el legítim propietari pot emetre transaccions des d'un compte. A més, s'afig una marca temporal única per a evitar atacs de repetició.

Com cada transacció pot incloure diverses adreces (tant d'enviament com de recepció) i no hi ha cap forma de conéixer si eixes adreces pertanyen a una mateixa persona o entitat, pot afirmar-se que el protocol no permet dur a terme la traçabilitat dels diners.

![](/static/articles/bitcoin/images/transaction.png)

**Figura 2**: representació d'una possible transacció.

### Blocs

Les transaccions s'agrupen en blocs, els quals estan compostos per una capçalera i un arbre Merkle o arbre de _hash_.

En les fulles de l'arbre se situen totes les transaccions que formen part del bloc. Les fulles no tenen germans i el seu pare és el seu _hash_. El rang entre el penúltim nivell de l'arbre i l'arrel és un subarbre binari on cada pare és el resultat d'aplicar una funció _hash_ (SHA-256) als seus dos fills.

La capçalera d'un bloc està formada per l'arrel de l'arbre Merkle, el _hash_ de la capçalera del bloc anterior (més endavant es veurà que els blocs s'encadenen) i un nombre aleatori anomenat _nonce_.

El camp _nonce_ és una de les parts més importants del protocol, ja que és la seua existència la que fa possible incentivar la verificació de transaccions, també coneguda com minat.

![](/static/articles/bitcoin/images/block-ca.png)

**Figura 3**: bloc de transaccions.

### Prova de treball

El protocol establix un valor màxim per al _hash_ de la capçalera dels blocs. Tinga's en compte que qualsevol seqüència de bits (representada en hexadecimal en este cas) pot ser interpretada com un número, per la qual cosa el requisit és equivalent al fet que el _hash_ de la capçalera comence com a mínim per un nombre donat de zeros.

| Metadada                   | Valor per al bloc 405.506                                                     |
| :------------------------- | :---------------------------------------------------------------------------- |
| **_Hash_ de la capçalera** | <mark>00000000000000000</mark>4dc4a5c870352f14a67c4bd54fcee28240775d3bc4f431c |
| **_Hash_ arrel**           | 11171e15a04559474885b540acc9ece5f649c519618745c7ca1cd31d62c5a7a9              |
| **Transaccions**           | 1.653                                                                         |
| **Posició en la cadena**   | 405.506                                                                       |
| **Recompensa**             | 25 bitcoins                                                                   |
| **Data**                   | 3 d'abril de 2016 a les 09:37                                                 |
| **Dificultat**             | 166.851.513.282,7772                                                          |
| **Mida**                   | 994.707 bytes                                                                 |
| **Versió**                 | 4                                                                             |
| **_Nonce_**                | 1.405.982.784                                                                 |

Qualsevol bloc el _hash_ de la capçalera del qual no complisca amb el valor objectiu serà rebutjat per la xarxa. El valor objectiu s'ajusta per la mateixa xarxa automàticament cada dues setmanes perquè de mitjana es produïsca un bloc cada deu minuts.

Per a fer que un bloc complisca els requisits que establix el protocol és fonamental el paper del camp _nonce_. Es tracta d'un número enter que es va incrementant a mesura que es va tornant a calcular el _hash_ fins que s'obté un valor vàlid. El minat de bitcoins és senzillament açò: iterar el càlcul del _hash_ incrementant en cada iteració el _nonce_.

Una vegada obtingut un bloc vàlid s'envia a la resta de la xarxa. Com la comprovació és trivial, la resta de miners verifiquen que siga correcta i, en cas de ser-ho, l'afigen a la seua còpia local de la cadena de blocs per a seguir amb el següent bloc.

Cal destacar que la primera transacció de cada bloc diferix necessàriament entre miners, ja que sempre és una emissió de moneda de 25 bitcoins (que es reduïx a la meitat per cada 210.000 blocs verificats) destinada a una adreça del mateix miner. D'eixa forma es regula el creixement de la moneda i es recompensa als qui participen en la seua verificació. Per eixa raó el camp _nonce_ per a un mateix bloc també serà diferent entre miners. A més, cada miner afig a un bloc les transaccions que li van arribant, per la qual cosa pot haver-hi diversos miners intentant minar alhora un mateix bloc que, no obstant això, pot contenir diferents transaccions.

La combinació de la prova de treball i el consens que existix entre els participants per a respectar el protocol són la solució que Bitcoin oferix al conegut problema en criptografia dels generals bizantins. El protocol confia en què la generació de blocs falsos està desincentivada, ja que seran rebutjats per la xarxa i solament hauran servit per a malgastar recursos (maquinari i energia, que al cap i a la fi es paguen amb diners reals) de l'atacant. Per tant, el sistema únicament queda obert al fet que un atacant amb suficients nodes i capacitat de còmput siga capaç de generar un fals consens, és a dir, un consens trencant el protocol.

### Cadena de blocs

Com s'ha indicat anteriorment, tots els blocs vàlids van encadenant-se en una cadena de blocs pública, també anomenada llibre major de transaccions. Per a calcular el balanç d'una adreça únicament cal recórrer tot el llibre sumant i restant els valors entrants i ixents per a eixa adreça. En conseqüència, la quantitat de moneda d'una adreça no s'anota com a tal en cap lloc. Per eixa raó es diu que la unitat fonamental en Bitcoin són les transaccions.

D'acord amb l'anàlisi realitzada de la prova de treball, podria donar-se una situació en la qual dos miners diferents trobaren alhora un bloc vàlid i el propagaren per la xarxa, donant lloc a una bifurcació en la cadena de blocs. En eixe cas la prova de treball oferix una solució implícita: el següent bloc vàlid hauria de produir-se necessàriament en primer lloc en una de les dues bifurcacions, per la qual cosa els miners (inclosos els causants de la bifurcació) passarien a centrar-se en la branca amb més consens, ja que seria l'única amb recompenses de minat efectives.

Quant a la integritat de la cadena, un bloc és més fiable com més antic és. Qualsevol modificació en una transacció desencadenaria uns canvis en cascada a través de l'arbre Merkle del bloc que arribarien fins a la mateixa capçalera. Per tant, també modificarien el _hash_ de la capçalera del bloc, que s'inclou en la capçalera del següent, modificant-la també. D'eixa forma, un canvi en qualsevol bloc invalidaria tots els següents.

Depenent de la profunditat d'un bloc, podria portar anys a un atacant realitzar una modificació fraudulenta i tornar a calcular tota la cadena. Mentrestant, la resta de la xarxa seguiria minant bitcoins i incrementant la longitud de la cadena. A més, encara que l'atacant tinguera capacitat de còmput il·limitada no seria capaç de convéncer a un nombre suficient de nodes per a reemplaçar blocs antics donant-los per vàlids, per la qual cosa l'atac seria inviable. En este sentit la prova de treball entra en joc de nou: el més probable és que l'atacant preferisca invertir els recursos de l'atac en minar bitcoins en lloc de realitzar un atac computacionalment impracticable.

![](/static/articles/bitcoin/images/chain-ca.png)

**Figura 4**: representació de la cadena de blocs considerant únicament les capçaleres.

### Sis confirmacions

Quan un bloc s'afig a la cadena es considera que totes les seues transaccions han sigut confirmades i són irreversibles. No obstant això, eixe bloc pot formar part d'una bifurcació i ser rebutjat per la majoria de nodes posteriorment. Considere's un atacant amb el 10 % de capacitat de còmput de la xarxa i amb tanta sort que aconseguix calcular en un minut un bloc fraudulent a priori vàlid, cosa que hauria de costar-li una mitjana de cent minuts en condicions normals ―en eixe temps s'haurien afegit de mitjana deu blocs més a la cadena―. Este tipus de situacions són altament improbables, però no impossibles.

En la [publicació original](https://bitcoin.org/bitcoin.pdf) de Nakamoto es contempla esta situació i s'oferixen càlculs que demostren que la probabilitat d'èxit d'un atacant decreix exponencialment amb la profunditat del bloc a modificar. Per exemple, per a un atacant amb el control del 10 % de capacitat de la xarxa:

| Blocs a reescriure | Probabilitat d'èxit |
| ------------------ | ------------------- |
| 0	                 | 1                   |
| 1	                 | 0,2045873           |
| 2	                 | 0,0509779           |
| 3	                 | 0,0131722           |
| 4	                 | 0,0034552           |
| 5	                 | 0,0009137           |
| 6	                 | 0,0002428           |
| 7	                 | 0,0000647           |
| 8	                 | 0,0000173           |
| 9	                 | 0,0000046           |
| 10                 | 0,0000012           |

I en el cas de tindre el control del 30 % de capacitat de la xarxa:

| Blocs a reescriure | Probabilitat d'èxit |
| ------------------ | ------------------- |
| 0                  | 1                   |
| 5                  | 0,1773523           |
| 10                 | 0,0416605           |
| 15                 | 0,0101008           |
| 20                 | 0,0024804           |
| 25                 | 0,0006132           |
| 30                 | 0,0001522           |
| 35                 | 0,0000379           |
| 40                 | 0,0000095           |
| 45                 | 0,0000024           |
| 50                 | 0,0000006           |

De les taules anteriors pot extraure's que un atacant amb el control del 10 % de la capacitat de còmput de la xarxa tindria un 0,024 % de possibilitats de tindre èxit en reescriure sis blocs. Per eixa raó, i únicament per a transaccions de grans quantitats de diners, es recomana esperar al fet que la dita transacció haja aconseguit els sis blocs de profunditat per a ser presa com a definitiva. Açò es coneix com sis confirmacions en l'argot de Bitcoin.

## Conclusió

S'han exposat els aspectes criptogràfics darrere del protocol Bitcoin i s'ha analitzat el mateix protocol sense entrar en aspectes massa tècnics. No obstant açò, Bitcoin és susceptible a més tipus d'anàlisis: [legals](https://mixtifori.wordpress.com/2016/05/03/bitcoin-donde-estamos-y-hacia-donde-vamos/), econòmics, macroeconòmics, històrics, polítics, matemàtics i fins i tot més tècnics quant a especificació de protocol.

És curiós que mètodes i conceptes que inicialment estaven pensats per a ocultar informació a terceres persones i garantir comunicacions fidedignes hagen sigut utilitzats per a donar lloc a un sistema en el qual cap informació és privada.

A més, per primera vegada en la història s'ha plantejat un sistema monetari no fiduciari, és a dir, no basat en la fe o confiança. Bitcoin es basa exclusivament en plantejaments matemàtics i en les aplicacions de les matemàtiques a diferents àmbits, concretament l'aplicació de la criptografia a les tecnologies de la informació i comunicació. Fins i tot quan es confia en cert comportament per part dels usuaris, s'està fent sobre la base de plantejaments sociològics i probabilístics bastant sòlids.

Finalment, sembla ser fonamental aprofundir en el funcionament i plantejament de Bitcoin abans de considerar si utilitzar-la i com utilitzar-la. Pot no ser adequada per a totes les persones i àmbits d'ús, tractant-se d'una moneda diferent del concepte de diners que té la societat.

## Bibliografia

- **Badev, A. i Chen, M. (2014).** [Bitcoin: Technical Background and Data Analysis](https://www.federalreserve.gov/econresdata/feds/2014/files/2014104pap.pdf). Board of Governors of the Federal Reserve System. Consulta: 28 de març de 2016.
- **Fernández-Villaverde, J. (2015).** [Mis Aventuras con Bitcoin II: El Funcionamiento de Bitcoin](https://nadaesgratis.es/fernandez-villaverde/mis-aventuras-con-bitcoin-ii). Nada es gratis. Consulta: 28 de març de 2016.
- **Franco, P. (2014).** Understanding Bitcoin: Cryptography, Engineering and Economics. Chichester: John Wiley & Sons.
- **Nakamoto, S. (2008).** [Bitcoin: A Peer-to-Peer Electronic Cash System](https://bitcoin.org/bitcoin.pdf). Bitcoin. Consulta: 28 de març de 2016.
- **Nielsen, M. (2013).** [How the Bitcoin protocol actually works](https://www.michaelnielsen.org/ddi/how-the-bitcoin-protocol-actually-works). Data-driven intelligence. Consulta: 31 de març de 2016.
- **Pacia, C. (2013).** [Bitcoin Mining Explained Like You’re Five: Part 1 – Incentives](https://chrispacia.wordpress.com/2013/09/02/bitcoin-mining-explained-like-youre-five-part-1-incentives). Escape Velocity. Consulta: 4 d'abril de 2016.
- **Pacia, C. (2013).** [Bitcoin Mining Explained Like You’re Five: Part 2 – Mechanics](https://chrispacia.wordpress.com/2013/09/02/bitcoin-mining-explained-like-youre-five-part-2-mechanics). Escape Velocity. Consulta: 4 d'abril de 2016.
- **Pacia, C. (2013).** [Bitcoin Explained Like You’re Five: Part 3 – Cryptography](https://chrispacia.wordpress.com/2013/09/07/bitcoin-cryptography-digital-signatures-explained). Escape Velocity. Consulta: 4 d'abril de 2016.
