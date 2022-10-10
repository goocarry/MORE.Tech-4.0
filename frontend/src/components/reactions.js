import { useParams } from 'react-router-dom';
import { inject, observer } from 'mobx-react';
import { List, Image, Segment, Divider } from 'semantic-ui-react';

import { useBeforeRendering } from '@/helpers';
import { Loader } from '@/components/loader';


const availableReactions = [
    'Белый воротничок',
    'Хи-хи ха-ха',
];

const View = ({ store }) => {
    const { id } = useParams();

    useBeforeRendering(() => {
        store.getReactions(id);
    }, [id]);

    if (store.isLoadingReactions) {
        return <Loader minimal />;
    }

    const reactions = store.reactions[id] || [];

    return (
        <Segment vertical>
            {reactions.length > 0 && (
                <>
                    <List horizontal relaxed>
                        {reactions.map(({ id, count }) => (
                            <List.Item key={id}>
                                <Image avatar src={`/assets/reactions/${id}.jpg`} />
                                <List.Content>
                                    <List.Header>{count}</List.Header>
                                </List.Content>
                            </List.Item>
                        ))}
                    </List>
                    <Divider />
                </>
            )}
        </Segment>
    );
};

export const Reactions = inject('store')(observer(View));
