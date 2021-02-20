import './styles.scss';
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';
import Portfolio from 'components/Portfolio';
import React from 'react';
import {useTranslation} from 'react-i18next';
import CookieNotice from 'components/CookieNotice';
import NotFound from 'components/NotFound';

export default function App() {
    const {i18n} = useTranslation('app');

    React.useEffect(() => {
        document.documentElement.setAttribute('lang', i18n.language);
    }, [i18n]);

    return (
        <>
            <Router>
                <Switch>
                    <Route exact path="/" component={Portfolio} />
                    <Route path="*" component={NotFound} />
                </Switch>
            </Router>
            <CookieNotice />
        </>
    );
}
