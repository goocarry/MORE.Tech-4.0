import React from 'react';
import {
    Container,
    Image,
    Form,
    Checkbox,
    Button,
    Icon,
    Segment,
    Header,
    Item,
    Label,
} from 'semantic-ui-react';

export const Profile = () => {
    return (
        <Container>
            <Container style={{ position: 'relative' }}>
                <Image
                    className="centered"
                    src="assets/user_placeholder.png"
                    size="medium"
                    circular
                />
                <Image
                    src="assets/paw.png"
                    size="tiny"
                    circular
                    style={{
                        position: 'absolute',
                        top: '80%',
                        left: '70%',
                        transform: 'translate(-50%, -50%)',
                    }}
                />
                <Button>
                    <Icon name="edit" />
                    Edit
                </Button>
            </Container>

            <Segment textAlign="center">
                <Header as="h4">Пользователев Пользователь</Header>
                <Header.Subheader>Менеджер по работе с клиентами</Header.Subheader>
            </Segment>

            <Segment>
                <Header as="h3">Достижения</Header>

                <Item.Group divided>
                    <Item>
                        <Item.Image size="tiny" src="assets/achievement.png" />

                        <Item.Content>
                            <Item.Header as="a">Отличная статья!</Item.Header>

                            <Item.Description>
                                Ваша статья: "Как не опоздать на работу" в топ 10 по просмотрам!
                            </Item.Description>
                            <Item.Extra>
                                <Label size="huge">👀</Label>
                                <Label size="huge">🔥</Label>
                            </Item.Extra>
                        </Item.Content>
                    </Item>

                    <Item>
                        <Item.Image size="tiny" src="assets/achievement.png" />

                        <Item.Content>
                            <Item.Header as="a">Отзывчивый коллега!</Item.Header>

                            <Item.Description>
                                Ваша комментарий: "Это самый полезный пост" собрал самое большое
                                количество реакций! 🔥
                            </Item.Description>
                            <Item.Extra>
                                <Label size="huge">👀</Label>
                                <Label size="huge">📢</Label>
                            </Item.Extra>
                        </Item.Content>
                    </Item>
                </Item.Group>
            </Segment>

            <Segment>
                <Header as="h3">Звания</Header>

                <Item.Group divided>
                    <Item>
                        <Item.Image size="tiny" src="assets/rank.png" />

                        <Item.Content>
                            <Item.Header as="a">Вы успешно прошли испытытельный период</Item.Header>

                            <Item.Extra>
                                <Label size="huge">🐶</Label>
                            </Item.Extra>
                        </Item.Content>
                    </Item>
                </Item.Group>
            </Segment>

            <Segment>
                <Header as="h3">Статистика</Header>

                <span>TODO:</span>
            </Segment>

            {/* TODO: Show form on editing profile */}
            {/* <Form>
                <Form.Field>
                    <label>First Name</label>
                    <input placeholder="First Name" />
                </Form.Field>
                <Form.Field>
                    <label>Last Name</label>
                    <input placeholder="Last Name" />
                </Form.Field>
                <Form.Field>
                    <Checkbox label="I agree to the Terms and Conditions" />
                </Form.Field>
                <Button type="submit">Submit</Button>
            </Form> */}
        </Container>
    );
};
