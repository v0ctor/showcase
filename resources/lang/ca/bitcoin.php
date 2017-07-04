<?php
/**
 * Bitcoin language strings.
 */

return [
	
	'title'       => 'Bitcoin: plantejament i protocol',
	'description' => 'Anàlisi detallada del plantejament de la criptodivisa Bitcoin i descripció del protocol que la fa funcionar, relacionant-ho amb els conceptes més destacats de la criptografia moderna.',
	
	'introduction' => [
		'1' => 'Bitcoin és una moneda digital descentralitzada, també denominada criptodivisa, concebuda per una persona (o grup de persones) sota el pseudònim de Satoshi Nakamoto. La <a href="https://bitcoin.org/bitcoin.pdf">primera publicació</a> amb referència a la moneda i al seu protocol data de 2008, mentre que la seua primera implementació com a programari de codi obert fou llançada en 2009. En l\'actualitat és la moneda alternativa més utilitzada, amb un mercat total de cent milions de dòlars estatunidencs.',
		
		'2' => 'El protocol està pensat per a no permetre l\'existència de més de vint-i-un milions de bitcoins —note\'s que Bitcoin fa referència a la moneda i bitcoin a la unitat—, establint que esta es reduïsca a la meitat cada aproximadament quatre anys.',
		
		'3' => 'La divisa consta de tres elements fonamentals: les adreces, el llibre major de transaccions (o cadena de blocs) i la xarxa. El balanç d\'un compte, representat per una adreça, no és més que el sumatori de les seues transaccions entrants (valor positiu) i ixents (valor negatiu). La xarxa és l\'encarregada de verificar la legitimitat i viabilitat de les transaccions, és a dir, que estes han sigut emeses pels legítims propietaris dels comptes i que cap compte envie diners dels quals no disposa. Perquè tot açò funcione en consonància existix tot un protocol basat en diverses tècniques criptogràfiques.',
		
		'4' => 'L\'objectiu d\'esta publicació és analitzar els detalls del seu plantejament i descriure el protocol que la fa funcionar, relacionant-ho amb els conceptes més destacats de la criptografia moderna.',
	],
	
	'cryptographic_basis' => [
		'title' => 'Fonament criptogràfic',
		
		'1' => 'Bitcoin es recolza sobre dos elements criptogràfics sense els quals la seua arquitectura seria impossible: les funcions <em>hash</em> i la signatura digital basada en la criptografia de clau asimètrica.',
		
		'hash_functions' => [
			'title' => 'Funcions <em>hash</em> o resum',
			
			'1' => 'Una <a href="https://ca.wikipedia.org/wiki/Funci%C3%B3_hash">funció <em>hash</em></a> és un algorisme matemàtic que donada una entrada de qualsevol longitud proporciona una eixida de longitud fixa, servint així com a resum d\'esta informació. Note\'s que no es tracta d\'una funció de compressió, ja que no és <a href="https://ca.wikipedia.org/wiki/Funci%C3%B3_injectiva">injectiva</a> i, per tant, tampoc invertible. Del fet anterior es deduïx que podrà haver-hi col·lisions si el nombre d\'elements del conjunt d\'entrada és superior al d\'eixida, és a dir, la funció tornarà la mateixa eixida per a dues entrades diferents.',
			
			'2' => 'Per exemple, la funció <a href="https://ca.wikipedia.org/wiki/MD5">MD5</a> produïx les següents eixides, amb una longitud fixa de 128 bits:',
			
			'table' => [
				'0' => [
					'a' => 'Entrada',
					'b' => 'Eixida',
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
					'a' => 'adéu',
					'b' => '00e18965352790f2264ca0ebd07ee014',
				],
			],
			
			'3' => 'Perquè les funcions resum tinguen una aplicació pràctica en criptografia és necessari que complisquen una sèrie de característiques addicionals a la definició bàsica:',
			
			'4' => [
				'a' => 'Donada una entrada ha de ser molt fàcil calcular la seua eixida. No obstant açò, ha de ser computacionalment impracticable la funció inversa, tot coneixent l\'algorisme.',
				
				'b' => 'Han de tindre un alt nivell de tolerància a col·lisions. Açò és, les col·lisions han de ser molt improbables i, en cas d\'ocórrer, han de fer-ho per a valors d\'entrada radicalment diferents.',
				
				'c' => 'Han de ser capaços de proporcionar una eixida de longitud fixa independentment de la longitud de l\'entrada.',
				
				'd' => 'El més mínim canvi entre dues entrades ha de produir eixides totalment diferents. En l\'exemple anterior pot apreciar-se que les eixides d\'<code>hola</code> i <code>Hola</code> són essencialment diferents malgrat la similitud de les entrades.',
			],
			
			'5' => 'El protocol Bitcoin fa un ús important de la funció de resum SHA-256, la variant del conjunt de funcions <a href="https://ca.wikipedia.org/wiki/Secure_Hash_Algorithm">Secure Hash Algorithm 2</a> amb eixida de 256 bits. Esta funció, al contrari que MD5, és considerada criptogràficament segura en l\'actualitat.',
		],
		
		'asymmetric_cryptography' => [
			'title' => 'Criptografia asimètrica',
			
			'1' => 'La <a href="https://ca.wikipedia.org/wiki/Criptografia_de_clau_p%C3%BAblica">criptografia asimètrica</a> o de clau pública, en contraposició a la <a href="https://ca.wikipedia.org/wiki/Criptografia_sim%C3%A8trica">criptografia simètrica</a> o de clau secreta, es basa en l\'ús de dues claus per a l\'intercanvi d\'informació. Estes claus estan matemàticament relacionades de tal forma que és possible xifrar amb la clau pública i solament és computacionalment practicable desxifrar amb la clau privada.',
			
			'2' => 'Per tant, una persona pot compartir la seua clau pública a través d\'un canal insegur, podent qualsevol persona xifrar amb ella un missatge amb la garantia que solament el posseïdor de la clau privada podrà desxifrar-ho.',
			
			'3' => 'No obstant açò, l\'aplicació de la criptografia asimètrica en Bitcoin no és l\'intercanvi d\'informació, sinó la signatura digital.',
		],
		
		'digital_signature' => [
			'title' => 'Signatura digital',
			
			'1' => 'La criptografia de clau pública pot ser utilitzada per a donar suport a un sistema anomenat <a href="https://ca.wikipedia.org/wiki/Signatura_digital">signatura digital</a>, que permet dotar a un missatge de:',
			
			'2' => [
				'a' => '<strong>Autenticitat</strong>: garantia de la certesa de l\'origen del missatge.',
				
				'b' => '<strong>Integritat</strong>: possibilitat de detectar si el missatge ha sigut modificat o roman íntegre.',
				
				'c' => '<strong>No repudi</strong>: impossibilitat de negar l\'autoria del missatge.',
			],
			
			'3' => 'El primer pas a l\'hora de signar un missatge consistix a obtenir un <em>hash</em> o resum del mateix. Açò es fa per a evitar atacs de falsificació que podrien dur-se a terme en cas d\'aplicar la signatura directament al missatge en lloc de fer-ho al <em>hash</em>, a més de per raons d\'eficiència, compatibilitat i integritat que no calen detallar en l\'àmbit d\'esta publicació. A continuació se signa el resum amb la clau privada de l\'emissor, normalment utilitzant RSA. Finalment ha d\'adjuntar-se el missatge juntament amb la signatura, podent a partir d\'eixe moment ser comprovada la seua validesa per qualsevol persona mitjançant la clau pública de l\'emissor.',
		],
	],
	
	'protocol' => [
		'title' => 'Protocol',
		
		'1' => 'Bitcoin es definix com una successió de transaccions entre adreces. A més, tots els processos són públics, per la qual cosa qualsevol persona pot conéixer les transaccions que desitge i, en conseqüència, el balanç de qualsevol compte. La privadesa del sistema radica en les mesures que prenga cada persona per a dificultar la seua vinculació amb una determinada adreça.',
		
		'addresses' => [
			'title' => 'Adreces',
			
			'1' => 'Una adreça està formada per un parell de claus (pública i privada) de corba el·líptica (ECDSA). Este tipus de criptografia asimètrica permet operacions més ràpides i claus més xicotetes per al mateix nivell de seguretat en comparació d\'altres algorismes de signatura digital com <a href="https://ca.wikipedia.org/wiki/DSA">DSA</a>.',
			
			'2' => 'Un identificador és una cadena única d\'entre 26 i 35 caràcters que es calcula a partir de la clau pública aplicant-li les funcions <em>hash</em> SHA-256 i RIPEMD-160. A continuació es codifica en base 58, que no és més que una codificació en <a href="https://ca.wikipedia.org/wiki/Base64">base 64</a> havent-li eliminat els caràcters no alfanumèrics o que puguen donar lloc a ambigüitats.',
			
			'3' => 'Este és l\'aspecte que té una adreça Bitcoin una vegada generada i transformada la clau pública:',
			
			'4' => 'Un usuari no necessita estar connectat a la xarxa per a generar adreces i pot tindre tantes com desitge, ja que per a això únicament ha de generar parells de claus asimètriques. És més, el protocol recomana la generació d\'una adreça diferent per a cada operació, considerant-les d\'un sol ús.',
			
			'5' => 'La mateixa adreça inclou 32 bits de verificació per a evitar errors a l\'hora de copiar a mà els identificadors. D\'esta forma, el programari pot contemplar el rebuig d\'una transacció amb adreces invàlides abans de propagar-la per la xarxa.',
		],
		
		'transactions' => [
			'title' => 'Transaccions',
			
			'1' => 'Una transacció, que és la unitat atòmica de la cadena de blocs (vegeu més endavant), consistix en un enviament de certa quantitat de moneda d\'una o més adreces a sengles adreces, admetent fraccions de fins a 10<sup>-8</sup> bitcoins (denominades <em>satoshis</em>). Tota transacció se signa digitalment mitjançant el procés explicat anteriorment amb la clau privada associada a l\'adreça que envia els diners, per la qual cosa es garantix que únicament el legítim propietari pot emetre transaccions des d\'un compte. A més, s\'afig una marca temporal única per a evitar atacs de repetició.',
			
			'2' => 'Com cada transacció pot incloure diverses adreces (tant d\'enviament com de recepció) i no hi ha cap forma de conéixer si eixes adreces pertanyen a una mateixa persona o entitat, pot afirmar-se que el protocol no permet dur a terme la traçabilitat dels diners.',
		],
		
		'blocks' => [
			'title' => 'Blocs',
			
			'1' => 'Les transaccions s\'agrupen en blocs, els quals estan compostos per una capçalera i un arbre Merkle o arbre de <em>hash</em>.',
			
			'2' => 'En les fulles de l\'arbre se situen totes les transaccions que formen part del bloc. Les fulles no tenen germans i el seu pare és el seu <em>hash</em>. El rang entre el penúltim nivell de l\'arbre i l\'arrel és un subarbre binari on cada pare és el resultat d\'aplicar una funció <em>hash</em> (SHA-256) als seus dos fills.',
			
			'3' => 'La capçalera d\'un bloc està formada per l\'arrel de l\'arbre Merkle, el <em>hash</em> de la capçalera del bloc anterior (més endavant es veurà que els blocs s\'encadenen) i un nombre aleatori anomenat <em>nonce</em>.',
			
			'4' => 'El camp <em>nonce</em> és una de les parts més importants del protocol, ja que és la seua existència la que fa possible incentivar la verificació de transaccions, també coneguda com minat.',
		],
		
		'proof_of_work_test' => [
			'title' => 'Prova de treball',
			
			'1' => 'El protocol establix un valor màxim per al <em>hash</em> de la capçalera dels blocs. Tinga\'s en compte que qualsevol cadena de caràcters pot ser interpretada com un número, per la qual cosa en este cas el requisit és equivalent al fet que el <em>hash</em> de la capçalera comence com a mínim per un nombre donat de zeros.',
			
			'table' => [
				'block'                  => 'Bloc :number',
				'block_hash'             => '<em>Hash</em> de la capçalera',
				'merkle_root'            => '<em>Hash</em> arrel',
				'number_of_transactions' => 'Transaccions',
				'difficulty'             => 'Dificultat',
				'height'                 => 'Posició en la cadena',
				'size'                   => 'Mida',
				'reward'                 => 'Recompensa',
				'version'                => 'Versió',
				'date'                   => 'Data',
				'nonce'                  => '<em>Nonce</em>',
			],
			
			'2' => 'Qualsevol bloc el <em>hash</em> de la capçalera del qual no complisca amb el valor objectiu serà rebutjat per la xarxa. El valor objectiu s\'ajusta per la mateixa xarxa automàticament cada dues setmanes perquè de mitjana es produïsca un bloc cada deu minuts.',
			
			'3' => 'Per a fer que un bloc complisca els requisits que establix el protocol és fonamental el paper del camp <em>nonce</em>. Es tracta d\'un número enter que es va incrementant a mesura que es va tornant a calcular el <em>hash</em> fins que s\'obté un valor vàlid. El minat de bitcoins és senzillament açò: iterar el càlcul del <em>hash</em> incrementant en cada iteració el <em>nonce</em>.',
			
			'4' => 'Una vegada obtingut un bloc vàlid s\'envia a la resta de la xarxa. Com la comprovació és trivial, la resta de miners verifiquen que siga correcta i, en cas de ser-ho, l\'afigen a la seua còpia local de la cadena de blocs per a seguir amb el següent bloc.',
			
			'5' => 'Cal destacar que la primera transacció de cada bloc diferix necessàriament entre miners, ja que sempre és una emissió de moneda de 25 bitcoins (que es reduïx a la meitat per cada 210.000 blocs verificats) destinada a una adreça del mateix miner. D\'eixa forma es regula el creixement de la moneda i es recompensa als qui participen en la seua verificació. Per eixa raó el camp <em>nonce</em> per a un mateix bloc també serà diferent entre miners. A més, cada miner afig a un bloc les transaccions que li van arribant, per la qual cosa pot haver-hi diversos miners intentant minar alhora un mateix bloc que, no obstant això, pot contenir diferents transaccions.',
			
			'6' => 'La combinació de la prova de treball i el consens que existix entre els participants per a respectar el protocol són la solució que Bitcoin oferix al conegut problema en criptografia dels generals bizantins. El protocol confia en què la generació de blocs falsos està desincentivada, ja que seran rebutjats per la xarxa i solament hauran servit per a malgastar recursos (maquinari i energia, que al cap i a la fi es paguen amb diners reals) de l\'atacant. Per tant, el sistema únicament queda obert al fet que un atacant amb suficients nodes i capacitat de còmput siga capaç de generar un fals consens, és a dir, un consens trencant el protocol.',
		],
		
		'block_chain' => [
			'title' => 'Cadena de blocs',
			
			'1' => 'Com s\'ha indicat anteriorment, tots els blocs vàlids van encadenant-se en una cadena de blocs pública, també anomenada llibre major de transaccions. Per a calcular el balanç d\'una adreça únicament cal recórrer tot el llibre sumant i restant els valors entrants i ixents per a eixa adreça. En conseqüència, la quantitat de moneda d\'una adreça no s\'anota com a tal en cap lloc. Per eixa raó es diu que la unitat fonamental en Bitcoin són les transaccions.',
			
			'2' => 'D\'acord amb l\'anàlisi realitzada de la prova de treball, podria donar-se una situació en la qual dos miners diferents trobaren alhora un bloc vàlid i el propagaren per la xarxa, donant lloc a una bifurcació en la cadena de blocs. En eixe cas la prova de treball oferix una solució implícita: el següent bloc vàlid hauria de produir-se necessàriament en primer lloc en una de les dues bifurcacions, per la qual cosa els miners (inclosos els causants de la bifurcació) passarien a centrar-se en la branca amb més consens, ja que seria l\'única amb recompenses de minat efectives.',
			
			'3' => 'Quant a la integritat de la cadena, un bloc és més fiable com més antic és. Qualsevol modificació en una transacció desencadenaria uns canvis en cascada a través de l\'arbre Merkle del bloc que arribarien fins a la mateixa capçalera. Per tant, també modificarien el <em>hash</em> de la capçalera del bloc, que s\'inclou en la capçalera del següent, modificant-la també. D\'eixa forma, un canvi en qualsevol bloc invalidaria tots els següents.',
			
			'4' => 'Depenent de la profunditat d\'un bloc, podria portar anys a un atacant realitzar una modificació fraudulenta i tornar a calcular tota la cadena. Mentrestant, la resta de la xarxa seguiria minant bitcoins i incrementant la longitud de la cadena. A més, encara que l\'atacant tinguera capacitat de còmput il·limitada no seria capaç de convéncer a un nombre suficient de nodes per a reemplaçar blocs antics donant-los per vàlids, per la qual cosa l\'atac seria inviable. En este sentit la prova de treball entra en joc de nou: el més probable és que l\'atacant preferisca invertir els recursos de l\'atac en minar bitcoins en lloc de realitzar un atac computacionalment impracticable.',
		],
		
		'six_confirmations' => [
			'title' => 'Sis confirmacions',
			
			'1' => 'Quan un bloc s\'afig a la cadena es considera que totes les seues transaccions han sigut confirmades i són irreversibles. No obstant això, eixe bloc pot formar part d\'una bifurcació i ser rebutjat per la majoria de nodes posteriorment. Considere\'s un atacant amb el 10 % de capacitat de còmput de la xarxa i amb tanta sort que aconseguix calcular en un minut un bloc fraudulent a priori vàlid, cosa que hauria de costar-li una mitjana de cent minuts en condicions normals ―en eixe temps s\'haurien afegit de mitjana deu blocs més a la cadena―. Este tipus de situacions són altament improbables, però no impossibles.',
			
			'2' => 'En la <a href="https://bitcoin.org/bitcoin.pdf">publicació original</a> de Nakamoto es contempla esta situació i s\'oferixen càlculs que demostren que la probabilitat d\'èxit d\'un atacant decreix exponencialment amb la profunditat del bloc a modificar.',
			
			'table' => [
				'control_of_network_capacity' => 'Control del :percent % de capacitat de la xarxa',
				'blocks_to_rewrite'           => 'Blocs a reescriure',
				'probability_of_success'      => 'Probabilitat d\'èxit',
			],
			
			'3' => 'De la taula anterior pot extraure\'s que un atacant amb el control del 10 % de la capacitat de còmput de la xarxa tindria un 0,024 % de possibilitats de tindre èxit en reescriure sis blocs. Per eixa raó, i únicament per a transaccions de grans quantitats de diners, es recomana esperar al fet que la dita transacció haja aconseguit els sis blocs de profunditat per a ser presa com a definitiva. Açò es coneix com sis confirmacions en l\'argot de Bitcoin.',
		],
	],
	
	'conclusion' => [
		'title' => 'Conclusió',
		
		'1' => 'S\'han exposat els aspectes criptogràfics darrere del protocol Bitcoin i s\'ha analitzat el mateix protocol sense entrar en aspectes massa tècnics. No obstant açò, Bitcoin és susceptible a més tipus d\'anàlisis: <a href="https://mixtifori.wordpress.com/2016/05/03/bitcoin-donde-estamos-y-hacia-donde-vamos/">legals</a>, econòmics, macroeconòmics, històrics, polítics, matemàtics i fins i tot més tècnics quant a especificació de protocol.',
		
		'2' => 'És curiós que mètodes i conceptes que inicialment estaven pensats per a ocultar informació a terceres persones i garantir comunicacions fidedignes hagen sigut utilitzats per a donar lloc a un sistema en el qual cap informació és privada.',
		
		'3' => 'A més, per primera vegada en la història s\'ha plantejat un sistema monetari no fiduciari, és a dir, no basat en la fe o confiança. Bitcoin es basa exclusivament en plantejaments matemàtics i en les aplicacions de les matemàtiques a diferents àmbits, concretament l\'aplicació de la criptografia a les tecnologies de la informació i comunicació. Fins i tot quan es confia en cert comportament per part dels usuaris, s\'està fent sobre la base de plantejaments sociològics i probabilístics bastant sòlids.',
		
		'4' => 'Finalment, sembla ser fonamental aprofundir en el funcionament i plantejament de Bitcoin abans de considerar si utilitzar-la i com utilitzar-la. Pot no ser adequada per a totes les persones i àmbits d\'ús, tractant-se d\'una moneda diferent del concepte de diners que té la societat.',
	],
	
	'figures' => [
		'1' => '<strong>Figura 1</strong>: algorisme de signatura digital.',
		'2' => '<strong>Figura 2</strong>: representació d\'una possible transacció.',
		'3' => '<strong>Figura 3</strong>: bloc de transaccions.',
		'4' => '<strong>Figura 4</strong>: representació de la cadena de blocs considerant únicament les capçaleres.',
	],

];