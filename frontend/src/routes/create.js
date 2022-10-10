import React from 'react';
import { Form, TextArea, Header, Button, Confirm } from 'semantic-ui-react';
import { useHistory } from 'react-router-dom';
import { useCallback, useState } from 'react';
import { inject, observer } from 'mobx-react';
import Cookies from 'js-cookie';


const View = ({ store }) => {
    const history = useHistory();
    const [isOpenedConfirmation, updateIsOpenedConfirmation] = useState(false);

    const [newArticle, updateNewArticle] = useState({
        title: '',
        user_id: Cookies.get('user_id'),
        photo: 'https://cs11.pikabu.ru/post_img/2019/06/05/7/og_og_1559734283255560544.jpg',
        description: '',
        categories: [0],
    });

    const openConfirm = useCallback(() => {
        updateIsOpenedConfirmation(true);
    });

    const handleChangeField = useCallback((evt) => {
        updateNewArticle((fields) => ({
            ...fields,
            [evt.target.name]: evt.target.value,
        }));
    }, []);

    const handleClose = useCallback(() => {
        updateIsOpenedConfirmation(false);
    }, []);

    const handleConfirm = useCallback(async () => {
        try {
            await store.sendArticle(newArticle);
            updateIsOpenedConfirmation(false);
            history.push('/articles');
        } catch (err) {
            console.log(err);
        }
    }, [newArticle, history.push]);

    return (
        <div style={{ padding: '5em 5em 5em 5em' }}>
            <Header>Новая статья</Header>
            <p>Название</p>
            <Form.Input
                fluid
                icon="file text"
                iconPosition="left"
                placeholder="Название"
                name="title"
                onChange={handleChangeField}
                value={newArticle.title}
            />
            <div style={{ padding: '1em' }}></div>
            <p>Содержание</p>
            <Form>
                <TextArea
                    name="description"
                    placeholder="Содержание"
                    onChange={handleChangeField}
                    value={newArticle.description}
                />
            </Form>
            <div style={{ padding: '1em' }}></div>
            <p>Фото</p>
            <Form.Input
                fluid
                icon="file image"
                iconPosition="left"
                placeholder="Ссылка на фото"
                name="photo"
                onChange={handleChangeField}
                value={newArticle.photo}
            />
            <div style={{ padding: '1em' }}></div>

            <Button onClick={openConfirm}>Опубликовать</Button>

            <Confirm
                header={'Хотите опубликовать статью?'}
                open={isOpenedConfirmation}
                onCancel={handleClose}
                onConfirm={handleConfirm}
                cancelButton="Закрыть"
                confirmButton="Опубликовать"
            />
        </div>
    );
};

export const Create = inject('store')(observer(View));
