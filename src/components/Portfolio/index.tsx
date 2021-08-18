import React from 'react';
import {Trans, useTranslation} from 'react-i18next';
import {Link} from "react-router-dom";
import {DateTime} from 'luxon';
import Diff from 'components/Time/Diff';
import Period from 'components/Time/Period';
import linkedInLogo from './images/social/linkedin.svg';
import gitHubLogo from './images/social/github.svg';
import keybaseLogo from './images/social/keybase.svg';
import envelopeLogo from './images/envelope.svg';
import './styles.scss';

export default function Portfolio() {
    const {t, i18n} = useTranslation('portfolio');

    return (
        <article className="portfolio">
            <header>
                <div className="avatar" />
                <h1>{t('app:name')}</h1>

                <div className="social row">
                    <a href="https://linkedin.com/in/v0ctor"><img src={linkedInLogo} alt="LinkedIn" /></a>
                    <a href="https://github.com/v0ctor"><img src={gitHubLogo} alt="GitHub" /></a>
                    <a href="https://keybase.io/v0ctor"><img src={keybaseLogo} alt="Keybase" /></a>
                </div>

                <div id="scroll" className="arrow" />
                <div className="web"><a href="https://v0ctor.me">v0ctor.me</a></div>
            </header>

            <section className="about">
                <h2>{t('about.title')}</h2>

                <Trans
                    t={t}
                    parent="p"
                    i18nKey="about.introduction.text"
                    components={[
                        <strong />,
                        <a href={t('about.introduction.url')} />, // eslint-disable-line
                    ]} />
                <Trans
                    t={t}
                    parent="p"
                    i18nKey="about.cave.text"
                    components={[
                        <strong>
                            <a href={t('about.cave.url')} /> {/* eslint-disable-line */}
                        </strong>
                    ]} />
                <Trans
                    t={t}
                    parent="p"
                    i18nKey="about.principles"
                    components={[
                        <strong />
                    ]} />

                <div className="values row">
                    {Object.entries(t<string, object>('about.values')).map((item: [string, string]) => (
                        <span key={item[0]} className="value">{item[1]}</span>
                    ))}
                </div>
            </section>

            <section className="jobs">
                <h2>{t('jobs.title')}</h2>

                <div className="column stretch">
                    <div className="job">
                        <div className="column">
                            <div className="position">
                                <Trans
                                    t={t}
                                    i18nKey="jobs.brutal"
                                    components={[
                                        <small>
                                            <em />
                                        </small>
                                    ]} />
                            </div>
                            <div className="organization paragraph">
                                <a href="https://brutalsys.com">Brutal</a>
                            </div>
                            {
                                (() => {
                                    const start = DateTime.local(2021, 2, 1);
                                    const end = DateTime.local();
                                    const duration = end.diff(start);

                                    return (
                                        <div className="period">
                                            <span className="badge">
                                                {start.toLocaleString({
                                                    year: 'numeric',
                                                    month: 'long'
                                                })} — {t('time:now')}
                                            </span>
                                            <span className="badge">
                                                <Diff duration={duration} />
                                            </span>
                                        </div>
                                    );
                                })()
                            }
                        </div>
                        <div className="logo brutal" />
                    </div>
                    <div className="job">
                        <div className="column">
                            <div className="position">
                                <Trans
                                    t={t}
                                    i18nKey="jobs.doyo"
                                    components={[
                                        <small>
                                            <em />
                                        </small>
                                    ]} />
                            </div>
                            <div className="organization paragraph">
                                <a href="https://doyo.tech">Doyo</a>
                            </div>
                            {
                                (() => {
                                    const start = DateTime.local(2018, 6, 22);
                                    const end = DateTime.local(2021, 1, 31);
                                    const duration = end.diff(start);

                                    return (
                                        <div className="period">
                                            <span className="badge"><Period start={start} end={end} /></span>
                                            <span className="badge"><Diff duration={duration} /></span>
                                            <span className="badge emphasized">{t('jobs.co-founder')}</span>
                                        </div>
                                    );
                                })()
                            }
                        </div>
                        <div className="logo doyo" />
                    </div>
                    <div className="job">
                        <div className="column">
                            <div className="position">
                                <Trans
                                    t={t}
                                    i18nKey="jobs.mobincube"
                                    components={[
                                        <em />
                                    ]} />
                            </div>
                            <div className="organization paragraph">
                                <a href="https://mobincube.com">Mobincube</a>
                            </div>
                            {
                                (() => {
                                    const start = DateTime.local(2017, 8, 7);
                                    const end = DateTime.local(2018, 6, 22);
                                    const duration = end.diff(start);

                                    return (
                                        <div className="period">
                                            <span className="badge"><Period start={start} end={end} /></span>
                                            <span className="badge"><Diff duration={duration} /></span>
                                        </div>
                                    );
                                })()
                            }
                        </div>
                        <div className="logo mobincube" />
                    </div>
                    <div className="job">
                        <div className="column">
                            <div className="position">{t('jobs.apadrina_un_olivo')}</div>
                            <div className="organization paragraph">
                                <a href="https://apadrinaunolivo.org">Apadrina un olivo</a>
                            </div>
                            {
                                (() => {
                                    const start = DateTime.local(2017, 3, 7);
                                    const end = DateTime.local(2017, 8, 7);
                                    const duration = end.diff(start);

                                    return (
                                        <div className="period">
                                            <span className="badge"><Period start={start} end={end} /></span>
                                            <span className="badge"><Diff duration={duration} /></span>
                                        </div>
                                    );
                                })()
                            }
                        </div>
                        <div className="logo auo" />
                    </div>
                </div>
            </section>

            <section className="projects">
                <h2>{t('projects.title')}</h2>

                <div className="column stretch">
                    <div className="project">
                        <div className="column">
                            <div className="position">{t('projects.avptp')}</div>
                            <div className="organization paragraph">
                                <a href="https://avptp.org">Associació Valenciana pel Transport Públic</a>
                            </div>
                            {
                                (() => {
                                    const start = DateTime.local(2018, 4, 30);
                                    const end = DateTime.local();
                                    const duration = end.diff(start);

                                    return (
                                        <div className="period">
                                            <span className="badge">
                                                {start.toLocaleString({
                                                    year: 'numeric',
                                                    month: 'long'
                                                })} — {t('time:now')}
                                            </span>
                                            <span className="badge">
                                                <Diff duration={duration} />
                                            </span>
                                            <span className="badge emphasized">{t('jobs.co-founder')}</span>
                                        </div>
                                    );
                                })()
                            }
                        </div>
                        <div className="logo avptp" />
                    </div>
                    <div className="project">
                        <div className="column">
                            <div className="position">{t('projects.kubernetes')}</div>
                            <div className="organization paragraph">
                                <a href="https://forocoches.com">ForoCoches</a>
                            </div>
                            {
                                (() => {
                                    const start = DateTime.local(2021, 3, 9);
                                    const end = DateTime.local(2021, 8, 18);
                                    const duration = end.diff(start);

                                    return (
                                        <div className="period">
                                            <span className="badge"><Period start={start} end={end} /></span>
                                            <span className="badge"><Diff duration={duration} /></span>
                                        </div>
                                    );
                                })()
                            }
                        </div>
                        <div className="logo forocoches" />
                    </div>
                    <div className="project">
                        <div className="column">
                            <div className="position">{t('projects.kubernetes')}</div>
                            <div className="organization paragraph">
                                <a href="https://mobincube.com">Mobincube</a>
                            </div>
                            {
                                (() => {
                                    const start = DateTime.local(2019, 6, 1);
                                    const end = DateTime.local(2020, 11, 30);
                                    const duration = end.diff(start);

                                    return (
                                        <div className="period">
                                            <span className="badge"><Period start={start} end={end} /></span>
                                            <span className="badge"><Diff duration={duration} /></span>
                                        </div>
                                    );
                                })()
                            }
                        </div>
                        <div className="logo mobincube" />
                    </div>
                    <div className="project">
                        <div className="column">
                            <div className="position">{t('projects.kubernetes')}</div>
                            <div className="organization paragraph">
                                <a href="https://dide.app">Dide</a>
                            </div>
                            {
                                (() => {
                                    const start = DateTime.local(2018, 6, 22);
                                    const end = DateTime.local(2018, 12, 22);
                                    const duration = end.diff(start);

                                    return (
                                        <div className="period">
                                            <span className="badge"><Period start={start} end={end} /></span>
                                            <span className="badge"><Diff duration={duration} /></span>
                                        </div>
                                    );
                                })()
                            }
                        </div>
                        <div className="logo dide" />
                    </div>
                    <div className="project">
                        <div className="column">
                            <div className="position">{t('projects.habtium')}</div>
                            <div className="organization paragraph">
                                <a href="https://habtium.es">Habtium</a>
                            </div>
                            {
                                (() => {
                                    const start = DateTime.local(2010, 1, 1);
                                    const end = DateTime.local(2016, 7, 1);
                                    const duration = end.diff(start);

                                    return (
                                        <div className="period">
                                            <span className="badge"><Period start={start} end={end} /></span>
                                            <span className="badge"><Diff duration={duration} /></span>
                                        </div>
                                    );
                                })()
                            }
                        </div>
                        <div className="logo habtium" />
                    </div>
                </div>
            </section>

            <section className="skills">
                <h2><span>{t('skills.title')}</span></h2>

                <div className="first">
                    <div className="second">
                        <Trans
                            t={t}
                            parent="h3"
                            i18nKey="skills.devops"
                            components={[
                                <em />
                            ]} />
                        <div className="row">
                            {
                                (() => {
                                    const skills = [
                                        ['Kubernetes', '75'],
                                        ['Docker', '100'],
                                        ['Ansible', '75'],
                                        ['Terraform', '50'],
                                        ['Drone', '100'],
                                        ['Jenkins', '75'],
                                        ['Git', '100'],
                                    ];

                                    return skills.map((item: string[], key: number) => (
                                        <div className="skill" key={key}>
                                            <span>{item[0]}</span>
                                            <div className={`level-` + item[1]} />
                                        </div>
                                    ));
                                })()
                            }
                        </div>

                        <h3>{t('skills.systems_and_networking')}</h3>
                        <div className="row">
                            {
                                (() => {
                                    const skills = [
                                        ['GNU/Linux', '100'],
                                        ['MacOS', '100'],
                                        [t('skills.cryptography'), '100'],
                                        [t('skills.security'), '100'],
                                        ['Traefik Proxy', '100'],
                                        ['Nginx', '100'],
                                        ['Caddy', '50'],
                                    ];

                                    return skills.map((item: string[], key: number) => (
                                        <div className="skill" key={key}>
                                            <span>{item[0]}</span>
                                            <div className={`level-` + item[1]} />
                                        </div>
                                    ));
                                })()
                            }
                        </div>

                        <h3>{t('skills.databases')}</h3>
                        <div className="row">
                            {
                                (() => {
                                    const skills = [
                                        ['MariaDB/MySQL', '100'],
                                        ['Redis', '75'],
                                        ['MongoDB', '50'],
                                        ['PostgreSQL', '25'],
                                    ];

                                    return skills.map((item: string[], key: number) => (
                                        <div className="skill" key={key}>
                                            <span>{item[0]}</span>
                                            <div className={`level-` + item[1]} />
                                        </div>
                                    ));
                                })()
                            }
                        </div>
                    </div>

                    <div className="second">
                        <h3>{t('skills.cloud_providers')}</h3>
                        <div className="row">
                            {
                                (() => {
                                    const skills = [
                                        ['DigitalOcean', '100'],
                                        ['AWS', '50'],
                                        ['Google Cloud', '25'],
                                        ['Azure', '25'],
                                    ];

                                    return skills.map((item: string[], key: number) => (
                                        <div className="skill" key={key}>
                                            <span>{item[0]}</span>
                                            <div className={`level-` + item[1]} />
                                        </div>
                                    ));
                                })()
                            }
                        </div>

                        <h3>{t('skills.programming_languages')}</h3>
                        <div className="row">
                            {
                                (() => {
                                    const skills = [
                                        ['Go', '100'],
                                        ['Rust', '25'],
                                        ['PHP', '100'],
                                        ['JavaScript', '100'],
                                        ['Java', '100'],
                                        ['C', '50'],
                                    ];

                                    return skills.map((item: string[], key: number) => (
                                        <div className="skill" key={key}>
                                            <span>{item[0]}</span>
                                            <div className={`level-` + item[1]} />
                                        </div>
                                    ));
                                })()
                            }
                        </div>

                        <h3>{t('skills.software_development')}</h3>
                        <div className="row">
                            {
                                (() => {
                                    const skills = [
                                        ['FDD', '100'],
                                        ['TDD', '100'],
                                        ['GraphQL', '100'],
                                        ['REST', '100'],
                                        ['HTML', '100'],
                                        ['SASS/CSS', '100'],
                                    ];

                                    return skills.map((item: string[], key: number) => (
                                        <div className="skill" key={key}>
                                            <span>{item[0]}</span>
                                            <div className={`level-` + item[1]} />
                                        </div>
                                    ));
                                })()
                            }
                        </div>

                        <Trans
                            t={t}
                            parent="h3"
                            i18nKey="skills.frameworks_and_environments"
                            components={[
                                <em />
                            ]} />
                        <div className="row">
                            {
                                (() => {
                                    const skills = [
                                        ['Symfony', '75'],
                                        ['Laravel/Lumen', '100'],
                                        ['Express', '50'],
                                        ['React', '50'],
                                        ['NodeJS', '100'],
                                    ];

                                    return skills.map((item: string[], key: number) => (
                                        <div className="skill" key={key}>
                                            <span>{item[0]}</span>
                                            <div className={`level-` + item[1]} />
                                        </div>
                                    ));
                                })()
                            }
                        </div>
                    </div>
                </div>
            </section>

            <section className="languages">
                <h2>{t('languages.title')}</h2>

                <div className="language ca" style={{order: i18n.languages[0] === 'ca' ? 1 : 2}}>
                    <div className="name">{t('languages.ca')}</div>
                    <div className="badge">C1</div>
                </div>
                <div className="language es" style={{order: i18n.languages[0] === 'es' ? 1 : 2}}>
                    <div className="name">{t('languages.es')}</div>
                </div>
                <div className="language en" style={{order: i18n.languages[0] === 'en' ? 1 : 2}}>
                    <div className="name">{t('languages.en')}</div>
                    <div className="badge">B2</div>
                </div>
                <div className="language fr" style={{order: i18n.languages[0] === 'fr' ? 1 : 2}}>
                    <div className="name">{t('languages.fr')}</div>
                </div>
            </section>

            <section className="contact">
                <h2>{t('contact.title')}</h2>

                <a href="mailto:victor@diazmarco.me">
                    <div className="contact-method mail">
                        <img src={envelopeLogo} alt="" />
                        victor@diazmarco.me
                    </div>
                </a>
                <a href="https://linkedin.com/in/v0ctor">
                    <div className="contact-method linkedin">
                        <img src={linkedInLogo} alt="" />
                        @v0ctor
                    </div>
                </a>
                <a href="https://keybase.io/v0ctor">
                    <div className="contact-method keybase">
                        <img src={keybaseLogo} alt="" />
                        @v0ctor
                    </div>
                </a>
            </section>
        </article>
    );
}
