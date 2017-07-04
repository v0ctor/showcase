@extends('layouts.publication')

@section('title', trans('websocket.title'))
@section('description', trans('websocket.description'))
@section('image', asset('images/publications/websocket/header/2k.jpg'))
@section('color', '#6090c0')
@section('publication', 'websocket')
@section('date_iso', Carbon::createFromDate(2015, 11, 15)->toIso8601String())
@section('date_human', Formatter::date(2015, 11, 15))

@section('content')
	<section>
		<p>@lang('websocket.introduction.1')</p>
		<p>@lang('websocket.introduction.2')</p>
		<p>@lang('websocket.introduction.3')</p>
		<p>@lang('websocket.introduction.4')</p>
	</section>
	
	<section>
		<h1>@lang('websocket.protocol.title')</h1>
		
		<p>@lang('websocket.protocol.1')</p>
		<p>@lang('websocket.protocol.2')</p>
		<p>@lang('websocket.protocol.3')</p>
		
		<pre><code class="language-http">GET /chat HTTP/1.1
Host: server.example.com
Upgrade: websocket
Connection: Upgrade
Sec-WebSocket-Key: dGhlIHNhbXBsZSBub25jZQ==
Origin: http://example.com
Sec-WebSocket-Protocol: chat, superchat
Sec-WebSocket-Version: 13</code></pre>
		
		<p>@lang('websocket.protocol.4')</p>
		<p>@lang('websocket.protocol.5')</p>
		
		<pre><code class="language-http">HTTP/1.1 101 Switching Protocols
