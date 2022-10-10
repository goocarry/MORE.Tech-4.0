import React from 'react';
import PropTypes from 'prop-types';

export const CommentItem = () => (
    <Comment>
        <Comment.Avatar src="https://react.semantic-ui.com/images/avatar/small/joe.jpg" />
        <Comment.Content>
            <Comment.Author as="a">Андрей Андреев</Comment.Author>
            <Comment.Metadata>
                <div>5 дней назад</div>
            </Comment.Metadata>
            <Comment.Text>Круто! Спасибо за статью</Comment.Text>
            <Comment.Actions>
                <Comment.Action>Ответить</Comment.Action>
            </Comment.Actions>
        </Comment.Content>
    </Comment>
);
