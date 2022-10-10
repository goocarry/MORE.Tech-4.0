import { useCallback, useState } from 'react';
import { inject, observer } from 'mobx-react';
import {
    Container,
    Grid,
    Loader,
    Segment,
    Header,
    Card,
    Button,
    Confirm, Image,
} from 'semantic-ui-react';

import { useBeforeRendering } from '@/helpers';


const View = ({ store }) => {
    const [isOpenedConfirmation, updateIsOpenedConfirmation] = useState(false);
    const [selectedProduct, updateSelectedProduct] = useState(null);

    useBeforeRendering(() => {
        store.getProducts();
    });

    const getProduct = useCallback((product) => {
        updateSelectedProduct(product);
        updateIsOpenedConfirmation(true);
    }, [store.products]);

    const handleClose = useCallback(() => {
        updateSelectedProduct(null);
        updateIsOpenedConfirmation(false);
    }, []);

    const handleConfirm = useCallback(() => {
        store.getProduct(selectedProduct);
        updateSelectedProduct(null);
        updateIsOpenedConfirmation(false);
    }, [selectedProduct]);

    if (store.isLoadingProducts) {
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
            <Header as="h1" content="Магазин" textAlign="center" />

            <Grid container columns={3} doubling>
                {store.products.map(({ id, name, price }) => (
                    <Grid.Column key={id}>
                        <Card>
                            <Card.Content>
                                <Image
                                    floated="right"
                                    size="mini"
                                    src="/assets/user_placeholder.png"
                                />
                                <Card.Header>{name}</Card.Header>
                                <Card.Meta>цена: {price}</Card.Meta>
                            </Card.Content>
                            <Card.Content extra>
                                <Button
                                    fluid
                                    color="blue"
                                    onClick={() => getProduct({ id, name, price })}
                                >
                                    Купить
                                </Button>
                            </Card.Content>
                        </Card>
                    </Grid.Column>
                ))}
            </Grid>

            <Confirm
                header={selectedProduct ? `Потратить ${selectedProduct.price} баллов на ${selectedProduct.name}?` : ''}
                open={isOpenedConfirmation}
                onCancel={handleClose}
                onConfirm={handleConfirm}
                cancelButton="Закрыть"
                confirmButton="Купить"
            />
        </Container>
    );
};

export const Shop = inject('store')(observer(View));
