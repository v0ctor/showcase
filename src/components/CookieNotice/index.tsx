import React, {useState} from 'react';
import {useTranslation} from 'react-i18next';
import './styles.scss';

export default function CookieNotice() {
    const [accepted, setAccepted] = useState(
        localStorage.getItem('cookies')
    );

    const {t} = useTranslation('cookies');

    React.useEffect(() => {
        accepted === 'true' ? localStorage.setItem('cookies', 'true') : localStorage.removeItem('cookies');
    }, [accepted]);

    if (accepted) {
        return null;
    }

    return (
        <div className="cookie-notice">
            <div className="text">
                <span>{t('message')}</span>
            </div>
            <div className="actions">
                <a href={t('link')} target="_blank" rel="noopener noreferrer">{t('information')}</a>
                <button onClick={() => setAccepted('true')}>{t('accept')}</button>
            </div>
        </div>
    );
}
