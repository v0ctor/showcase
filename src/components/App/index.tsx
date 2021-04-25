import React from 'react';
import {useTranslation} from 'react-i18next';
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';
import CookieNotice from 'components/CookieNotice';
import Portfolio from 'components/Portfolio';
import Article from 'components/Article';
import NotFound from 'components/NotFound';
import './styles.scss';

export default function App() {
    const {i18n} = useTranslation('app');

    React.useEffect(() => {
        document.documentElement.setAttribute('lang', i18n.languages[0]);
    }, [i18n]);

    return (
        <>
            <Router>
                <Switch>
                    <Route
                        path="/"
                        component={Portfolio}
                        exact />
                    <Route
                        path="/:slug([a-z0-9\\-]+)"
                        component={Article}
                        exact
                        strict />
                    <Route component={NotFound} />
                </Switch>
            </Router>
            <CookieNotice />
        </>
    );
}
