import { useHistory } from 'react-router-dom';
import { inject, observer } from 'mobx-react';
import {
    Container,
    Card,
    Image,
    Button,
    Header,
} from 'semantic-ui-react';

import { useBeforeRendering } from '@/helpers';
import { Loader } from '@/components/loader';


const View = ({ store }) => {
    const history = useHistory();

    useBeforeRendering(() => {
        store.getArticles();
    });

    if (store.isLoadingArticles) {
        return <Loader />;
    }

    return (
        <Container>
            <Header as="h1" content="Статьи" textAlign="center" />

            <Card.Group>
                {store.articles.map(({
                    id,
                    title,
                    description,
                    photo,
                    user_id,
                    created_at,
                }) => {
                    const createdAt = new Date(created_at * 1000).toLocaleString('ru');

                    return (
                        <Card key={id} fluid>
                            <Card.Content>
                                <Image
                                    floated="right"
                                    size="mini"
                                    src="/assets/user_placeholder.png"
                                />
                                <Card.Header>{title}</Card.Header>
                                <Card.Meta>автор: {user_id} | {createdAt}</Card.Meta>
                                <Card.Description>
                                    {description.slice(0, 150)}
                                </Card.Description>
                            </Card.Content>
                            <Card.Content>
                                <Image src={photo} />
                            </Card.Content>
                            <Card.Content extra>
                                <Button
                                    onClick={() => history.push(`/article/${id}`)}
                                    fluid
                                    primary
                                >
                                    Читать
                                </Button>
                            </Card.Content>
                        </Card>
                    );
                })}
            </Card.Group>
        </Container>
    );
};

export const Articles = inject('store')(observer(View));
