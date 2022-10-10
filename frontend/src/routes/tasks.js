import { useCallback } from 'react';
import { inject, observer } from 'mobx-react';
import {
    Container,
    Header,
    List,
    Loader,
    Segment,
    Button,
    Icon,
    Divider,
} from 'semantic-ui-react';


const TaskList = ({ name, list, getScores }) => {
    if (list.length === 0) {
        return null;
    }

    return (
        <>
            <Divider horizontal>
                <Header as="h2">{name}</Header>
            </Divider>
            <List divided relaxed animated>
                {list.map(({ id, name, scores }) => (
                    <List.Item key={id}>
                        <List.Content floated="right">
                            <Button
                                primary
                                onClick={() => getScores(id)}
                                disabled
                            >
                                <Icon name="money" fitted />
                            </Button>
                        </List.Content>
                        <List.Icon name="github" size="large" verticalAlign="middle" />
                        <List.Content>
                            <List.Header>{name}</List.Header>
                            <List.Description>{scores} баллов</List.Description>
                        </List.Content>
                    </List.Item>
                ))}
            </List>
            <div className="divider" />
        </>
    );
}

const View = ({ store }) => {
    const getScores = useCallback(() => {}, []);

    if (store.isLoadingTasks) {
        return (
            <Container>
                <Segment>
                    <Loader active>Loading</Loader>
                </Segment>
            </Container>
        );
    }

    return (
        <Container>
            <TaskList name="Разовые задачи" list={store.tasks.once} getScores={getScores} />
            <TaskList name="Ежедневные задачи" list={store.tasks.daily} getScores={getScores} />
            <TaskList name="Еженедельные задачи" list={store.tasks.weekly} getScores={getScores} />
        </Container>
    );
};

export const Tasks = inject('store')(observer(View));
