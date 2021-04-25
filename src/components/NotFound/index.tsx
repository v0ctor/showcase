import React from 'react';
import {Trans, useTranslation} from 'react-i18next';
import {Link} from 'react-router-dom';
import './styles.scss';

export default function NotFound() {
    const {t} = useTranslation('errors');

    return (
        <header className="not-found">
            <h1>{t('not_found.title')}</h1>
            <div className="description paragraph">
                <Trans
                    t={t}
                    i18nKey="not_found.description"
                    components={[
                        <Link to="/" />
                    ]} />
            </div>
        </header>
    );
}
