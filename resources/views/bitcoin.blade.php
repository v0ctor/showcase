@extends('layouts.publication')

@section('title', trans('bitcoin.title'))
@section('description', trans('bitcoin.description'))
@section('image', asset('images/publications/bitcoin/header/4k.jpg'))
@section('color', '#c07860')
@section('publication', 'bitcoin')
@section('date_iso', Carbon::createFromDate(2016, 4, 13)->toIso8601String())
@section('date_human', Formatter::date(2016, 4, 13))


@section('content')
    <section>
        <p>@lang('bitcoin.introduction.1')</p>
        <p>@lang('bitcoin.introduction.2')</p>
        <p>@lang('bitcoin.introduction.3')</p>
        <p>@lang('bitcoin.introduction.4')</p>
    </section>

    <section>
        <h1>@lang('bitcoin.cryptographic_basis.title')</h1>
        <p>@lang('bitcoin.cryptographic_basis.1')</p>

        <h2>@lang('bitcoin.cryptographic_basis.hash_functions.title')</h2>
        <p>@lang('bitcoin.cryptographic_basis.hash_functions.1')</p>
        <p>@lang('bitcoin.cryptographic_basis.hash_functions.2')</p>

        <div class="scroll">
            <table>
                <thead>
                    <tr>
                        <th>@lang('bitcoin.cryptographic_basis.hash_functions.table.0.a')</th>
                        <th>@lang('bitcoin.cryptographic_basis.hash_functions.table.0.b')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>@lang('bitcoin.cryptographic_basis.hash_functions.table.1.a')</th>
                        <td>@lang('bitcoin.cryptographic_basis.hash_functions.table.1.b')</td>
                    </tr>
                    <tr>
                        <th>@lang('bitcoin.cryptographic_basis.hash_functions.table.2.a')</th>
                        <td>@lang('bitcoin.cryptographic_basis.hash_functions.table.2.b')</td>
                    </tr>
                    <tr>
                        <th>@lang('bitcoin.cryptographic_basis.hash_functions.table.3.a')</th>
                        <td>@lang('bitcoin.cryptographic_basis.hash_functions.table.3.b')</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p>@lang('bitcoin.cryptographic_basis.hash_functions.3')</p>

        <ul>
            <li>@lang('bitcoin.cryptographic_basis.hash_functions.4.a')</li>
            <li>@lang('bitcoin.cryptographic_basis.hash_functions.4.b')</li>
            <li>@lang('bitcoin.cryptographic_basis.hash_functions.4.c')</li>
            <li>@lang('bitcoin.cryptographic_basis.hash_functions.4.d')</li>
        </ul>

        <p>@lang('bitcoin.cryptographic_basis.hash_functions.5')</p>

        <h2>@lang('bitcoin.cryptographic_basis.asymmetric_cryptography.title')</h2>
        <p>@lang('bitcoin.cryptographic_basis.asymmetric_cryptography.1')</p>
        <p>@lang('bitcoin.cryptographic_basis.asymmetric_cryptography.2')</p>
        <p>@lang('bitcoin.cryptographic_basis.asymmetric_cryptography.3')</p>

        <h2>@lang('bitcoin.cryptographic_basis.digital_signature.title')</h2>
        <p>@lang('bitcoin.cryptographic_basis.digital_signature.1')</p>

        <ul>
            <li>@lang('bitcoin.cryptographic_basis.digital_signature.2.a')</li>
            <li>@lang('bitcoin.cryptographic_basis.digital_signature.2.b')</li>
            <li>@lang('bitcoin.cryptographic_basis.digital_signature.2.c')</li>
        </ul>

        <p>@lang('bitcoin.cryptographic_basis.digital_signature.3')</p>

        <img style="width: 600px;"
             src="{{ asset('images/publications/bitcoin/digital-signature-' . App::getLocale() . '.png') }}">
        <div class="figure">@lang('bitcoin.figures.1')</div>
    </section>

    <section>
        <h1>@lang('bitcoin.protocol.title')</h1>
        <p>@lang('bitcoin.protocol.1')</p>

        <h2>@lang('bitcoin.protocol.addresses.title')</h2>
        <p>@lang('bitcoin.protocol.addresses.1')</p>
        <p>@lang('bitcoin.protocol.addresses.2')</p>

        <pre><code class="language-clike">i = base58(ripemd160(sha256(pk)))</code></pre>

        <p>@lang('bitcoin.protocol.addresses.3')</p>

        <pre><code class="language-none">1SdBftaLuBGECamx5Dob6js9PxQ2w1Rhe</code></pre>

        <p>@lang('bitcoin.protocol.addresses.4')</p>
        <p>@lang('bitcoin.protocol.addresses.5')</p>

        <h2>@lang('bitcoin.protocol.transactions.title')</h2>
        <p>@lang('bitcoin.protocol.transactions.1')</p>
        <p>@lang('bitcoin.protocol.transactions.2')</p>

        <img style="width: 600px;" src="{{ asset('images/publications/bitcoin/transaction.png') }}">
        <div class="figure">@lang('bitcoin.figures.2')</div>

        <h2>@lang('bitcoin.protocol.blocks.title')</h2>
        <p>@lang('bitcoin.protocol.blocks.1')</p>
        <p>@lang('bitcoin.protocol.blocks.2')</p>
        <p>@lang('bitcoin.protocol.blocks.3')</p>
        <p>@lang('bitcoin.protocol.blocks.4')</p>

        <img style="width: 300px;" src="{{ asset('images/publications/bitcoin/block-' . App::getLocale() . '.png') }}">
        <div class="figure">@lang('bitcoin.figures.3')</div>

        <h2>@lang('bitcoin.protocol.proof_of_work_test.title')</h2>
        <p>@lang('bitcoin.protocol.proof_of_work_test.1')</p>

        <div class="scroll">
            <table>
                <thead>
                    <tr>
                        <th colspan="4">
                            <a href="https://blockexplorer.com/block/000000000000000004dc4a5c870352f14a67c4bd54fcee28240775d3bc4f431c">
                                @lang('bitcoin.protocol.proof_of_work_test.table.block', ['number' => $formatter->decimal(405506, 0)])
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>@lang('bitcoin.protocol.proof_of_work_test.table.block_hash')</th>
                        <td colspan="3"><span style="color:#6fc138;">00000000000000000</span>4dc4a5c870352f14a67c4bd54fcee28240775d3bc4f431c
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('bitcoin.protocol.proof_of_work_test.table.merkle_root')</th>
                        <td colspan="3">11171e15a04559474885b540acc9ece5f649c519618745c7ca1cd31d62c5a7a9</td>
                    </tr>
                    <tr>
                        <th>@lang('bitcoin.protocol.proof_of_work_test.table.number_of_transactions')</th>
                        <td>{{ $formatter->decimal(1653, 0) }}</td>
                        <th>@lang('bitcoin.protocol.proof_of_work_test.table.difficulty')</th>
                        <td>{{ $formatter->decimal(166851513282.7772, 4) }}</td>
                    </tr>
                    <tr>
                        <th>@lang('bitcoin.protocol.proof_of_work_test.table.height')</th>
                        <td>{{ $formatter->decimal(405506, 0) }}</td>
                        <th>@lang('bitcoin.protocol.proof_of_work_test.table.size')</th>
                        <td>{{ $formatter->decimal(994707, 0) }} bytes</td>
                    </tr>
                    <tr>
                        <th>@lang('bitcoin.protocol.proof_of_work_test.table.reward')</th>
                        <td>25 bitcoins</td>
                        <th>@lang('bitcoin.protocol.proof_of_work_test.table.version')</th>
                        <td>4</td>
                    </tr>
                    <tr>
                        <th>@lang('bitcoin.protocol.proof_of_work_test.table.date')</th>
                        <td>{{ Formatter::datetime(2016, 4, 3, 9, 37, 33) }}</td>
                        <th>@lang('bitcoin.protocol.proof_of_work_test.table.nonce')</th>
                        <td>{{ $formatter->decimal(1405982784, 0) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p>@lang('bitcoin.protocol.proof_of_work_test.2')</p>
        <p>@lang('bitcoin.protocol.proof_of_work_test.3')</p>
        <p>@lang('bitcoin.protocol.proof_of_work_test.4')</p>
        <p>@lang('bitcoin.protocol.proof_of_work_test.5')</p>
        <p>@lang('bitcoin.protocol.proof_of_work_test.6')</p>

        <h2>@lang('bitcoin.protocol.block_chain.title')</h2>
        <p>@lang('bitcoin.protocol.block_chain.1')</p>
        <p>@lang('bitcoin.protocol.block_chain.2')</p>
        <p>@lang('bitcoin.protocol.block_chain.3')</p>
        <p>@lang('bitcoin.protocol.block_chain.4')</p>

        <img class="full" src="{{ asset('images/publications/bitcoin/chain-' . App::getLocale() . '.png') }}">
        <div class="figure">@lang('bitcoin.figures.4')</div>

        <h2>@lang('bitcoin.protocol.six_confirmations.title')</h2>
        <p>@lang('bitcoin.protocol.six_confirmations.1')</p>
        <p>@lang('bitcoin.protocol.six_confirmations.2')</p>

        <div class="scroll">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">@lang('bitcoin.protocol.six_confirmations.table.control_of_network_capacity', ['percent' => 10])</th>
                        <th colspan="2">@lang('bitcoin.protocol.six_confirmations.table.control_of_network_capacity', ['percent' => 30])</th>
                    </tr>
                    <tr>
                        <th>@lang('bitcoin.protocol.six_confirmations.table.blocks_to_rewrite')</th>
                        <th>@lang('bitcoin.protocol.six_confirmations.table.probability_of_success')</th>
                        <th>@lang('bitcoin.protocol.six_confirmations.table.blocks_to_rewrite')</th>
                        <th>@lang('bitcoin.protocol.six_confirmations.table.probability_of_success')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>0</td>
                        <td>1</td>
                        <td>0</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>{{ $formatter->decimal(0.2045873, 7) }}</td>
                        <td>5</td>
                        <td>{{ $formatter->decimal(0.1773523, 7) }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>{{ $formatter->decimal(0.0509779, 7) }}</td>
                        <td>10</td>
                        <td>{{ $formatter->decimal(0.0416605, 7) }}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>{{ $formatter->decimal(0.0131722, 7) }}</td>
                        <td>15</td>
                        <td>{{ $formatter->decimal(0.0101008, 7) }}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>{{ $formatter->decimal(0.0034552, 7) }}</td>
                        <td>20</td>
                        <td>{{ $formatter->decimal(0.0024804, 7) }}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>{{ $formatter->decimal(0.0009137, 7) }}</td>
                        <td>25</td>
                        <td>{{ $formatter->decimal(0.0006132, 7) }}</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>{{ $formatter->decimal(0.0002428, 7) }}</td>
                        <td>30</td>
                        <td>{{ $formatter->decimal(0.0001522, 7) }}</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>{{ $formatter->decimal(0.0000647, 7) }}</td>
                        <td>35</td>
                        <td>{{ $formatter->decimal(0.0000379, 7) }}</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>{{ $formatter->decimal(0.0000173, 7) }}</td>
                        <td>40</td>
                        <td>{{ $formatter->decimal(0.0000095, 7) }}</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>{{ $formatter->decimal(0.0000046, 7) }}</td>
                        <td>45</td>
                        <td>{{ $formatter->decimal(0.0000024, 7) }}</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>{{ $formatter->decimal(0.0000012, 7) }}</td>
                        <td>50</td>
                        <td>{{ $formatter->decimal(0.0000006, 7) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p>@lang('bitcoin.protocol.six_confirmations.3')</p>
    </section>

    <section>
        <h1>@lang('bitcoin.conclusion.title')</h1>
        <p>@lang('bitcoin.conclusion.1')</p>
        <p>@lang('bitcoin.conclusion.2')</p>
        <p>@lang('bitcoin.conclusion.3')</p>
        <p>@lang('bitcoin.conclusion.4')</p>
    </section>

    <section class="bibliography">
        <h1>@lang('publications.bibliography')</h1>

        <ul>
            <li>
                @lang('publications.enumeration', ['elements' => '<span class="name">Badev, A.</span>', 'last' => '<span class="name">Chen, M.</span>'])
                (2014).
                <a href="https://www.federalreserve.gov/econresdata/feds/2014/files/2014104pap.pdf">Bitcoin: Technical
                    Background and Data Analysis</a>. Board of Governors of the Federal Reserve System.
                @lang('publications.consulted_on', ['date' => Formatter::date(2016, 3, 28)])
            </li>
            <li>
                <span class="name">Fernández-Villaverde, J.</span> (2015).
                <a href="http://nadaesgratis.es/fernandez-villaverde/mis-aventuras-con-bitcoin-ii">Mis Aventuras con
                    Bitcoin II: El Funcionamiento de Bitcoin</a>. Nada es gratis.
                @lang('publications.consulted_on', ['date' => Formatter::date(2016, 3, 28)])
            </li>
            <li>
                <span class="name">Franco, P.</span> (2014).
                <em>Understanding Bitcoin: Cryptography, Engineering and Economics</em>. Chichester: John Wiley & Sons.
            </li>
            <li>
                <span class="name">Nakamoto, S.</span> (2008).
                <a href="https://bitcoin.org/bitcoin.pdf">Bitcoin: A Peer-to-Peer Electronic Cash System</a>. Bitcoin.
                @lang('publications.consulted_on', ['date' => Formatter::date(2016, 3, 28)])
            </li>
            <li>
                <span class="name">Nielsen, M.</span> (2013).
                <a href="http://www.michaelnielsen.org/ddi/how-the-bitcoin-protocol-actually-works">How the Bitcoin
                    protocol actually works</a>. Data-driven intelligence.
                @lang('publications.consulted_on', ['date' => Formatter::date(2016, 3, 31)])
            </li>
            <li>
                <span class="name">Pacia, C.</span> (2013).
                <a href="https://chrispacia.wordpress.com/2013/09/02/bitcoin-mining-explained-like-youre-five-part-1-incentives">Bitcoin
                    Mining Explained Like You’re Five: Part 1 – Incentives</a>. Escape Velocity.
                @lang('publications.consulted_on', ['date' => Formatter::date(2016, 4, 4)])
            </li>
            <li>
                <span class="name">Pacia, C.</span> (2013).
                <a href="https://chrispacia.wordpress.com/2013/09/02/bitcoin-mining-explained-like-youre-five-part-2-mechanics">Bitcoin
                    Mining Explained Like You’re Five: Part 2 – Mechanics</a>. Escape Velocity.
                @lang('publications.consulted_on', ['date' => Formatter::date(2016, 4, 4)])
            </li>
            <li>
                <span class="name">Pacia, C.</span> (2013).
                <a href="https://chrispacia.wordpress.com/2013/09/07/bitcoin-cryptography-digital-signatures-explained">Bitcoin
                    Explained Like You’re Five: Part 3 – Cryptography</a>. Escape Velocity.
                @lang('publications.consulted_on', ['date' => Formatter::date(2016, 4, 4)])
            </li>
        </ul>
    </section>
@endsection
