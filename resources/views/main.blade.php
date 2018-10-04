@extends('layouts.app')

@section('title', trans('app.author.full_name'))
@section('description', trans('app.description', ['age' => Carbon::createFromDate(1994, 1, 31)->age]))
@section('image', asset('images/headers/main/4k.jpg'))
@section('type', 'website')
@section('color', '#181830')

@section('body')
    <header class="main">
        <div class="avatar"></div>
        <h1>@lang('app.author.full_name')</h1>

        <div class="social row">
            <a href="https://github.com/v0ctor"><span class="github"></span></a>
            <a href="https://dribbble.com/v0ctor"><span class="dribbble"></span></a>
            <a href="https://linkedin.com/in/victordm"><span class="linkedin"></span></a>
            <a href="https://twitter.com/victordzmr"><span class="twitter"></span></a>
            <a href="https://facebook.com/v0ctor"><span class="facebook"></span></a>
            <a href="https://instagram.com/victor.dzmr"><span class="instagram"></span></a>
            <a href="https://open.spotify.com/user/victor.dm"><span class="spotify"></span></a>
        </div>

        <div id="scroll" class="arrow"></div>
        <div class="web"><a href="https://victordiaz.me">victordiaz.me</a></div>
    </header>

    <section class="about">
        <h1>@lang('main.about.title')</h1>

        <p>@lang('main.about.introduction', ['age' => Carbon::createFromDate(1994, 1, 31)->age])</p>
        <p>@lang('main.about.beginnings')</p>
        <p>@lang('main.about.principles')</p>

        <div class="values row">
            <div class="value">@lang('main.about.values.equality')</div>
            <div class="value">@lang('main.about.values.freedom')</div>
            <div class="value">@lang('main.about.values.respect')</div>
            <div class="value">@lang('main.about.values.empathy')</div>
            <div class="value">@lang('main.about.values.continuous_learning')</div>
            <div class="value">@lang('main.about.values.debate')</div>
            <div class="value">@lang('main.about.values.argumentation')</div>
            <div class="value">@lang('main.about.values.enthusiasm')</div>
            <div class="value">@lang('main.about.values.determination')</div>
            <div class="value">@lang('main.about.values.perfectionism')</div>
            <div class="value">@lang('main.about.values.professionalism')</div>
        </div>

        <p>@lang('main.about.cave')</p>
        <p>@lang('main.about.conclusion')</p>
    </section>

    <section class="education">
        <h1><span>@lang('main.education.title')</span></h1>

        <div class="period a-level">
            <time>2010 — 2012</time>
            <div class="name">@lang('main.education.a_level.name')</div>
            <div class="info"></div>
        </div>
        <div class="period bachelor-degree">
            <time>2012 — 2016</time>
            <div class="name">@lang('main.education.bachelor_degree.name')</div>
            <div class="info">
                @lang('main.education.bachelor_degree.specialty')<br>
                <a href="https://www.upv.es">@lang('main.education.bachelor_degree.institution')</a>
            </div>
        </div>
    </section>

    <section class="experience">
        <h1>@lang('main.experience.title')</h1>

        <div class="row">
            <div class="job">
                <div class="column">
                    <div class="position">@lang('main.experience.dixibox.position')</div>
                    <div class="organization">
                        @lang('main.experience.dixibox.organization')
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.experience.dixibox.period')</span>
                        @php $duration = Carbon::createFromDate(2018, 7, 16)->diffInMonths(); @endphp
                        <span class="badge">{{ trans_choice('dates.month', $duration, ['amount' => $duration]) }}</span>
                    </div>
                </div>
                <div class="logo dixibox"></div>
            </div>
            <div class="job">
                <div class="column">
                    <div class="position">@lang('main.experience.dide.position')</div>
                    <div class="organization">
                        <a href="http://educaryaprender.es">@lang('main.experience.dide.organization')</a>
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.experience.dide.period')</span>
                        @php $duration = Carbon::createFromDate(2018, 6, 29)->diffInMonths(); @endphp
                        <span class="badge">{{ trans_choice('dates.month', $duration, ['amount' => $duration]) }}</span>
                    </div>
                </div>
                <div class="logo dide"></div>
            </div>
            <div class="job">
                <div class="column">
                    <div class="position">@lang('main.experience.mobincube.position')</div>
                    <div class="organization">
                        <a href="https://mobincube.com">@lang('main.experience.mobincube.organization')</a>
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.experience.mobincube.period')</span>
                        <span class="badge">@lang('main.experience.mobincube.duration')</span>
                    </div>
                </div>
                <div class="logo mobincube"></div>
            </div>
            <div class="job">
                <div class="column">
                    <div class="position">@lang('main.experience.apadrina_un_olivo.position')</div>
                    <div class="organization">
                        <a href="https://apadrinaunolivo.org">@lang('main.experience.apadrina_un_olivo.organization')</a>
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.experience.apadrina_un_olivo.period')</span>
                        <span class="badge">@lang('main.experience.apadrina_un_olivo.duration')</span>
                    </div>
                </div>
                <div class="logo apadrina-un-olivo"></div>
            </div>
            <div class="job">
                <div class="column">
                    <div class="position">@lang('main.experience.habtium.position')</div>
                    <div class="organization">
                        <a href="https://habtium.es">@lang('main.experience.habtium.organization')</a></div>
                    <div class="period">
                        <span class="badge">@lang('main.experience.habtium.period')</span>
                        <span class="badge">@lang('main.experience.habtium.duration')</span>
                    </div>
                </div>
                <div class="logo habtium"></div>
            </div>
            <div class="job">
                <div class="column">
                    <div class="position">@lang('main.experience.valencia_city_council.position')</div>
                    <div class="organization">
                        <a href="http://www.valencia.es">@lang('main.experience.valencia_city_council.organization')</a>
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.experience.valencia_city_council.period')</span>
                        <span class="badge">@lang('main.experience.valencia_city_council.duration')</span>
                    </div>
                </div>
                <div class="logo valencia-city-council"></div>
            </div>
        </div>
    </section>

    <section class="volunteering">
        <h1>@lang('main.volunteering.title')</h1>

        <div class="column stretch">
            <div class="job">
                <div class="column">
                    <div class="position">@lang('main.volunteering.avptp.position')</div>
                    <div class="organization">
                        <a href="https://avptp.org">@lang('main.volunteering.avptp.organization')</a>
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.volunteering.avptp.period')</span>
                        @php $duration = Carbon::createFromDate(2018, 4, 30)->diffInMonths(); @endphp
                        <span class="badge">{{ trans_choice('dates.month', $duration, ['amount' => $duration]) }}</span>
                    </div>
                </div>
                <div class="logo avptp"></div>
            </div>
        </div>
    </section>

    <section class="skills">
        <h1><span>@lang('main.skills.title')</span></h1>

        <div class="first">
            <div class="second">
                <h2>@lang('main.skills.development_methodologies')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.kanban')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.scrum')</span>
                        <div class="level-50"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.tdd')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.fdd')</span>
                        <div class="level-100"></div>
                    </div>
                </div>

                <h2>@lang('main.skills.web_application_development')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.html')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.css')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.react')</span>
                        <div class="level-25"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.angular')</span>
                        <div class="level-50"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.jquery')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.laravel')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.lumen')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.rest')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.graphql')</span>
                        <div class="level-25"></div>
                    </div>
                </div>

                <h2>@lang('main.skills.programming_languages')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.php')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.javascript')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.java')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.ruby')</span>
                        <div class="level-25"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.go')</span>
                        <div class="level-25"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.swift')</span>
                        <div class="level-25"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.python')</span>
                        <div class="level-25"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.c')</span>
                        <div class="level-75"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.c++')</span>
                        <div class="level-25"></div>
                    </div>
                </div>

                <h2>@lang('main.skills.devops')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.kubernetes')</span>
                        <div class="level-50"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.docker')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.docker_swarm')</span>
                        <div class="level-50"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.jenkins')</span>
                        <div class="level-75"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.capistrano')</span>
                        <div class="level-75"></div>
                    </div>
                </div>
            </div>

            <div class="second">
                <h2>@lang('main.skills.system_and_network_administration')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.security')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.cryptography')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.aws')</span>
                        <div class="level-50"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.debian_and_ubuntu')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.rhel_and_centos')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.macos')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.ssh')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.dns')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.dhcp')</span>
                        <div class="level-100"></div>
                    </div>
                </div>

                <h2>@lang('main.skills.database_administration')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.mariadb')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.mysql')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.redis')</span>
                        <div class="level-75"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.mongodb')</span>
                        <div class="level-50"></div>
                    </div>
                </div>

                <h2>@lang('main.skills.web_server_administration')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.nginx')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.traefik')</span>
                        <div class="level-50"></div>
                    </div>
                </div>

                <h2>@lang('main.skills.mail_server_administration')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.postfix')</span>
                        <div class="level-75"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.dovecot')</span>
                        <div class="level-75"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.rspamd')</span>
                        <div class="level-75"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.spf')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.dkim')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.dmarc')</span>
                        <div class="level-100"></div>
                    </div>
                </div>

                <h2>@lang('main.skills.other')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.git')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.gulp')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.nodejs')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.websocket')</span>
                        <div class="level-100"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="languages">
        <h1>@lang('main.languages.title')</h1>

        <div class="language ca" style="order: {{  App::getLocale() === 'ca' ? '1' : '2' }};">
            <div class="name">@lang('main.languages.ca')</div>
            <div class="badge">@lang('main.languages.c1')</div>
        </div>
        <div class="language es" style="order: {{  App::getLocale() === 'es' ? '1' : '2' }};">
            <div class="name">@lang('main.languages.es')</div>
        </div>
        <div class="language en" style="order: {{  App::getLocale() === 'en' ? '1' : '2' }};">
            <div class="name">@lang('main.languages.en')</div>
            <div class="badge">@lang('main.languages.b2')</div>
        </div>
    </section>

    <section class="articles">
        <h1><span>@lang('main.articles.title')</span></h1>

        <a href="{{ url('websocket') }}">
            <div class="article websocket">@lang('websocket.title')</div>
        </a>
        <a href="{{ url('bitcoin') }}">
            <div class="article bitcoin">@lang('bitcoin.title')</div>
        </a>
    </section>

    <section class="contact">
        <h1>@lang('main.contact.title')</h1>

        <a href="mailto:victor@diazmarco.me">
            <div class="contact-method mail">
                <img src="{{ asset('images/envelope.svg') }}">
                victor@diazmarco.me
            </div>
        </a>
        <a href="https://linkedin.com/in/victordm">
            <div class="contact-method linkedin">
                <img src="{{ asset('images/linkedin.svg') }}">
                @victordm
            </div>
        </a>
        <a href="https://twitter.com/victordzmr">
            <div class="contact-method twitter">
                <img src="{{ asset('images/twitter.svg') }}">
                @victordzmr
            </div>
        </a>
        <a href="https://keybase.io/victordm">
            <div class="contact-method keybase">
                <img src="{{ asset('images/keybase.svg') }}">
                @victordm
            </div>
        </a>
    </section>
@endsection
