import { render } from 'react-dom';
import { Provider } from 'mobx-react';
import { BrowserRouter } from 'react-router-dom';

import { App } from '@/App';
import { configureStore } from '@/store';

import 'semantic-ui-css/semantic.min.css';
import './variables.module.scss';


render(
    <BrowserRouter>
        <Provider {...configureStore()}>
            <App />
        </Provider>
    </BrowserRouter>,
    document.getElementById('root'),
);

if (module.hot) {
    module.hot.accept();
}
