import { Component } from 'react';
import { Redirect, Route, Switch } from 'react-router-dom';

import { Layout } from './components/layout';
import { routes } from './routes';


export class App extends Component {
    state = {
        error: null,
    };

    componentDidCatch(error, errorInfo) {
        this.setState({ error });
    }

    render() {
        if (this.state.error) {
            return (
                <pre>
                    <code>
                        {JSON.stringify(this.state.error, null, 4)}
                    </code>
                </pre>
            );
        }

        return (
            <Layout>
                <Switch>
                    {routes.map(({ path, isExact, Component }) => (
                        <Route
                            key={path}
                            path={path}
                            exact={isExact}
                            component={Component}
                        />
                    ))}
                    <Redirect to="/" />
                </Switch>
            </Layout>
        );
    }
}
