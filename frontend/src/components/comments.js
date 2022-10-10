import React from 'react'
import { Button, Comment, Form, Header } from 'semantic-ui-react'

const CommentExampleComment = () => (
  <Comment.Group>
    <Header as='h3' dividing>
      Комментарии
    </Header>

    <Comment>
      <Comment.Avatar src='https://react.semantic-ui.com/images/avatar/small/matt.jpg' />
      <Comment.Content>
        <Comment.Author as='a'>Вася</Comment.Author>
        <Comment.Metadata>
          <div>Сегодня в 15:42</div>
        </Comment.Metadata>
        <Comment.Text>Как круто!</Comment.Text>
        <Comment.Actions>
          <Comment.Action>Ответить</Comment.Action>
        </Comment.Actions>
      </Comment.Content>
    </Comment>

    <Comment>
      <Comment.Avatar src='https://react.semantic-ui.com/images/avatar/small/elliot.jpg' />
      <Comment.Content>
        <Comment.Author as='a'>Иван Иванов</Comment.Author>
        <Comment.Metadata>
          <div>Вчера в 12:30</div>
        </Comment.Metadata>
        <Comment.Text>
          <p>Это как раз про мою задачу, Спасибо!</p>
        </Comment.Text>
        <Comment.Actions>
          <Comment.Action>Ответить</Comment.Action>
        </Comment.Actions>
      </Comment.Content>
      <Comment.Group>
        <Comment>
          <Comment.Avatar src='https://react.semantic-ui.com/images/avatar/small/jenny.jpg' />
          <Comment.Content>
            <Comment.Author as='a'>Петя Петров</Comment.Author>
            <Comment.Metadata>
              <div>Только что</div>
            </Comment.Metadata>
            <Comment.Text>Как вовремя :)</Comment.Text>
            <Comment.Actions>
              <Comment.Action>Ответить</Comment.Action>
            </Comment.Actions>
          </Comment.Content>
        </Comment>
      </Comment.Group>
    </Comment>

    <Comment>
      <Comment.Avatar src='https://react.semantic-ui.com/images/avatar/small/joe.jpg' />
      <Comment.Content>
        <Comment.Author as='a'>Андрей Андреев</Comment.Author>
        <Comment.Metadata>
          <div>5 дней назад</div>
        </Comment.Metadata>
        <Comment.Text>Круто! Спасибо за статью</Comment.Text>
        <Comment.Actions>
          <Comment.Action>Ответить</Comment.Action>
        </Comment.Actions>
      </Comment.Content>
    </Comment>

    <Form reply>
      <Form.TextArea />
      <Button content='Оставить комментарий' labelPosition='left' icon='edit' primary />
    </Form>
  </Comment.Group>
)

export default CommentExampleComment