Upgrade: websocket
Connection: Upgrade
Sec-WebSocket-Accept: s3pPLMBiTxaQ9kYGzzhZRbK+xOo=
Sec-WebSocket-Protocol: chat</code></pre>
		
		<p>@lang('websocket.protocol.6')</p>
		<p>@lang('websocket.protocol.7')</p>
		<p>@lang('websocket.protocol.8')</p>
		<p>@lang('websocket.protocol.9')</p>
		
		<img style="width: 700px;" src="{{ asset('images/publications/websocket/frame-format.png') }}">
		<div class="figure">@lang('websocket.figures.1')</div>
		
		<p>@lang('websocket.protocol.10')</p>
		
		<ul>
			<li>@lang('websocket.protocol.11.a')</li>
			<li>@lang('websocket.protocol.11.b')</li>
			<li>@lang('websocket.protocol.11.c')</li>
			<li>@lang('websocket.protocol.11.d')</li>
			<li>@lang('websocket.protocol.11.e')</li>
			<li>@lang('websocket.protocol.11.f')</li>
			<li>@lang('websocket.protocol.11.g')</li>
		</ul>
		
		<p>@lang('websocket.protocol.12')</p>
		<p>@lang('websocket.protocol.13')</p>
	</section>
	
	<section>
		<h1>@lang('websocket.security.title')</h1>
		
		<p>@lang('websocket.security.1')</p>
		<p>@lang('websocket.security.2')</p>
	</section>
	
	<section>
		<h1>@lang('websocket.api.title')</h1>
		<p>@lang('websocket.api.1')</p>
		
		<h2>@lang('websocket.api.establishing_the_connection.title')</h2>
		<p>@lang('websocket.api.establishing_the_connection.1')</p>
		
		<pre><code class="language-js">WebSocket WebSocket(
	in DOMString url,
	in optional DOMString protocols
);</code></pre>
		
		<p>@lang('websocket.api.establishing_the_connection.2')</p>
		<p>@lang('websocket.api.establishing_the_connection.3')</p>
		
		<pre><code class="language-js">var socket = new WebSocket("wss://w7.web.whatsapp.com/ws");</code></pre>
		
		<h2>@lang('websocket.api.sending_information.title')</h2>
		<p>@lang('websocket.api.sending_information.1')</p>
		
		<pre><code class="language-js">socket.send("Hi! 👋");</code></pre>
		
		<p>@lang('websocket.api.sending_information.2')</p>
		
		<pre><code class="language-js">socket.onopen = function (event) {
	socket.send("Hi! 👋");
};</code></pre>
		
		<h2>@lang('websocket.api.receiving_information.title')</h2>
		<p>@lang('websocket.api.receiving_information.1')</p>
		
		<pre><code class="language-js">socket.onmessage = function (event) {
	console.log(event.data);
};</code></pre>
		
		<h2>@lang('websocket.api.closing_the_connection.title')</h2>
		<p>@lang('websocket.api.closing_the_connection.1')</p>
		
		<pre><code class="language-js">socket.close();</code></pre>
		
		<h2>@lang('websocket.api.documentation.title')</h2>
		<p>@lang('websocket.api.documentation.1')</p>
	</section>
	
	<section>
		<h1>@lang('websocket.scope_of_application.title')</h1>
		<p>@lang('websocket.scope_of_application.1')</p>
		<p>@lang('websocket.scope_of_application.2')</p>
		
		<h2>@lang('websocket.scope_of_application.web_browser_support.title')</h2>
		<p>@lang('websocket.scope_of_application.web_browser_support.1')</p>
		
		<div class="scroll">
			<table>
				<thead>
					<tr>
						<th></th>
						<th>Chrome</th>
						<th>Firefox</th>
						<th>Opera</th>
						<th>Safari</th>
						<th>Internet Explorer</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>@lang('websocket.scope_of_application.web_browser_support.table.version', ['number' => 0])</th>
						<td>6</td>
						<td>4</td>
						<td>@lang('websocket.scope_of_application.web_browser_support.table.disabled', ['version' => 11])</td>
						<td>5.0.1</td>
						<td>@lang('websocket.scope_of_application.web_browser_support.table.no')</td>
					</tr>
					<tr>
						<th>@lang('websocket.scope_of_application.web_browser_support.table.version', ['number' => 7])</th>
						<td>@lang('websocket.scope_of_application.web_browser_support.table.no')</td>
						<td>6</td>
						<td>@lang('websocket.scope_of_application.web_browser_support.table.no')</td>
						<td>@lang('websocket.scope_of_application.web_browser_support.table.no')</td>
						<td>@lang('websocket.scope_of_application.web_browser_support.table.no')</td>
					</tr>
					<tr>
						<th>@lang('websocket.scope_of_application.web_browser_support.table.version', ['number' => 10])</th>
						<td>14</td>
						<td>7</td>
						<td>@lang('websocket.scope_of_application.web_browser_support.table.unknown')</td>
						<td>@lang('websocket.scope_of_application.web_browser_support.table.unknown')</td>
						<td>@lang('websocket.scope_of_application.web_browser_support.table.no')</td>
					</tr>
					<tr>
						<th>@lang('websocket.scope_of_application.web_browser_support.table.version', ['number' => 17])</th>
						<td>16</td>
						<td>37</td>
						<td>12.10</td>
						<td>6</td>
						<td>10</td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>
	
	<section>
		<h1>@lang('websocket.advantages_and_disadvantages.title')</h1>
		
		<p>@lang('websocket.advantages_and_disadvantages.1')</p>
		<p>@lang('websocket.advantages_and_disadvantages.2')</p>
		<p>@lang('websocket.advantages_and_disadvantages.3')</p>
	</section>
	
	<section>
		<h1>@lang('websocket.real_case.title')</h1>
		
		<p>@lang('websocket.real_case.1')</p>
		<p>@lang('websocket.real_case.2')</p>
		<p>@lang('websocket.real_case.3')</p>
		<p>@lang('websocket.real_case.4')</p>
		
		<img style="width: 500px;" src="{{ asset('images/publications/websocket/chrome-preview-1.png') }}">
		<div class="figure">@lang('websocket.figures.2')</div>
		
		<p>@lang('websocket.real_case.5')</p>
		
		<img style="width: 500px;" src="{{ asset('images/publications/websocket/chrome-preview-2.png') }}">
		<div class="figure">@lang('websocket.figures.3')</div>
	</section>
	
	<section>
		<h1>@lang('websocket.conclusion.title')</h1>
		
		<p>@lang('websocket.conclusion.1')</p>
		<p>@lang('websocket.conclusion.2')</p>
	</section>
	
	<section class="bibliography">
		<h1>@lang('publications.bibliography')</h1>
		
		<ul>
			<li>
				<span class="name">Engine Yard</span>.
				<a href="https://www.engineyard.com/articles/websocket">WebSocket: 5 Advantages of Using WebSockets</a>.
				@lang('publications.consulted_on', ['date' => Formatter::date(2015, 11, 8)])
			</li>
			<li>
				@lang('publications.enumeration', ['elements' => '<span class="name">Fette, I.</span>', 'last' => '<span class="name">Melnikov, A.</span>']) (2011).
				<a href="https://tools.ietf.org/html/rfc6455">The WebSocket Protocol</a>.
				Internet Engineering Task Force.
				@lang('publications.consulted_on', ['date' => Formatter::date(2015, 10, 28)])
			</li>
			<li>
				<span class="name">Hickson, I.</span> (2012).
				<a href="http://www.w3.org/TR/websockets">The WebSocket API</a>.
				W3C.
				@lang('publications.consulted_on', ['date' => Formatter::date(2015, 11, 1)])
			</li>
			<li>
				@lang('publications.enumeration', ['elements' => '<span class="name">Kitamura, E.</span>', 'last' => '<span class="name">Ubl, M.</span>']) (2010).
				<a href="http://www.html5rocks.com/en/tutorials/websockets/basics/">Introducing WebSockets: Bringing Sockets to the Web</a>.
				HTML5 Rocks.
				@lang('publications.consulted_on', ['date' => Formatter::date(2015, 10, 28)])
			</li>
			<li>
				<span class="name">Mozilla Foundation</span> (2015).
				<a href="https://developer.mozilla.org/en-US/docs/Web/API/WebSockets_API">WebSockets</a>.
				@lang('publications.consulted_on', ['date' => Formatter::date(2015, 11, 8)])
			</li>
			<li>
				<span class="name">Tiobe Software</span> (2015).
				<a href="http://www.tiobe.com/index.php/content/paperinfo/tpci/index.html">TIOBE Index for November 2015</a>.
				@lang('publications.consulted_on', ['date' => Formatter::date(2015, 11, 8)])
			</li>
			<li>
				<span class="name">Web Hypertext Application Technology Working Group</span> (2015).
				@lang('publications.section', ['name' => '<em>Web sockets</em>', 'publication' => '<a href="https://html.spec.whatwg.org/multipage/comms.html#network">HTML5 Living Standard</a>']), 9.3.
				@lang('publications.consulted_on', ['date' => Formatter::date(2015, 11, 1)])
			</li>
		</ul>
	</section>
@endsection