import React, {ReactNode, useEffect, useState} from 'react';
import {useParams} from 'react-router-dom';
import {useTranslation} from 'react-i18next';
import Markdown from 'react-markdown';
import RemarkGFM from 'remark-gfm';
import RehypeRaw from 'rehype-raw';
import matter from 'gray-matter';
import {Light as SyntaxHighlighter} from 'react-syntax-highlighter';
import AtomOneLightTheme from 'react-syntax-highlighter/dist/esm/styles/hljs/atom-one-light';
import LanguageJavaScript from 'react-syntax-highlighter/dist/esm/languages/hljs/javascript';
import LanguageHttp from 'react-syntax-highlighter/dist/esm/languages/hljs/http';
import NotFound from 'components/NotFound';
import './styles.scss';

SyntaxHighlighter.registerLanguage('http', LanguageHttp);
SyntaxHighlighter.registerLanguage('javascript', LanguageJavaScript);

interface RouteParams {
    slug: string
}

interface Article {
    title: string
    description: string
    date: Date
    sections: Array<string>
}

export default function Article() {
    let {slug} = useParams<RouteParams>();
    const {t, i18n} = useTranslation('app');
    const [article, setArticle] = useState<Article>();

    useEffect(() => {
        let language = i18n.languages[0];

        // Articles are not yet available in English
        if (language === 'en') {
            language = 'es';
        }

        getArticle(slug, language)
            .then(data => setArticle(data));
    }, []);

    if (!article) {
        return (
            <NotFound />
        );
    }

    return (
        <article className="article">
            <header style={{background: `linear-gradient(to right, rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url(/static/articles/${slug}/images/header.jpg)`}}>
                <h1>{article.title}</h1>
                <div className="author">{t('app:name')}</div>
                <time dateTime={article.date.toISOString()}>
                    {article.date.toLocaleDateString(i18n.languages[0], {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                    })}
                </time>
            </header>
            {
                article.sections.map((section: string, key: number) => (
                    <section key={key}>
                        <Markdown
                            children={section}
                            remarkPlugins={[RemarkGFM]}
                            rehypePlugins={[RehypeRaw]}
                            components={{
                                p: function (props: { children?: ReactNode[] }): ReactNode {
                                    if (props.children && props.children.length > 0) {
                                        const first = props.children[0];

                                        if (first && typeof first === 'object' && 'type' in first && first.type === 'img') {
                                            return (<p className="center">{props.children}</p>)
                                        }
                                    }

                                    return (<p>{props.children}</p>)
                                },
                                code: function (props: { children?: ReactNode[], inline?: boolean, className?: string }): ReactNode {
                                    const language = /language-(\w+)/.exec(props.className || '')
                                    const children = String(props.children).replace(/\n$/, '');

                                    if (props.inline) {
                                        return (
                                            <code className={props.className}>
                                                {children}
                                            </code>
                                        );
                                    }

                                    return (
                                        <SyntaxHighlighter
                                            children={children}
                                            style={AtomOneLightTheme}
                                            language={language ? language[1] : 'text'}
                                            PreTag="div" />
                                    );
                                }
                            }}
                        />
                    </section>
                ))
            }
        </article>
    );
}

async function getArticle(name: string, language: string): Promise<Article> {
    let markdown;

    try {
        const response = await fetch(`/static/articles/${name}/${language}.md`);
        markdown = await response.text();
    } catch (e) {
        return Promise.reject('error while trying to fetch the article');
    }

    const {content, data} = matter(markdown);

    if (Object.keys(data).length === 0) {
        return Promise.reject('error while trying to parse the article');
    }

    return {
        title: data.title,
        description: data.description,
        date: data.date,
        sections: content.trim().split(/(?=^## .+$)/gm),
    };
}
