import { Redirect, useParams } from 'react-router-dom';
import { inject, observer } from 'mobx-react';
import { Card, Container, Image } from 'semantic-ui-react';

import { useBeforeRendering } from '@/helpers';
import { Loader } from '@/components/loader';
import { Reactions } from '@/components/reactions';
import CommentExampleComment from '@/components/comments';


const View = ({ store }) => {
    const { id } = useParams();

    useBeforeRendering(() => {
        store.getArticle(id);
    });

    if (store.isLoadingArticle) {
        return <Loader />;
    }

    if (!store.article) {
        return <Redirect to="/" />;
    }

    const createdAt = new Date(store.article.created_at * 1000).toLocaleString('ru');

    return (
        <Container>
            <Card fluid>
                <Card.Content>
                    <Image
                        floated="right"
                        size="mini"
                        src="/assets/user_placeholder.png"
                    />
                    <Card.Header>{store.article.title}</Card.Header>
                    <Card.Meta>автор: {store.article.user_id} | {createdAt}</Card.Meta>
                </Card.Content>
                <Card.Content>
                    <Image src={store.article.photo} style={{ marginBottom: '1em' }} />
                    <Card.Description>
                        {store.article.description}
                    </Card.Description>
                </Card.Content>
            </Card>

            <Reactions />
            <CommentExampleComment />

            <div className="divider" />
        </Container>
    );
};

export const Article = inject('store')(observer(View));
