import { useCallback } from 'react';
import { useHistory } from 'react-router-dom';
import { inject, observer } from 'mobx-react';
import { Container, Header, Step, Button, Icon, Segment } from 'semantic-ui-react';


const View = ({ store }) => {
    const history = useHistory();

    const join = useCallback(() => {
        history.push(store.isAuthorized ? '/articles' : '/login');
    }, [store.isAuthorized]);

    return (
        <>
            <Segment
                vertical
                inverted
                textAlign="center"
                style={{
                    marginTop: '-15px',
                    padding: '10em 0 5em',
                }}
            >
                <Container>
                    <Header as="h1" content="ВТБ Знания" inverted />
                    <Button primary size="huge" onClick={join}>
                        Участвовать
                        <Icon name='right arrow' />
                    </Button>
                </Container>
            </Segment>

            <Container style={{ marginTop: '5em' }}>
                <Step.Group fluid>
                    <Step
                        icon="play circle"
                        title="Проявляй активность"
                    />
                    <Step
                        icon="dollar"
                        title="Получай баллы"
                    />
                    <Step
                        icon="coffee"
                        title="Трать баллы"
                    />
                </Step.Group>
            </Container>

            <Segment style={{ padding: '6em 0em' }} vertical>
                <Container text>
                    <p style={{ fontSize: '1.33em' }}>
                        Lorem ipsum Lorem ipsum  Lorem ipsum  Lorem ipsum  Lorem ipsum  Lorem ipsum
                        Lorem ipsum  Lorem ipsum  Lorem ipsum  Lorem ipsum  Lorem ipsum  Lorem ipsum
                        Lorem ipsum  Lorem ipsum  Lorem ipsum
                    </p>
                </Container>
            </Segment>
        </>
    );
};

export const About = inject('store')(observer(View));
