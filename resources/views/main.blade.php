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
            <a href="https://linkedin.com/in/v0ctor"><img src="{{ asset('images/social/linkedin.svg') }}" alt="LinkedIn"></a>
            <a href="https://github.com/v0ctor"><img src="{{ asset('images/social/github.svg') }}" alt="GitHub"></a>
            <a href="https://keybase.io/v0ctor"><img src="{{ asset('images/social/keybase.svg') }}" alt="Keybase"></a>
        </div>

        <div id="scroll" class="arrow"></div>
        <div class="web"><a href="https://v0ctor.me">v0ctor.me</a></div>
    </header>

    <section class="about">
        <h1>@lang('main.about.title')</h1>

        <p>@lang('main.about.introduction')</p>
        <p>@lang('main.about.cave')</p>
        <p>@lang('main.about.principles')</p>

        <div class="values row">
            <div class="value">@lang('main.about.values.respect')</div>
            <div class="value">@lang('main.about.values.empathy')</div>
            <div class="value">@lang('main.about.values.equality')</div>
            <div class="value">@lang('main.about.values.freedom')</div>
            <div class="value">@lang('main.about.values.debate')</div>
            <div class="value">@lang('main.about.values.argumentation')</div>
            <div class="value">@lang('main.about.values.continuous_learning')</div>
        </div>
    </section>

    <section class="jobs">
        <h1>@lang('main.jobs.title')</h1>

        <div class="column stretch">
            <div class="job">
                <div class="column">
                    <div class="position">@lang('main.jobs.brutal.position')</div>
                    <div class="organization">
                        <a href="https://brutalsys.com">@lang('main.jobs.brutal.organization')</a>
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.jobs.brutal.period')</span>
                        <span class="badge">{{ Carbon::createFromDate(2021, 2, 1)->longAbsoluteDiffForHumans(Carbon::now()) }}</span>
                    </div>
                </div>
                <div class="logo brutal"></div>
            </div>
            <div class="job">
                <div class="column">
                    <div class="position">@lang('main.jobs.doyo.position')</div>
                    <div class="organization">
                        <a href="https://doyo.tech">@lang('main.jobs.doyo.organization')</a>
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.jobs.doyo.period')</span>
                        <span class="badge">{{ Carbon::createFromDate(2018, 6, 22)->longAbsoluteDiffForHumans(Carbon::createFromDate(2021, 1, 31), 2) }}</span>
                        <span class="badge emphasized">@lang('main.jobs.co-founder')</span>
                    </div>
                </div>
                <div class="logo doyo"></div>
            </div>
            <div class="job">
                <div class="column">
                    <div class="position">@lang('main.jobs.mobincube.position')</div>
                    <div class="organization">
                        <a href="https://mobincube.com">@lang('main.jobs.mobincube.organization')</a>
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.jobs.mobincube.period')</span>
                        <span class="badge">{{ Carbon::createFromDate(2017, 8, 7)->longAbsoluteDiffForHumans(Carbon::createFromDate(2018, 6, 22)) }}</span>
                    </div>
                </div>
                <div class="logo mobincube"></div>
            </div>
            <div class="job">
                <div class="column">
                    <div class="position">@lang('main.jobs.apadrina_un_olivo.position')</div>
                    <div class="organization">
                        <a href="https://apadrinaunolivo.org">@lang('main.jobs.apadrina_un_olivo.organization')</a>
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.jobs.apadrina_un_olivo.period')</span>
                        <span class="badge">{{ Carbon::createFromDate(2017, 3, 7)->longAbsoluteDiffForHumans(Carbon::createFromDate(2017, 8, 7)) }}</span>
                    </div>
                </div>
                <div class="logo apadrina-un-olivo"></div>
            </div>
        </div>
    </section>

    <section class="projects">
        <h1>@lang('main.projects.title')</h1>

        <div class="column stretch">
            <div class="project">
                <div class="column">
                    <div class="position">@lang('main.projects.avptp.position')</div>
                    <div class="organization">
                        <a href="https://avptp.org">@lang('main.projects.avptp.organization')</a>
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.projects.avptp.period')</span>
                        <span class="badge">{{ Carbon::createFromDate(2018, 4, 30)->longAbsoluteDiffForHumans(Carbon::now(), 2) }}</span>
                        <span class="badge emphasized">@lang('main.jobs.co-founder')</span>
                    </div>
                </div>
                <div class="logo avptp"></div>
            </div>
            <div class="project">
                <div class="column">
                    <div class="position">@lang('main.projects.mobincube.name')</div>
                    <div class="organization">
                        <a href="https://mobincube.com">@lang('main.jobs.mobincube.organization')</a>
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.projects.mobincube.period')</span>
                        <span class="badge">{{ Carbon::createFromDate(2019, 6, 1)->longAbsoluteDiffForHumans(Carbon::createFromDate(2020, 11, 30), 2) }}</span>
                    </div>
                </div>
                <div class="logo mobincube"></div>
            </div>
            <div class="project">
                <div class="column">
                    <div class="position">@lang('main.projects.dide.name')</div>
                    <div class="organization">
                        <a href="https://dide.app">@lang('main.projects.dide.organization')</a>
                    </div>
                    <div class="period">
                        <span class="badge">@lang('main.projects.dide.period')</span>
                        <span class="badge">{{ Carbon::createFromDate(2018, 6, 22)->longAbsoluteDiffForHumans(Carbon::createFromDate(2018, 12, 22)) }}</span>
                    </div>
                </div>
                <div class="logo dide"></div>
            </div>
            <div class="project">
                <div class="column">
                    <div class="position">@lang('main.projects.habtium.position')</div>
                    <div class="organization">
                        <a href="https://habtium.es">@lang('main.projects.habtium.organization')</a></div>
                    <div class="period">
                        <span class="badge">@lang('main.projects.habtium.period')</span>
                        <span class="badge">{{ Carbon::createFromDate(2010, 1, 1)->longAbsoluteDiffForHumans(Carbon::createFromDate(2016, 7, 1), 2) }}</span>
                    </div>
                </div>
                <div class="logo habtium"></div>
            </div>
        </div>
    </section>

    <section class="skills">
        <h1><span>@lang('main.skills.title')</span></h1>

        <div class="first">
            <div class="second">
                <h2>@lang('main.skills.devops')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.kubernetes')</span>
                        <div class="level-75"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.docker')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.ansible')</span>
                        <div class="level-75"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.drone')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.jenkins')</span>
                        <div class="level-75"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.git')</span>
                        <div class="level-100"></div>
                    </div>
                </div>

                <h2>@lang('main.skills.systems_and_networking')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.gnu_linux')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.macos')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.cryptography')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.security')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.traefik')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.nginx')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.caddy')</span>
                        <div class="level-50"></div>
                    </div>
                </div>

                <h2>@lang('main.skills.databases')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.mariadb')</span>
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
                    <div class="skill">
                        <span>@lang('main.skills.postgresql')</span>
                        <div class="level-25"></div>
                    </div>
                </div>

                <h2>@lang('main.skills.cloud_providers')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.digitalocean')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.aws')</span>
                        <div class="level-50"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.google_cloud')</span>
                        <div class="level-25"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.azure')</span>
                        <div class="level-25"></div>
                    </div>
                </div>
            </div>

            <div class="second">
                <h2>@lang('main.skills.programming_languages')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.go')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.rust')</span>
                        <div class="level-25"></div>
                    </div>
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
                        <span>@lang('main.skills.c')</span>
                        <div class="level-50"></div>
                    </div>
                </div>

                <h2>@lang('main.skills.software_development')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.fdd')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.tdd')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.graphql')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.rest')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.html')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.sass_css')</span>
                        <div class="level-100"></div>
                    </div>
                </div>

                <h2>@lang('main.skills.frameworks_and_environments')</h2>
                <div class="row">
                    <div class="skill">
                        <span>@lang('main.skills.symfony')</span>
                        <div class="level-75"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.laravel_lumen')</span>
                        <div class="level-100"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.express')</span>
                        <div class="level-50"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.react')</span>
                        <div class="level-50"></div>
                    </div>
                    <div class="skill">
                        <span>@lang('main.skills.nodejs')</span>
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
        <a href="https://linkedin.com/in/v0ctor">
            <div class="contact-method linkedin">
                <img src="{{ asset('images/social/linkedin.svg') }}">
                @v0ctor
            </div>
        </a>
        <a href="https://keybase.io/v0ctor">
            <div class="contact-method keybase">
                <img src="{{ asset('images/social/keybase.svg') }}">
                @v0ctor
            </div>
        </a>
    </section>
@endsection
