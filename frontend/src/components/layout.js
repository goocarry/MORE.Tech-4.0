import { useEffect } from 'react';
import { inject, observer } from 'mobx-react';
import { Link, useHistory, useLocation } from 'react-router-dom';
import { Container, Dropdown, Menu } from 'semantic-ui-react';


const View = ({ store, children }) => {
    const { pathname } = useLocation();
    const history = useHistory();

    useEffect(() => {
        if (pathname === '/' || store.isAuthorized) {
            return;
        }

        history.push('/login');
    }, [pathname, store.account]);

    return (
        <>
            <Menu fixed="top">
                <Container>
                    <Menu.Item header>ВТБ Знания</Menu.Item>
                    <Menu.Item>
                        <Link to="/">О проекте</Link>
                    </Menu.Item>
                    <Menu.Menu position="right">
                        <Menu.Item>
                            <Dropdown icon="user">
                                <Dropdown.Menu>
                                    <Dropdown.Item>
                                        <Link to={store.isAuthorized ? '/profile' : '/login'}>
                                            {store.isAuthorized ? 'Профиль' : 'Войти'}
                                        </Link>
                                    </Dropdown.Item>
                                    {store.isAuthorized && (
                                        <>
                                            <Dropdown.Item>
                                                <Link to="/tasks">Задачи</Link>
                                            </Dropdown.Item>
                                            <Dropdown.Item>
                                                <Link to="/articles">Статьи</Link>
                                            </Dropdown.Item>
                                            <Dropdown.Item>
                                                <Link to="/shop">Магазин</Link>
                                            </Dropdown.Item>
                                            <Dropdown.Item>
                                                <Link to="/create">Написать пост</Link>
                                            </Dropdown.Item>
                                        </>
                                    )}
                                </Dropdown.Menu>
                            </Dropdown>
                        </Menu.Item>
                    </Menu.Menu>
                </Container>
            </Menu>
            <div className="divider" />

            {children}
        </>
    );
};

export const Layout = inject('store')(observer(View));
