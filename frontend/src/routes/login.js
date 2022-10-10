import { useCallback, useState } from 'react';
import { inject, observer } from 'mobx-react';
import { useHistory } from 'react-router-dom';
import {
    Grid,
    Header,
    Form,
    Segment,
    Button,
    Container,
} from 'semantic-ui-react';
import { useBeforeRendering } from '@/helpers';


const View = ({ store }) => {
    const history = useHistory();
    const [formValues, updateFormValues] = useState({
        username: '',
        password: '',
    });

    const handleChangeField = useCallback((evt) => {
        updateFormValues((fields) => ({
            ...fields,
            [evt.target.name]: evt.target.value,
        }));
    }, []);

    const login = useCallback(async () => {
        try {
            await store.login(formValues);
            history.push('/tasks');
        } catch (err) {
            // skip
        }
    }, [formValues, history.push]);

    return (
        <Container>
            <Grid
                textAlign="center"
                verticalAlign="middle"
                style={{
                    height: '100vh',
                    paddingTop: '40px',
                }}
            >
                <Grid.Column style={{ maxWidth: 450 }}>
                    <Header as="h1" color="blue" textAlign="center">
                        Войдите в ВТБ Знания
                    </Header>
                    <Form size="large">
                        <Segment>
                            <Form.Input
                                fluid
                                icon="user"
                                iconPosition="left"
                                placeholder="логин"
                                name="username"
                                onChange={handleChangeField}
                                value={formValues.username}
                            />
                            <Form.Input
                                fluid
                                icon="lock"
                                iconPosition="left"
                                placeholder="пароль"
                                type="password"
                                name="password"
                                onChange={handleChangeField}
                                value={formValues.password}
                            />

                            <Button
                                color="blue"
                                fluid
                                size="large"
                                onClick={login}
                                disabled={!formValues.username || !formValues.password || store.isLoadingAccount}
                            >
                                Войти
                            </Button>
                        </Segment>
                    </Form>
                </Grid.Column>
            </Grid>
        </Container>
    );
}

export const Login = inject('store')(observer(View));
